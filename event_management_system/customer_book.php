<?php
include("config.php");

$msg = "";

// Booking submit হলে
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_name'])) {
  $event_id = intval($_POST['event_id']);
  $customer_name = $conn->real_escape_string($_POST['customer_name']);
  $gmail = $conn->real_escape_string($_POST['gmail']);
  $contact_number = $conn->real_escape_string($_POST['contact_number']);
  $address = $conn->real_escape_string($_POST['address']);

  // Event এর ইনফো আনা
  $event_q = $conn->query("
        SELECT e.date, v.id AS venue_id
        FROM event e
        JOIN venue v ON e.venue_id = v.id
        WHERE e.id = $event_id
        LIMIT 1
    ");
  $event = $event_q->fetch_assoc();

  if ($event) {
    $venue_id = $event['venue_id'];
    $date = $event['date'];

    // Duplicate prevention
    $check = $conn->query("SELECT id FROM booking WHERE event_id=$event_id AND gmail='$gmail'");
    if ($check->num_rows > 0) {
      $msg = "<div class='alert alert-warning'>You have already booked this event!</div>";
    } else {
      $sql = "INSERT INTO booking 
                    (event_id, venue_id, date, customer_name, gmail, contact_number, address)
                    VALUES
                    ('$event_id','$venue_id','$date','$customer_name','$gmail','$contact_number','$address')";

      if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit();
      } else {
        $msg = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
      }
    }
  } else {
    $msg = "<div class='alert alert-danger'>Invalid Event Selected!</div>";
  }
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
  $msg = "<div class='alert alert-success'>Booking confirmed successfully!</div>";
}

$events = $conn->query("
    SELECT e.id, e.event_name, e.date, v.name AS venue_name, v.capacity, v.rent
    FROM event e
    JOIN venue v ON e.venue_id = v.id
    WHERE e.date > NOW()
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('your-background.jpg') no-repeat center center fixed;
      /* ব্যাকগ্রাউন্ড ইমেজ */
      background-size: cover;
      min-height: 100vh;
    }

    .booking-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .booking-card {
      background: rgba(248, 249, 250, 0.95);
      /* light color with slight transparency */
      border-radius: 1rem;
      box-shadow: 0 3px 15px rgba(0, 0, 0, 0.2);
      padding: 30px;
      width: 100%;
      max-width: 700px;
      min-height: 600px;
      /* fixed height */
      overflow-y: auto;
    }

    .booking-card h1 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #007bff;
      text-align: center;
      font-weight: 700;
    }

    .booking-card label {
      font-weight: 600;
      color: #333;
    }

    .booking-card .form-control {
      border-radius: 0.5rem;
      padding: 8px 12px;
      margin-bottom: 12px;
      border: 1px solid #ced4da;
    }

    .booking-card .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
    }

    .booking-card input[readonly] {
      background-color: #e9ecef;
      font-weight: 500;
      color: #495057;
    }

    .booking-card .btn-success {
      border-radius: 0.5rem;
      padding: 10px 20px;
      font-weight: 600;
      width: 100%;
    }

    .booking-card .btn-success:hover {
      background-color: #0069d9;
      transform: scale(1.03);
      transition: all 0.2s ease-in-out;
    }
  </style>
</head>

<body>

  <div class="booking-container">
    <div class="booking-card">
      <h1>Booking Form</h1>
      <?php echo $msg; ?>
      <form method="post">
        <div class="form-group">
          <label for="event_id">Select Event</label>
          <select class="form-control" id="event_id" name="event_id" required>
            <option value="">-- Select Event --</option>
            <?php while ($row = $events->fetch_assoc()): ?>
              <option value="<?= $row['id']; ?>" data-venue="<?= htmlspecialchars($row['venue_name']); ?>"
                data-date="<?= htmlspecialchars($row['date']); ?>"
                data-capacity="<?= htmlspecialchars($row['capacity']); ?>"
                data-rent="<?= htmlspecialchars($row['rent']); ?>">
                <?= htmlspecialchars($row['event_name']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Venue</label>
          <input type="text" id="field_venue_name" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Capacity</label>
          <input type="text" id="field_capacity" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Rent</label>
          <input type="text" id="field_rent" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Date</label>
          <input type="text" id="field_date" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Your Name</label>
          <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Your Email</label>
          <input type="email" name="gmail" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Contact Number</label>
          <input type="text" name="contact_number" class="form-control">
        </div>

        <div class="form-group">
          <label>Address</label>
          <textarea name="address" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Confirm Booking</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const eventSelect = document.getElementById('event_id');
      const venueField = document.getElementById('field_venue_name');
      const capacityField = document.getElementById('field_capacity');
      const rentField = document.getElementById('field_rent');
      const dateField = document.getElementById('field_date');

      eventSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        venueField.value = selected.dataset.venue || "";
        capacityField.value = selected.dataset.capacity || "";
        rentField.value = selected.dataset.rent || "";
        dateField.value = selected.dataset.date || "";
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>