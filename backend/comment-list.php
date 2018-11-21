<?php
session_start();
require_once ("connect.php");
$postid = isset($_GET['postid']) ? $_GET['postid'] : "";

$sql = "SELECT * FROM comments WHERE post_id = '$postid' ORDER BY parent_id asc, id asc";

$result = mysqli_query($conn, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);

mysqli_close($conn);
echo json_encode($record_set);
?>