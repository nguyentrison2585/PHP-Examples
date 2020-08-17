<?php
$host = "localhost";
$username = "root";
$password = "sonditnhon1";
$dbname = "homework";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
?>
