<?php
	session_start();
    $uname = $_SESSION["username"];
    require ("../connect.php");
    $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    if($row["demo"] == '1'){
        $sql = "UPDATE `user` SET `admin` = 'user', `demo` = '0' WHERE `username` = '$uname'";
        $res = mysqli_query($conn,$sql);
        if(isset($_SESSION["demo"]))
            $_SESSION["demo"]=false;
    }
    if($row["demo"] == '2'){
        $sql = "UPDATE `user` SET `status` = '2', `demo` = '0' WHERE `username` = '$uname'";
        $res = mysqli_query($conn,$sql);
        $sql = "DELETE FROM `advertisement` WHERE `username` = '$uname'";
        $res = mysqli_query($conn,$sql);
        if(isset($_SESSION["demo"]))
            $_SESSION["demo"]=false;
    }
    $_SESSION["login"]=false;
    session_unset();
    if(session_destroy()){
		echo "Session Destroyed!";
	}
	echo "Logging out..";
	header("Location: ../../swapmart/index.php");
?>