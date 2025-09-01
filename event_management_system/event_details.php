<?php
session_start();
require "config.php"; // database connection

// Get event id safely
$event_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($event_id === 0)
    die("Invalid event ID!");

// Fetch event info using a prepared statement
$query = "SELECT e.*, v.name AS venue_name, v.capacity, v.rent 
          FROM event e
          LEFT JOIN venue v ON e.venue_id = v.id
          WHERE e.id = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event)
    die("Event not found!");

// Handle image
if (!empty($event['image'])) {
    $images = explode(',', $event['image']);
    $image = trim($images[0]);
    if (!file_exists($image)) {
        $image = 'uploads/' . basename($image);
        if (!file_exists($image))
            $image = 'assets/images/no-image.png';
    }
} else {
    $image = 'assets/images/no-image.png';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['event_name']); ?> | Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional: ensure image fills column and is cropped nicely */
        .event-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="row g-0">
                <!-- Image Column -->
                <div class="col-md-6">
                    <img src="<?= htmlspecialchars($image); ?>" alt="Event Image" class="img-fluid event-image"
                        width="100%" height="100%">
                </div>

                <!-- Text Column -->
                <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                    <h2 class="mb-3"><?= htmlspecialchars($event['event_name']); ?></h2>
                    <p><strong>Type:</strong> <?= htmlspecialchars($event['type']); ?></p>
                    <p><strong>Date:</strong> <?= htmlspecialchars($event['date']); ?></p>
                    <p><strong>Venue:</strong> <?= htmlspecialchars($event['venue_name']); ?></p>
                    <p><strong>Capacity:</strong> <?= htmlspecialchars($event['capacity']); ?> people</p>
                    <p><strong>Rent:</strong> ৳<?= number_format($event['rent'], 2); ?></p>
                    <p><?= nl2br(htmlspecialchars($event['description'])); ?></p>
                    <a href="customer_book.php?event_id=<?= $event['id']; ?>" class="btn btn-primary mt-3">Book Now</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>