<?php
  $path = '';
  require $path.'backend/connect.php';
  include $path.'backend/auth.php';
?>

<?php 
if (!isset($_POST['submit'])) {
?>

<html>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reddit comment systeem</title>

    <!-- jQuery source -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/reddit/assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="/reddit/assets/css/style.css">

  </head>
  <body>

    <?php include $path.'views/header.php'; ?>

    <div class="container">
      <form enctype="multipart/form-data" action="newpost.php" method="post">
        <div><input required type="text" name="newPostTitle" placeholder="Title"></div>
        <div><textarea required name="newPostContent" placeholder="content"></textarea></div>
        <div><input type="file" name="file"></div>
        <div><input type="submit" name="submit" value="Save"></div>
      </form>
    </div>

    <!-- JavaScript -->
    <script type="text/javascript" src="/reddit/script.js"></script>

  </body>
</html>

<?php
}
else {
  $dir = $path.'assets/posts/';
  $file = $dir.basename($_FILES['file']['name']);
  $name = $_FILES['file']['tmp_name'];
  $maxsize    = 2097152;
  $acceptable = array(
    'image/jpeg',
    'image/jpg',
    'image/png'
  );
  if (($_FILES['file']['size'] <= $maxsize) && (in_array($_FILES['file']['type'], $acceptable))){
    if (move_uploaded_file($name, $file)) {
      echo "file upload status: succes.";
      $title    = isset($_POST['newPostTitle'])   ? $_POST['newPostTitle']    : "";
      $content  = isset($_POST['newPostContent']) ? $_POST['newPostContent']  : "";
      $author   = isset($_SESSION['username'])    ? $_SESSION['username']     : "";
      $date     = date('Y-m-d H:i:s');

      $sql = "INSERT INTO posts(title,content,author,datetime,img) VALUES ('" . $title . "','" . $content . "','" . $author . "','" . $date . "','" . $_FILES['file']['name'] . "')";
      $result = mysqli_query($conn, $sql);
      if (! $result) {
          $result = mysqli_error($conn);
      }
      header("Location: index.php");
    }
    else {
      echo "file upload status: failed.";
      echo "<pre>";
      print_r($_FILES['file']['error']);
      echo "</pre>";
    }
  } else {
    echo "file upload status: failed.";
    echo "<br>";
    echo "file must be less than 2 megabytes and only JPG / PNG types are accepted.";
  }
  echo "<br>";
  echo "<a href='".$path."index.php '>Go back</a>";
}
?>