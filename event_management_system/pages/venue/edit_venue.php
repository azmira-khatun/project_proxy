<?php
include("config.php");

// Redirect if not connected/session
if (!isset($conn)) {
    header("location:login.php");
    exit();
}

$msg = "";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ফর্মের জন্য ডিফল্ট ভ্যালু
$name = "";
$location = "";
$capacity = "";
$rent = "";
$description = "";

// পুরানো ডেটা ফেচ করা
if ($id > 0) {
    $res = $conn->query("SELECT * FROM venue WHERE id='$id'");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $name = $row['name'];
        $location = $row['location'];
        $capacity = $row['capacity'];
        $rent = $row['rent'];
        $description = $row['description'];
    } else {
        $msg = "<div class='alert alert-danger'>Venue not found.</div>";
    }
}

// আপডেট প্রসেস
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $rent = mysqli_real_escape_string($conn, $_POST['rent']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql_update = "UPDATE venue SET 
                       name='$name', 
                       location='$location', 
                       capacity='$capacity', 
                       rent='$rent', 
                       description='$description'
                   WHERE id='$id'";

    if ($conn->query($sql_update) === TRUE) {
        $msg = "<div class='alert alert-success'>Venue updated successfully.</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Venue</h1>
    </section>

    <section class="content">
        <div class="card" style="max-width:600px; margin:auto;">
            <div class="card-body">
                <?php echo $msg; ?>

                <form method="post">
                    <div class="form-group">
                        <label>Venue Name</label>
                        <input type="text" class="form-control" name="name"
                            value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location"
                            value="<?php echo htmlspecialchars($location); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Capacity</label>
                        <input type="number" class="form-control" name="capacity"
                            value="<?php echo htmlspecialchars($capacity); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Rent (TK)</label>
                        <input type="number" class="form-control" name="rent"
                            value="<?php echo htmlspecialchars($rent); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"
                            rows="3"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="home.php?page=9" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </section>
</div>