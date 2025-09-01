<?php
include("config.php");

// Message
$msg = "";

// Delete Booking
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
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $gmail = $conn->real_escape_string($_POST['gmail']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $address = $conn->real_escape_string($_POST['address']);
    $status = $_POST['status'];

    $update = "UPDATE booking SET 
                event_id='$event_id', venue_id='$venue_id', date='$date', 
                customer_name='$customer_name', gmail='$gmail', 
                contact_number='$contact_number', address='$address', status='$status'
               WHERE id=$id";

    if ($conn->query($update) === TRUE) {
        $msg = "<div class='alert alert-success'>Booking updated successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error updating booking: " . $conn->error . "</div>";
    }
}

// Change booking status (Pending ↔ Complete)
if (isset($_POST['changeStatus'])) {
    $id = intval($_POST['booking_id']);
    $status = $_POST['status']; // New status from hidden input
    if ($conn->query("UPDATE booking SET status='$status' WHERE id=$id")) {
        $msg = "<div class='alert alert-success'>Booking status updated to $status.</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error updating status: " . $conn->error . "</div>";
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
                            <th>Status</th>
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
                                        <form method="post" style="display:inline-block;">
                                            <input type="hidden" name="booking_id" value="<?= $row['id']; ?>">
                                            <?php if ($row['status'] == 'Pending'): ?>
                                                <input type="hidden" name="status" value="Complete">
                                                <button type="submit" name="changeStatus" class="btn btn-warning btn-sm">Mark
                                                    Complete</button>
                                            <?php else: ?>
                                                <input type="hidden" name="status" value="Pending">
                                                <button type="submit" name="changeStatus" class="btn btn-success btn-sm">Mark
                                                    Pending</button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-primary btn-sm mr-1 editBtn" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="<?= $row['id']; ?>"
                                                data-event="<?= $row['event_id']; ?>" data-venue="<?= $row['venue_id']; ?>"
                                                data-date="<?= $row['date']; ?>"
                                                data-customer="<?= htmlspecialchars($row['customer_name']); ?>"
                                                data-gmail="<?= htmlspecialchars($row['gmail']); ?>"
                                                data-contact="<?= htmlspecialchars($row['contact_number']); ?>"
                                                data-address="<?= htmlspecialchars($row['address']); ?>"
                                                data-status="<?= $row['status']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

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
                                <td colspan="10" class="text-center">No bookings found</td>
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
                            <select name="event_id" id="modal_event_id" class="form-control" required>
                                <?= $eventOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Venue</label>
                            <select name="venue_id" id="modal_venue_id" class="form-control" required>
                                <?= $venueOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Date</label>
                            <input type="date" name="date" id="modal_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" id="modal_customer_name" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email (Gmail)</label>
                            <input type="email" name="gmail" id="modal_gmail" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" id="modal_contact_number" class="form-control"
                                required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Address</label>
                            <textarea name="address" id="modal_address" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" id="modal_status" class="form-control" required>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editBtn').on('click', function () {
            $('#booking_id').val($(this).data('id'));
            $('#modal_event_id').val($(this).data('event'));
            $('#modal_venue_id').val($(this).data('venue'));
            $('#modal_date').val($(this).data('date'));
            $('#modal_customer_name').val($(this).data('customer'));
            $('#modal_gmail').val($(this).data('gmail'));
            $('#modal_contact_number').val($(this).data('contact'));
            $('#modal_address').val($(this).data('address'));
            $('#modal_status').val($(this).data('status'));
        });
    });
</script>