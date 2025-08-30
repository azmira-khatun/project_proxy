<?php
include("config.php");
// session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // database থেকে user check
  $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // login success হলে session set
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['firstname'] = $row['firstname'];

    // redirect after login
    header("Location: hello.php");
    exit();
  } else {
    echo "<script>alert('Invalid Email or Password');</script>";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Login Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Login</b></a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="#" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>

        <p class="mb-0">
          <a href="register.php" class="text-center">Register a new membership</a>
        </p>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="dist/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/dist/js/adminlte.min.js"></script>
</body>

</html>