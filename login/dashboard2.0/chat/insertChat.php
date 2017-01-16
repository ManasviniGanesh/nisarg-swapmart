<?php
session_start();
require ("../../connect.php");
date_default_timezone_set("Asia/Kolkata");
$uname = $_SESSION["username"];
#22 character time
$time = "[" . date("d M Y H:i:s") . "]";
$msg = $_POST["msg"];
$msg = $time . " " . $uname . ":" . $msg;
$addID = $_POST["addID"];
$title = $_POST["title"];

if($_POST["mode"] == "Enquire") {
    $advertUname = $_POST["advertUname"];
    $sql = "SELECT * FROM `chatbox` WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname';";
    $res = mysqli_query($conn, $sql);
    $num;
    if (isset($res) and $res)
        $num = mysqli_num_rows($res);
    else
        $num = 0;

    if ($num == 0) {
        $sql = "INSERT INTO `chatbox`(`add_id`, `uname`, `advertUname`, `chat`,`status`) VALUES ('$addID','$uname','$advertUname','$msg','sent')";
        $res = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM `chatbox` WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname';";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
    } else {
        $row = mysqli_fetch_assoc($res);
        $chat = $row["chat"];
        $chat = $chat . "<br/>" . $msg;
        $sql = "UPDATE `chatbox` SET `chat` = '$chat', `status` = 'sent' WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname' ";
        $res = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM `chatbox` WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname';";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
    }
    $_SESSION['chat'] = isset($row["chat"]) ? $row["chat"] : null;
    header("Location: index.php?mode=enquire&addID=$addID&title=$title&advertUname=$advertUname");
}
if($_POST["mode"] == "Respond"){
    $uname = $_POST["enquirerUname"];
    $advertUname = $_SESSION["username"];
    $sql = "SELECT * FROM `chatbox` WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $chat = $row["chat"];
    $chat = $chat . "<br/>" . $msg;
    $sql = "UPDATE `chatbox` SET `chat` = '$chat', `status` = 'reply' WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname' ";
    $res = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM `chatbox` WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $_SESSION['chat'] = isset($row["chat"]) ? $row["chat"] : null;
    header("Location: index.php?mode=respond&addID=$addID&title=$title&enquirerUname=$uname");
}
?>