<?php
// Array containing sample image file names
$imgspath = "../images/";
$images = scandir($imgspath);
if(isset($_FILES['image'])){
  $count = count($_FILES['image']['name']);
  for ($i = 0; $i < $count; $i++) {
    $errors= array();
    $file_name = $_FILES['image']['name'][$i];
    $file_size =$_FILES['image']['size'][$i];
    $file_tmp =$_FILES['image']['tmp_name'][$i];
    $file_type=$_FILES['image']['type'][$i];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'][$i])));

    $extensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)=== false){
      $errors[]="Image" . $i+1 . ": Extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
      $errors[]='Image ' . $i+1 . ': File size must be excately 2 MB';
    }

    if(empty($errors)==true) {
      if (file_exists($imgspath.$file_name)) {
        unlink($imgspath . $file_name);
      }

      move_uploaded_file($file_tmp,"../images/".$file_name);
      echo "<div class='alert alert-success'>Image " . ($i+1) . ": Success</div>";
      $images = scandir($imgspath);
    }
    else {
      foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }
    }
  }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Simple Image Gallery</title>
  <style type="text/css">
    *, ::after, ::before {
      box-sizing: border-box;
    }

    .upload-form {
      width: 500px;
      margin: 20px auto;
      padding: 10px;
    }

    .upload-form {
      font-weight: 600;
      font-size: 18px;
    }

    .preview-image {
      width: 288px;
      height: 200px;
      margin-bottom: 20px;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px;
    }

    .img-box {
      text-align: center;
      padding: 20 20px;
      position: relative;
      width: 100%;
      flex: 25%;
      max-width: 25%;
    }

    .image {
      height: 200px;
    }

    .image img {
      width: 100%;
      height: 100%;
    }
  </style>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script>
    $(document).ready(function(){
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#preview-img').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $('input[name="image"').change(function() {
        readURL(this);
      });
    });
  </script>
</head>

<body>
  <div class="upload-form">
    <p class="preview-title">Preview Image</p>
    <img class="preview-image" id="preview-img">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      <input type="file" name="image[]" multiple required="" />
      <input type="submit"/>
    </form>
  </div>
  <div class="row">
    <?php
      // $images = array("image-1.png", "image-2.jpg", "image-3.jpg");

      // Loop through array to create image gallery
      foreach($images as $image){

        if (is_file($imgspath . $image)) {
          echo '<div class="img-box">';
            echo '<div class="image">';
              echo '<img src="../images/' . $image . '"alt="' .  pathinfo($image, PATHINFO_FILENAME) .'">';
            echo '</div>';
            echo "<div>$image</div>";
            echo '<div><a href="download.php?file=' . urlencode($image) . '">Download</a></div>';
          echo '</div>';
        }
      }
    ?>
  </div>
</body>
</html>
