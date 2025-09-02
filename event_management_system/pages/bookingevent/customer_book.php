<?php
include("config.php");

$msg = "";
$selectedEventId = isset($_POST['event_id']) ? intval($_POST['event_id']) : (isset($_GET['id']) && ctype_digit($_GET['id']) ? intval($_GET['id']) : 0);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $selectedEventId > 0) {
    // Booking logic remains the same...
    // (omitted for brevity)
}

$events = $conn->query("
    SELECT e.id, e.event_name, e.date, v.name AS venue_name, v.capacity, v.rent
    FROM event e
    JOIN venue v ON e.venue_id = v.id
    WHERE e.date > NOW()
");
?>

<div class="content-wrapper">
  <section class="content-header"><h1>Booking Form</h1></section>
  <section class="content">
    <div class="card"><div class="card-body">
      <?php echo $msg; ?>

      <form method="post">
        <div class="form-group">
          <label for="event_id">Select Event</label>
          <select class="form-control" id="event_id" name="event_id" required>
            <option value="">-- Select Event --</option>
            <?php while ($row = $events->fetch_assoc()): ?>
              <option
                value="<?php echo $row['id']; ?>"
                <?php echo ($row['id'] == $selectedEventId) ? ' selected="selected"' : ''; ?>
                data-venue="<?php echo htmlspecialchars($row['venue_name']); ?>"
                data-date="<?php echo htmlspecialchars($row['date']); ?>"
                data-capacity="<?php echo htmlspecialchars($row['capacity']); ?>"
                data-rent="<?php echo htmlspecialchars($row['rent']); ?>"
              >
                <?php echo htmlspecialchars($row['event_name']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- The other readonly fields -->
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

        <!-- Customer Details -->
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
    </div></div>
  </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const eventSelect = document.getElementById('event_id');
  const venueField = document.getElementById('field_venue_name');
  const capacityField = document.getElementById('field_capacity');
  const rentField = document.getElementById('field_rent');
  const dateField = document.getElementById('field_date');

  function fillFields() {
    const selected = eventSelect.options[eventSelect.selectedIndex];
    venueField.value = selected.dataset.venue || "";
    capacityField.value = selected.dataset.capacity || "";
    rentField.value = selected.dataset.rent || "";
    dateField.value = selected.dataset.date || "";
  }

  eventSelect.addEventListener('change', fillFields);

  // Populate fields if an event was already selected on load
  if (eventSelect.value) {
    fillFields();
  }
});
</script>
