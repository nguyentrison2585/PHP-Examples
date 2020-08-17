<?php
require('connect.php');
$login_errors = array();

if (isset($_SESSION['logged_in_user'])) {
  header("Location: index.php");
}
else {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5(md5($_POST['password']));
    if ($username != "" && $password != "") {
      $sql = "SELECT * FROM users WHERE (username='$username' or email='$username') and password='$password'";
      $result = mysqli_query($conn, $sql);
      $account = mysqli_fetch_assoc($result);
      if (count($account) > 0) {
        if ($account['is_activated'] == 1) {
          $_SESSION['logged_in_user'] = array("name" => $account['name'], "username" => $account['username'], "email" => $account['email'], "activated_at" => date("H:i:s d-m-Y", strtotime($account['activated_at'])));

          if (!empty($_POST['remember'])) {
            setcookie('username', $_POST['username'], time() + (10 * 365 * 24 * 60 * 60));
          }
          else {
            setcookie('username', "", time() - 60);
          }

          header("Location: index.php");
          exit();
        }
        else {
          array_push($login_errors, "Your account has not been activated! Please check your email to activate your account.");
        }
      }
      else {
        array_push($login_errors, "Username or passord are incorrect!");
      }
    }
    else {
      array_push($login_errors, "Use have not entered username or password!");
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

  <title>Login</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/88e95e70fb.js" crossorigin="anonymous"></script>
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
                  <?php foreach ($login_errors as $login_error) {?>
                    <div class="alert alert-warning" role="alert">
                      <?php echo $login_error;?>
                    </div>
                  <?php }
                  ?>
                </div>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" name="username" class="form-control pl-15 bg-transparent" placeholder="Username/Email" value="<?php echo isset($_COOKIE['username'])?$_COOKIE['username']:""?>"required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text  bg-transparent">
                          <i class="fas fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" name="password" class="form-control pl-15 bg-transparent" placeholder="Password" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="checkbox">
                        <input type="checkbox" name="remember" id="basic_checkbox_1" <?php echo isset($_COOKIE['username'])?"checked":"" ?>>
                        <label for="basic_checkbox_1">Remember Me</label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                     <div class="fog-pwd text-right">
                        <a href="forgot_password.php" class="hover-warning">
                          <i class="ion ion-locked"></i>Forgot password?
                        </a><br>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 text-center p-2">
                      <button type="submit" class="btn btn-danger mt-1">LOGIN</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
                <div class="text-center">
                  <p class="mt-15 mb-0">Don't have an account? <a href="sign_up.php" class="text-warning ml-1">Sign Up</a></p>
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
