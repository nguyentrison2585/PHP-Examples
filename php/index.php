<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../images/favicon.ico">

  <title>Home</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/88e95e70fb.js" crossorigin="anonymous"></script>
  <script src="../js/index.js"></script>
</head>
<body>
  <div class="container text-center mt-3">
    <?php
    if (isset($_SESSION['logged_in_user'])) {
      echo 'Welcome ' . $_SESSION['logged_in_user']['name'];
      echo ', your account has been activated at ' . $_SESSION['logged_in_user']['activated_at'];
    ?>
    !<br>You have logged in.
    <a href="logout.php" id="logout-btn" class="btn btn-primary">Logout</a>
    <?php }
    else {
    ?>
    <a href="login.php" class="btn btn-primary">Login</a>
    <a href="sign_up.php" class="btn btn-primary ml-3">Sign up</a>
    <?php } ?>
  </div>
</body>
</html>
