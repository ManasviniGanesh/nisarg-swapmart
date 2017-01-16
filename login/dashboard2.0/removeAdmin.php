<?php
$uname = $_SERVER[QUERY_STRING];
$uname = substr($uname,5);
require ("../connect.php");
$sql = "UPDATE `user` SET `admin`= 'user' WHERE `username` = '$uname'";
$res = mysqli_query($conn,$sql);
header("Location: index.php#users");
?>