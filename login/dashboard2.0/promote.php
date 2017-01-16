<?php
require ("../connect.php");

$query = $_SERVER["QUERY_STRING"];
parse_str($query,$magic);
$role  = $magic["role"];
$uname = $magic["uname"];

if(!isset($_SESSION["username"])){
    session_start();
}
if($role == "verified"){
    $_SESSION["demo"] = "verified";
    $sql = "UPDATE `user` SET `status` = 1, `demo` = '2' WHERE `username` = '$uname'";
    $res = mysqli_query($conn,$sql);
}
else{
    $_SESSION["demo"] = true;
    $sql = "UPDATE `user` SET `admin` = '$role', `demo` = '1' WHERE `username` = '$uname'";
    $res = mysqli_query($conn,$sql);
}
header("Location: index.php");
?>