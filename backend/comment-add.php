<?php
session_start();
require_once ("connect.php");
$postid = isset($_GET['postid']) ? $_GET['postid'] : "";
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$commentSenderName = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO comments(parent_id,comment,author,date,post_id) VALUES ('" . $commentId . "','" . $comment . "','" . $commentSenderName . "','" . $date . "','" . $postid . "')";

$result = mysqli_query($conn, $sql);

if (! $result) {
    $result = mysqli_error($conn);
}
echo $result;
?>
