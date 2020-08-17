<?php
require 'connect.php';

if (!empty($_GET['key'])) {
  $activation_key = $_GET['key'];
  $activated_at = date('Y-m-d H:i:s');
  echo $activated_at;
  $sql = "UPDATE users SET is_activated = 1, activated_at = '$activated_at' WHERE activation_key = '$activation_key'";
  if (mysqli_query($conn, $sql)) {
    $sql = "SELECT * FROM users WHERE activation_key = '$activation_key'";
    $result = mysqli_query($conn, $sql);
    $account = mysqli_fetch_assoc($result);
    if (!empty($account)) {
      $_SESSION['logged_in_user'] = array("name" => $account['name'], "username" => $account['username'], "email" => $account['email'], "activated_at" => date("H:i:s d-m-Y", strtotime($account['activated_at'])));
    }
    header("Location: index.php");
    exit();
  }
  else {
    echo "Can't activate your account";
  }
}
mysqli_close($conn);
?>
