<?php
include("config.php");

// Redirect if no database connection or session
if (!isset($conn)) {
    header("Location: login.php");
    exit();
}

$message = "";
if (isset($_POST["btnDelete"])) {
    $event_id = mysqli_real_escape_string($conn, $_POST["txtId"]);
    $deleteSQL = "DELETE FROM event WHERE id='$event_id'";
    if ($conn->query($deleteSQL) === TRUE) {
        $message = "<div class='alert alert-success'>Event deleted successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error deleting event: " . htmlspecialchars($conn->error) . "</div>";
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Manage Events</h1>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <?php echo $message; ?>

                <table class="table table-striped table-bordered">
                    <thead class="bg-info text-white">
                        <tr>
                            <th>#ID</th>
                            <th>Event Name</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Image</th>  <!-- New column -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $events = $conn->query("
                            SELECT e.id, e.event_name, e.type, e.date, v.name AS venue_name, e.image
                            FROM event e
                            JOIN venue v ON e.venue_id = v.id
                            ORDER BY e.id DESC
                        ");

                        if ($events) {
                            while ($row = $events->fetch_assoc()) {
                                $id = htmlspecialchars($row['id']);
                                $name = htmlspecialchars($row['event_name']);
                                $type = htmlspecialchars($row['type']);
                                $date = htmlspecialchars($row['date']);
                                $venue = htmlspecialchars($row['venue_name']);
                                $imagePath = htmlspecialchars($row['image']);

                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$type}</td>
                                        <td>{$date}</td>
                                        <td>{$venue}</td>
                                        <td>
                                            <img src='{$imagePath}' alt='Event Image' width='100' onerror=\"this.src='placeholder.png';\">
                                        </td>
                                        <td>
                                            <div class='d-flex'>
                                                <form action='' method='post' onsubmit='return confirm(\"Are you sure you want to delete this event?\");'>
                                                    <input type='hidden' name='txtId' value='{$id}' />
                                                    <button type='submit' name='btnDelete' class='btn btn-danger btn-sm mr-1'>
                                                        <i class='fas fa-trash'></i>
                                                    </button>
                                                </form>
                                                <a href='home.php?page=6&id={$id}' class='btn btn-primary btn-sm'>
                                                    <i class='fas fa-edit'></i>
                                                </a>
                                            </div>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No data found or error: " . htmlspecialchars($conn->error) . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
