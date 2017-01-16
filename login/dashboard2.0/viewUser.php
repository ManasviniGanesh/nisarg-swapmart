<?php
if (isset($_POST['viewUser'])){
    require ("../connect.php");
    $status = $_POST['viewUser'];

    if(is_null($status)){
        $sql = "SELECT * FROM `user`";
        $_SESSION["msg"] = "All users.";
    }
    else {
        if(is_numeric($status)){
            $sql = "SELECT * FROM `user` WHERE `status` = '$status'";
            $_SESSION["msg"] = "Requested users.";
        }
        else{
            $sql = "SELECT * FROM `user` WHERE `admin` = '$status'";
            $_SESSION["msg"] = "Requested $status"."s.";
        }
    }
    $res = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($res);
    if($num==0){
        $_SESSION["msg"] = "None such users.";
    }
}
?>
