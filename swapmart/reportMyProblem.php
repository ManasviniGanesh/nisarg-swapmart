<?php
/**
 * Created by PhpStorm.
 * User: Manasvini Ganesh
 * Date: 14-01-2017
 * Time: 20:03
 */
?>
<?php
session_start();
if(isset($_POST["description"])){
    if(!($_POST["description"])){
        $_SESSION["reportMsg"]= "You didn't write anything. So we couldn't listen anything.";
        header("Location: report.php");
    }
    else{
        require ("connect.php");
        $id = $_POST["id"];
        $email = $_POST["email"];
        $description = $_POST["description"];
        $sql = "INSERT INTO `report` (`id`,`email`,`description`) VALUES ('$id','$email','$description')";
        $res = mysqli_query($conn,$sql);
        $_SESSION["reportMsg"]= "Our administrators will soon read the report and respond as soon as possible.";
        header("Location: report.php");
    }
}
?>
