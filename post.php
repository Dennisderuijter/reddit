<?php
  $path = '';
  require $path.'backend/connect.php';
  include $path.'backend/auth.php';
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
  	<link rel="stylesheet" type="text/css" href="assets/css/post.css">

  </head>
  <body>

    <?php include $path.'views/header.php'; ?>

    <div class="container">
      <?php
      $postid = $_GET['postid'];
      $sql = "SELECT * FROM posts WHERE id = '$postid'";
      $result = $conn->query($sql);
      while($row = mysqli_fetch_array($result)) {
        echo '<h2 class="postTitle">' . $row['title'] . '</h2>
        <span class="author">Posted by <a href="'.$path.'u/user.php?u=' . $row['author'] . '"><b>' . $row['author'] . '</b></a></span>
        <div class="postMessage">' . $row['content'] . '</div><div class="replyOnPost"></div><div class="main-reply-box"></div>';
      }
      ?>
      <div id="output"></div>
    </div>

  	<!-- JavaScript -->
  	<script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="comments.js"></script>

    <script type="text/javascript">
      var postId = "<?php echo $_GET['postid'] ?>";
    </script>

  </body>
</html>