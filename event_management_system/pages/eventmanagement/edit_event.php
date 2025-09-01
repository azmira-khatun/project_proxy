<?php
include("config.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$msg = "";
$event_name = $type = $date = $venue_id = $imagePath = "";

// Fetch venue list
$venue_res = $conn->query("SELECT id, name FROM venue");

// Fetch event
if ($id > 0) {
    $res = $conn->query("SELECT * FROM event WHERE id='{$id}'");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $event_name = $row['event_name'];
        $type = $row['type'];
        $date = $row['date'];
        $venue_id = $row['venue_id'];
        $imagePath = $row['image'];
    } else {
        $msg = "<div class='alert alert-danger'>Event not found.</div>";
    }
}

// Handle update
if (isset($_POST['submit'])) {
    $event_name = $conn->real_escape_string($_POST['event_name']);
    $type = $conn->real_escape_string($_POST['type']);
    $date = $conn->real_escape_string($_POST['date']);
    $venue_id = intval($_POST['venue_id']);
    
    // Determine image path
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
        $allowedExt = ['jpg','jpeg','png','gif'];
        $tmp = $_FILES['event_image']['tmp_name'];
        $orig = basename($_FILES['event_image']['name']);
        $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
        if (in_array($ext, $allowedExt)) {
            $newName = uniqid('evt_', true) . '.' . $ext;
            $target = __DIR__ . '/uploads/' . $newName;
            if (!is_dir(__DIR__ . '/uploads/')) {
                mkdir(__DIR__ . '/uploads/', 0755, true);
            }
            if (move_uploaded_file($tmp, $target)) {
                $imagePath = 'uploads/' . $newName;
            } else {
                $msg = "<div class='alert alert-danger'>Failed to upload image.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Invalid image format.</div>";
        }
    }

    if (!$msg) {
        $stmt = $conn->prepare("
            UPDATE event SET event_name=?, type=?, date=?, venue_id=?, image=?
            WHERE id=?
        ");
        $stmt->bind_param("sssssi", $event_name, $type, $date, $venue_id, $imagePath, $id);
        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Event updated successfully.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error updating: " . htmlspecialchars($stmt->error) . "</div>";
        }
        $stmt->close();
    }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Event</h1>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-body">
        <?php echo $msg; ?>

        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="event_name" class="form-control"
                   value="<?php echo htmlspecialchars($event_name); ?>" required>
          </div>

          <div class="form-group">
            <label>Type</label>
            <input type="text" name="type" class="form-control"
                   value="<?php echo htmlspecialchars($type); ?>" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control"
                   value="<?php echo htmlspecialchars($date); ?>" required>
          </div>

          <div class="form-group">
            <label>Venue</label>
            <select name="venue_id" class="form-control" required>
              <option value="">-- Select Venue --</option>
              <?php while ($venue = $venue_res->fetch_assoc()): ?>
                <option value="<?php echo $venue['id']; ?>"
                  <?php echo ($venue['id'] == $venue_id ? 'selected' : ''); ?>>
                  <?php echo htmlspecialchars($venue['name']); ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Event Image</label><br>
            <?php if ($imagePath): ?>
              <img src="<?php echo htmlspecialchars($imagePath); ?>"
                   alt="Current Image" width="120"><br><br>
            <?php endif; ?>
            <input type="file" name="event_image" accept="image/*">
            <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($imagePath); ?>">
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Update</button>
          <a href="home.php?page=11" class="btn btn-secondary">Cancel</a>
        </form>

      </div>
    </div>
  </section>
</div>
