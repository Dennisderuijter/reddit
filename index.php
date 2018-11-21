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
  	<link rel="stylesheet" type="text/css" href="/reddit/assets/css/style.css">

  </head>
  <body>

    <?php include $path.'views/header.php'; ?>

    <div class="container">
      <?php
        $sql = "SELECT * FROM posts";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_array($result)) {
          echo '
          <div class="post">
            <a href="post.php?postid=' . $row['id'] . '">
              <div class="postImg">
                <img src="'.$path.'assets/posts/' . $row['img'] . '">
              </div>
            </a>
            <div class="postInfo">
              <a href="post.php?postid=' . $row['id'] . '">
                <span class="postTitle">' . $row['title'] . '</span>
              </a><br>
              <span class="author">Posted by <a href="'.$path.'u/user.php?u=' . $row['author'] . '"><b>' . $row['author'] . '</b></a></span>
            </div>
          </div>';
          echo '<div class="clear"></div>';
          echo '<div class="line"></div>';
        }
      ?>
    </div>

  	<!-- JavaScript -->
  	<script type="text/javascript" src="script.js"></script>

  </body>
</html>
