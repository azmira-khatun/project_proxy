<?php
session_start();
include("config.php");

$error = "";

if (isset($_POST["btnLogin"])) {
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  $stmt = $conn->prepare("SELECT id, firstname, email, password FROM users WHERE email=? AND password=?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $_SESSION["s_userid"] = $row["id"];
    $_SESSION["s_email"] = $row["email"];
    $_SESSION["s_firstname"] = $row["firstname"];

    header("Location: home.php");
    exit();
  } else {
    $error = "Incorrect email or password";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #f5f5f5;
      /* Plain light background */
    }

    .login-card {
      border-radius: 15px;
      background: #ffffff;
      /* White card */
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      padding: 35px 30px;
    }

    .login-card h3 {
      color: #333;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .login-card p {
      color: #666;
      margin-bottom: 30px;
    }

    .form-control {
      border-radius: 10px;
      background: #f0f0f0;
      color: #333;
      padding: 12px;
    }

    .form-control::placeholder {
      color: #999;
    }

    .form-control:focus {
      background: #e6e6e6;
      color: #333;
      box-shadow: none;
    }

    .btn-login {
      border-radius: 10px;
      font-weight: 600;
      padding: 12px;
      background: #0d6efd;
      /* Bootstrap primary blue */
      color: #fff;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background: #0b5ed7;
      /* Darker blue on hover */
      transform: translateY(-2px);
    }

    a {
      color: #0d6efd;
    }

    a:hover {
      text-decoration: none;
      color: #0b5ed7;
    }

    .form-check-label {
      color: #333;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="login-card">

          <h3 class="text-center">Welcome Back</h3>
          <p class="text-center">Sign in to start your session</p>

            <?php if ($error != ""): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

          <form method="post">

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              <label for="email"><i class="bi bi-envelope"></i> Email</label>
            </div>

            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              <label for="password"><i class="bi bi-lock"></i> Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
              </div>
              <a href="#" class="small">Forgot?</a>
            </div>

            <button type="submit" name="btnLogin" class="btn w-100 btn-login">Sign In</button>
          </form>

          <hr class="my-4">

          <p class="text-center mb-0">
            Don’t have an account? <a href="index.php">Register</a>
          </p>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>