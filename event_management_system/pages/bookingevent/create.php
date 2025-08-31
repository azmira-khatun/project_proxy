<?php
include("config.php");

// Delete Booking
$msg = "";
if (isset($_POST['btnDelete'])) {
    $id = intval($_POST['txtId']);
    if ($conn->query("DELETE FROM booking WHERE id=$id")) {
        $msg = "<div class='alert alert-success'>Booking deleted successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error deleting booking: " . $conn->error . "</div>";
    }
}

// Update Booking (from modal)
if (isset($_POST['update'])) {
    $id = intval($_POST['booking_id']);
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
    } else {
        $msg = "<div class='alert alert-danger'>Error updating booking: " . $conn->error . "</div>";
    }
}

// Fetch bookings
$sql = "SELECT b.*, e.event_name, v.name AS venue_name 
        FROM booking b
        JOIN event e ON b.event_id = e.id
        JOIN venue v ON b.venue_id = v.id
        ORDER BY b.id DESC";
$bookings = $conn->query($sql);

// Fetch events & venues for modal dropdowns
$events = $conn->query("SELECT id, event_name FROM event");
$venues = $conn->query("SELECT id, name FROM venue");
$eventOptions = "";
while ($e = $events->fetch_assoc()) {
    $eventOptions .= "<option value='{$e['id']}'>{$e['event_name']}</option>";
}
$venueOptions = "";
while ($v = $venues->fetch_assoc()) {
    $venueOptions .= "<option value='{$v['id']}'>{$v['name']}</option>";
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>All Bookings</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <?= $msg; ?>

                <table class="table table-bordered table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Event</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($bookings && $bookings->num_rows > 0): ?>
                            <?php while ($row = $bookings->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= htmlspecialchars($row['event_name']); ?></td>
                                    <td><?= htmlspecialchars($row['venue_name']); ?></td>
                                    <td><?= htmlspecialchars($row['date']); ?></td>
                                    <td><?= htmlspecialchars($row['customer_name']); ?></td>
                                    <td><?= htmlspecialchars($row['gmail']); ?></td>
                                    <td><?= htmlspecialchars($row['contact_number']); ?></td>
                                    <td><?= htmlspecialchars($row['address']); ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <!-- Edit Button triggers modal -->
                                            <button class="btn btn-primary btn-sm mr-1 editBtn" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="<?= $row['id']; ?>"
                                                data-event="<?= $row['event_id']; ?>" data-venue="<?= $row['venue_id']; ?>"
                                                data-date="<?= $row['date']; ?>"
                                                data-customer="<?= htmlspecialchars($row['customer_name']); ?>"
                                                data-gmail="<?= htmlspecialchars($row['gmail']); ?>"
                                                data-contact="<?= htmlspecialchars($row['contact_number']); ?>"
                                                data-address="<?= htmlspecialchars($row['address']); ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete Form -->
                                            <form action="" method="post"
                                                onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                                <input type="hidden" name="txtId" value="<?= $row['id']; ?>">
                                                <button type="submit" name="btnDelete" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">No bookings found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="booking_id" id="booking_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Event</label>
                            <select name="event_id" id="event_id" class="form-control" required>
                                <?= $eventOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Venue</label>
                            <select name="venue_id" id="venue_id" class="form-control" required>
                                <?= $venueOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email (Gmail)</label>
                            <input type="email" name="gmail" id="gmail" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Address</label>
                            <textarea name="address" id="address" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-success">Update Booking</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap 5 JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fill modal with booking data
    $(document).ready(function () {
        $('.editBtn').on('click', function () {
            $('#booking_id').val($(this).data('id'));
            $('#event_id').val($(this).data('event'));
            $('#venue_id').val($(this).data('venue'));
            $('#date').val($(this).data('date'));
            $('#customer_name').val($(this).data('customer'));
            $('#gmail').val($(this).data('gmail'));
            $('#contact_number').val($(this).data('contact'));
            $('#address').val($(this).data('address'));
        });
    });
</script>