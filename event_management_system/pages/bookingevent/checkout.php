<?php
session_start();
include("../../config.php");

if (!isset($conn)) {
    header("location:../../login.php");
    exit();
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_name'])) {
    $customer_name = $_POST['customer_name'];
    $gmail = $_POST['gmail'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];

    if (!empty($_SESSION['cart'])) {
        $stmt_booking = $conn->prepare("INSERT INTO booking (event_id, venue_id, date, customer_name, gmail, contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($_SESSION['cart'] as $event_id) {
            $stmt_event = $conn->prepare("SELECT e.date, v.id AS venue_id FROM event e JOIN venue v ON e.venue_id = v.id WHERE e.id = ? LIMIT 1");
            $stmt_event->bind_param("i", $event_id);
            $stmt_event->execute();
            $event_result = $stmt_event->get_result();
            $event_details = $event_result->fetch_assoc();
            $stmt_event->close();

            if ($event_details) {
                $venue_id = $event_details['venue_id'];
                $date = $event_details['date'];
                $stmt_booking->bind_param("iisssss", $event_id, $venue_id, $date, $customer_name, $gmail, $contact_number, $address);
                if (!$stmt_booking->execute()) {
                    $msg .= "<div class='alert alert-danger'>Error booking event ID " . htmlspecialchars($event_id) . ": " . $stmt_booking->error . "</div>";
                }
            } else {
                $msg .= "<div class='alert alert-danger'>Invalid event ID " . htmlspecialchars($event_id) . " in cart.</div>";
            }
        }
        $stmt_booking->close();

        if (empty($msg)) {
            $msg = "<div class='alert alert-success'>All events have been successfully booked!</div>";
            $_SESSION['cart'] = [];
        }
    } else {
        $msg = "<div class='alert alert-info'>Your cart is empty. Please add events before checking out.</div>";
    }
}

$events_in_cart = [];
if (!empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $sql = "
        SELECT e.id, e.event_name, e.date, v.name AS venue_name, v.rent
        FROM event e
        JOIN venue v ON e.venue_id = v.id
        WHERE e.id IN ($placeholders)
    ";
    $stmt = $conn->prepare($sql);
    $types = str_repeat('i', count($_SESSION['cart']));
    $stmt->bind_param($types, ...$_SESSION['cart']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $events_in_cart = $result->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout - Daily Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        .alert {
            margin-top: 20px;
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Checkout</h1>
        <a href="../../index.php" class="btn btn-primary">Back to Events</a>
        <?php echo $msg; ?>
        <div class="card">
            <div class="card-header">
                <h3>Events in Your Cart</h3>
            </div>
            <div class="card-body">
                <?php if (empty($events_in_cart)): ?>
                    <div class="alert alert-warning">Your cart is empty.</div>
                <?php else: ?>
                    <ul class="list-group">
                        <?php foreach ($events_in_cart as $event): ?>
                            <li class="list-group-item">
                                <strong>Event:</strong> <?= htmlspecialchars($event['event_name']) ?> <br>
                                <strong>Date:</strong> <?= htmlspecialchars($event['date']) ?> <br>
                                <strong>Venue:</strong> <?= htmlspecialchars($event['venue_name']) ?> <br>
                                <strong>Rent:</strong> $<?= number_format($event['rent'], 2) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <hr>
                    <form method="post" class="mt-4">
                        <h4 class="mb-3">Your Details</h4>
                        <div class="form-group">
                            <label for="customer_name">Your Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gmail">Your Email</label>
                            <input type="email" name="gmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg btn-block">Confirm Booking for All
                            Events</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>