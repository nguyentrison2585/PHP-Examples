<?php
function write_to_file($filepath) {
  $file = fopen($filepath, "w");

  if ($file ==false) {
    echo ("Error in opening file!");
    exit();
  }

  for ($i = 0; $i < 10; $i++) {
    fwrite($file, "This is a simple text\n");
  }
  fclose($file);
}

function read_the_file($filepath) {
  $file = fopen($filepath, "r");

  if ($file == false) {
    echo("Error in opening file!");
    exit();
  }

  $filesize = filesize($filepath);
  $filecontent = fread($file, $filesize);

  fclose($file);
  echo ("File size: $filesize bytes<br>");
  echo ("Content of file $filepath is: $filecontent<br>");
}

function read_each_line($filepath) {
  $content = file($filepath);

  echo "Content of each line in the file:<br>";
  foreach($content as $line) {
    echo $line . "<br>";
  }
}

setcookie("name", "Nguyen Tri Son", time() + 3600, "/", "", 0);
echo $_SERVER['SCRIPT_NAME'] . "<br>";
echo $_SERVER['PHP_SELF'] . "<br>";
echo $_SERVER['HTTP_HOST'] . "<br>";
echo $_SERVER['SCRIPT_URI'] . "<br>";
echo "Hello " . $_POST['name'] . "!<br>";
echo "You are " . $_POST['age'] . " years old.<br>";
session_start();
$_SESSION['name'] = $_POST['name'];
$_SESSION['age'] = $_POST['age'];
?>

<!DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8">
      <title>Writing a file using PHP</title>
   </head>
   <body>
    <?php
    $filepath = "newfile.txt";
    write_to_file($filepath);
    read_the_file($filepath);
    read_each_line($filepath);
    if (isset($_COOKIE["name"])) {
      echo "Welcome " . $_COOKIE["name"];
    }
    else {
      echo "Sorry... You didn't set cookie";
    }
    if (!isset($_SESSION['name'])) {
      ?>
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <p>Name: <input type="text" name="name" /></p>
      <p>Age: <input type="text" name="age" /></p>
      <p><input type="submit" name="submit" value="Submit" /></p>
    </form>
    <?php
    }
    ?>

  </body>
</html>
