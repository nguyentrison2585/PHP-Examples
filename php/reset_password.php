<?php
require 'connect.php';

if (isset($_SESSION['logged_in_user'])) {
  header("Location: index.php");
}
else {
  if (isset($_GET['key'])) {
    $reset_password_key = $_GET['key'];
    $sql = "SELECT time_reset_exprire, is_reset_exprired FROM users WHERE reset_password_key = '$reset_password_key'";
    $result = mysqli_query($conn, $sql);
    $account = mysqli_fetch_assoc($result);
    if ($account['is_reset_exprired'] == 1) {
      exit("You reset password key has exprired!");
    }
    else {
      if (date() > strtotime($account['time_reset_exprire'])) {
        exit("You reset password key has exprired!");
      }
      else {
        if (isset($_POST['password']) && isset($_POST['password_confirm'])) {
          if (($_POST['password'] != "") && ($_POST['password_confirm'] != "")) {
            if ($_POST['password'] == $_POST['password_confirm']) {
              $sql = "SELECT time_reset_exprire, is_reset_exprired FROM users WHERE reset_password_key = '$reset_password_key'";
              $result = mysqli_query($conn, $sql);
              $account = mysqli_fetch_assoc($result);
              if ($account['is_reset_exprired'] == 1) {
                exit("You reset password key has exprired!");
              }
              else {
                if (date() > strtotime($account['time_reset_exprire'])) {
                  exit("You reset password key has exprired!");
                }
                else {
                  $password = md5(md5($_POST['password']));
                  $sql = "UPDATE users set password = '$password', is_reset_exprired = 1 WHERE reset_password_key = '$reset_password_key'";
                  if (mysqli_query($conn, $sql)) {
                    header("Location: login.php");
                  }
                  else {
                    $reset_error = mysqli_error($conn);
                  }
                }
              }
            }
            else {
              $reset_error = "New password and password confirm do not match!";
            }
          }
          else {
            $reset_error = "You need to fill new password and password confirm!";
          }
        }
      }
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
  <title>Reset password</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://kit.fontawesome.com/88e95e70fb.js" crossorigin="anonymous"></script>
  <script src="../js/reset_password.js"></script>
</head>
<body>
  <div class= "main">
  <div class="container-fluid bg-br" style="padding:15px 0">
    <div class="container">
      <div class="resetpass-wrap">
        <div class="resetpass-content">
          <div class="resetpass-title">
            Reset password
          </div>
          <div class="resetpass-form">
            <?php
            if (isset($reset_error)) {
              ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $reset_error; ?>
              </div>
            <?php } ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="reset-password-form">
              <div class="form-group">
                <label>New password</label>
                <input class="form-control" required="true" id="password" type="password" name="password" placeholder="New password">
              </div>
              <div class="form-group">
                <label class="password-confirm-label">Password confirm</label>
                <div class="confirm-message" id='password-confirm-message'></div>
                <input class="form-control" required="true" id="password-confirm" type="password" name="password_confirm" placeholder="Password confirm">
              </div>
              <button class="btn btn-success" type="submit">
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
