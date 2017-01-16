<?php
session_start();
$addID = "$_SERVER[QUERY_STRING]";
$addID = substr($addID,3);
$uname = $_SESSION["username"];

require ("connect.php");
$sql = "DELETE FROM `bookmark` WHERE `add_id` = '$addID' and `username` = '$uname'";
$res = mysqli_query($conn,$sql);
header("Location: bookmark.php");
?>