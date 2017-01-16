<?php
session_start();
$addID = "$_SERVER[QUERY_STRING]";
$addID = substr($addID,3);
$uname = $_SESSION["username"];

require ("connect.php");
$sql = "SELECT * FROM `advertisement` WHERE `add_id` = '$addID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);

$title = $row["title_of_add"];
$pic_upload_dir = $row["pic_upload_dir"];
$cost = $row["cost"];
$priceStatus = $row["price_status"];
$rent = null;
if($priceStatus==1){
    $rent = $row["rent"];
}
$sql = "INSERT INTO `bookmark` (add_id,username,title_of_add,cost,rent,pic_upload_dir) VALUES ('$addID','$uname','$title','$cost','$rent','$pic_upload_dir')";
$res = mysqli_query($conn,$sql);
header("Location: bookmark.php?id=$addID");
?>