<?php
require 'connect.php';
require 'send_email_function.php';

$signup_errors = array();

if (isset($_SESSION['logged_in_user'])) {
  header("Location: index.php");
}
else {
  if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($name != "" && $username != "" && $email != "" && $password != "" && $password_confirm != "") {
      //Check if an account has username
      $user_check_query = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      if ($user) { // if user exists
        if ($user['username'] === $username) {
          array_push($signup_errors, "Username already exists!");
        }
      }

      //Check if an account has email
      $user_check_query = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      if ($user) { // if user exists
        if ($user['email'] === $email) {
          array_push($signup_errors, "Email already exists!");
        }
      }

      if (strlen($password) < 6) {
        array_push($signup_errors, "Your password is too short!");
      }

      if ($password != $password_confirm) {
        array_push($signup_errors, "Password and password confirm don't match!");
      }

      //If don't have any error
      if (count($signup_errors) == 0) {
        $activation_key = md5($username + $email);
        $password = md5(md5($password));
        $sql = "INSERT INTO users (name, username ,email, password, activation_key) VALUES ('$name', '$username', '$email', '$password', '$activation_key')";
        if (mysqli_query($conn, $sql)) {
          $link = 'http://localhost/PHPExamples/php/activation.php?key=' . $activation_key;
          send_email_to($email, $link, "active");
          $success_message = "Your account has been created, check your email to activate you account.";
        }
        else {
          array_push($signup_errors, mysql_error());
        }
      }
    }
    else {
      array_push($signup_errors, "You need to fill in all the infomation to create an account!");
    }
  }
}


mysqli_close($conn);
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../images/favicon.ico">

  <title>Sign up</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://kit.fontawesome.com/88e95e70fb.js" crossorigin="anonymous"></script>
  <script src="../js/sign_up.js?v=<?php echo time(); ?>"></script>
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/login-bg.jpg)">
  <div class="container h-100">
    <div class="row align-items-center justify-content-md-center h-100">

      <div class="col-12">
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-5 col-md-5 col-12">
            <div class="login-wrap bg-white shadow-lg">
              <div class="content-top-agile">
                <h2 class="text-primary">Let's Get Started</h2>
                <p class="mb-0">Login to continue to Power BI.</p>
              </div>
              <div class="p-5">
                <div class="errors-list">
                  <?php foreach ($signup_errors as $signup_error) { ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $signup_error;?>
                      </div>
                  <?php
                  }
                  if (isset($success_message)){
                  ?>
                    <div class="alert alert-success" role="alert">
                      <?php echo $success_message;?>
                    </div>
                  <?php
                    }
                  ?>
                </div>
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post" id="signup-form">
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" name="name" class="form-control pl-15 bg-transparent" placeholder="Full name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" name="username" class="form-control pl-15 bg-transparent" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent">
                          <i class="fas fa-envelope"></i>
                        </span>
                      </div>
                      <input type="email" name="email" class="form-control pl-15 bg-transparent" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="input-group mb-0">
                      <div class="input-group-prepend">
                        <span class="input-group-text  bg-transparent">
                          <i class="fas fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" name="password" class="form-control pl-15 bg-transparent" placeholder="Password" required>
                    </div>
                  </div>
                  <div id="strengthMessage"></div>
                  <div class="form-group mb-0">
                    <div class="input-group mb-0">
                      <div class="input-group-prepend">
                        <span class="input-group-text  bg-transparent">
                          <i class="fas fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" name="password_confirm" class="form-control pl-15 bg-transparent" placeholder="Password Confirm" required>
                    </div>
                  </div>
                  <span class="confirm-message" id='password-confirm-message'></span>
                  <div class="row mt-2">
                    <div class="col-12">
                      <div class="checkbox">
                        <input type="checkbox" id="basic_checkbox_1" required>
                        <label for="basic_checkbox_1">
                          I agree to the
                          <a href="#" class="text-warning"><b>Terms</b></a>
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-info mt-2">SIGN UP</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
                <div class="text-center">
                  <p class="mt-1 mb-0">Already have an account?
                    <a href="login.php" class="text-danger ml-1">Login</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
