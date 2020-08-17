<?php
require 'connect.php';
require 'send_email_function.php';

if (isset($_SESSION['logged_in_user'])) {
  header("Location: index.php");
}
else {
  if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if ($email != "") {
      $reset_password_key = md5($email . date());
      $time_reset_exprire = date('Y-m-d H:i:s', strtotime('+2 hours'));
      $sql = "UPDATE users set reset_password_key = '$reset_password_key', time_reset_exprire = '$time_reset_exprire', is_reset_exprired = 0 WHERE email = '$email'";
      if (mysqli_query($conn, $sql)) {
        $link = 'http://localhost/PHPExamples/php/reset_password.php?key=' . $reset_password_key;
        send_email_to($email, $link, "reset");
        $success_message = "Reset password email has been sent, check your email to reset the password.";
      }
    }
    else {
      $error = "You have not enter the email!";
    }
  }
}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../images/favicon.ico">
  <style type="text/css">
    *, ::after, ::before {
      box-sizing: border-box;
    }

    .container {
      text-align: center;
    }
    .send-block {
      padding-top: 50px;
    }
  </style>
  <title>Forgot password</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/88e95e70fb.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="main">
  <div class="container">
    <div class="resetpass-wrap">
      <div class="resetpass-content">
        <div class="resetpass-title">
          Forgot password
        </div>
        <?php
          if (isset($error)) {
        ?>
          <div class="alert alert-warning" role="alert">
            <?php echo $error; ?>
          </div>
        <?php } ?>
        <?php
          if (isset($success_message)) {
        ?>
          <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
          </div>
        <?php } ?>
        <div class="resetpass-form">
          <form action="" method="post" id="forgot-password-form">
            <div class="form-group">
              <label>Enter your email to reset password</label>
              <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <button class="btn btn-success" type="submit">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
