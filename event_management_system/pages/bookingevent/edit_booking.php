<?php
include("config.php");

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("<div class='alert alert-danger'>Invalid Booking ID!</div>");
}

$id = intval($_GET['id']);

// Fetch booking
$bookingResult = $conn->query("SELECT * FROM booking WHERE id=$id");
if ($bookingResult->num_rows == 0) {
  die("<div class='alert alert-danger'>Booking not found!</div>");
}
$booking = $bookingResult->fetch_assoc();
$msg = "";

// Update booking
if (isset($_POST['update'])) {
  $event_id = intval($_POST['event_id']);
  $venue_id = intval($_POST['venue_id']);
  $date = $_POST['date'];
  $customer_name = $_POST['customer_name'];
  $gmail = $_POST['gmail'];
  $contact_number = $_POST['contact_number'];
  $address = $_POST['address'];

  $update = "UPDATE booking SET 
                event_id='$event_id', venue_id='$venue_id', date='$date', 
                customer_name='$customer_name', gmail='$gmail', 
                contact_number='$contact_number', address='$address'
               WHERE id=$id";

  if ($conn->query($update) === TRUE) {
    $msg = "<div class='alert alert-success'>Booking updated successfully!</div>";
    // Refresh booking data
    $bookingResult = $conn->query("SELECT * FROM booking WHERE id=$id");
    $booking = $bookingResult->fetch_assoc();
  } else {
    $msg = "<div class='alert alert-danger'>Error updating booking: " . $conn->error . "</div>";
  }
}

// Fetch events and venues for dropdowns
$events = $conn->query("SELECT id, event_name FROM event");
$venues = $conn->query("SELECT id, name FROM venue");
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Booking</h1>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <?= $msg; ?>

        <form method="post">

          <div class="form-group mb-3">
            <label>Event</label>
            <select name="event_id" class="form-control" required>
              <?php while ($e = $events->fetch_assoc()): ?>
                <option value="<?= $e['id']; ?>" <?= ($booking['event_id'] == $e['id']) ? 'selected' : ''; ?>>
                  <?= htmlspecialchars($e['event_name']); ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group mb-3">
            <label>Venue</label>
            <select name="venue_id" class="form-control" required>
              <?php while ($v = $venues->fetch_assoc()): ?>
                <option value="<?= $v['id']; ?>" <?= ($booking['venue_id'] == $v['id']) ? 'selected' : ''; ?>>
                  <?= htmlspecialchars($v['name']); ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="<?= $booking['date']; ?>" required>
          </div>

          <div class="form-group mb-3">
            <label>Customer Name</label>
            <input type="text" name="customer_name" class="form-control"
              value="<?= htmlspecialchars($booking['customer_name']); ?>" required>
          </div>

          <div class="form-group mb-3">
            <label>Email (Gmail)</label>
            <input type="email" name="gmail" class="form-control" value="<?= htmlspecialchars($booking['gmail']); ?>"
              required>
          </div>

          <div class="form-group mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control"
              value="<?= htmlspecialchars($booking['contact_number']); ?>" required>
          </div>

          <div class="form-group mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control"
              required><?= htmlspecialchars($booking['address']); ?></textarea>
          </div>

          <button type="submit" name="update" class="btn btn-success">Update Booking</button>
          <a href="home.php?page=booking" class="btn btn-secondary">Back</a>
        </form>

      </div>
    </div>
  </section>
</div>