<?php

session_start();
$uname = $_SERVER["QUERY_STRING"];
$uname = substr($uname,5);
require ("../connect.php");

if (isset($_POST['userAction']) and $_POST['userAction'] =='admin') {
    $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    if ($row['status'] == -1) {
        $_SESSION["msg"] = "Oops. '<i>$uname</i>' is Blocked. Can't make admin.";
    } else {
        $sql = "UPDATE `user` SET `admin`= 'admin' WHERE `username` = '$uname'";
        $res = mysqli_query($conn, $sql);
        if($res)
            $_SESSION["msg"] = "Yeay! '<i>$uname</i>' is now an admin.";
    }
}
if (!isset($_POST["userAction"]) or (isset($_POST['userAction']) and $_POST['userAction'] =='block')) {
    $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    if($row['status']== -1){
        #unblock user
        $sql = "UPDATE `user` SET `status` = '1' WHERE `username` = '$uname';";
        $res = mysqli_query($conn,$sql);
        if($res) {
            $sql = "DELETE FROM `user_do_not_login` WHERE `user_do_not_login`.`username` = '$uname'";
            $res = mysqli_query($conn, $sql);
            if($res)
                $_SESSION["msg"]= "'<i>$uname</i>' is un-blocked.";
        }
    }
    else {
        #block user
        $sql = "UPDATE `user` SET `status` = '-1' WHERE `username` = '$uname';";
        $res = mysqli_query($conn,$sql);
        $sql = "INSERT INTO `user_do_not_login` (`username`, `status`, `reason_for_no_access`, `when_no_access`) VALUES ('$uname','-1','Block by Admin/Web Master', CURRENT_TIMESTAMP)";
        $res = mysqli_query($conn,$sql);
        if($res)
            $_SESSION["msg"]= "'<i>$uname</i>' is blocked.";
    }
}
header("Location: index.php#users");
?>