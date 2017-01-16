<?php
/**
 * Created by PhpStorm.
 * User: Manasvini Ganesh
 * Date: 14-01-2017
 * Time: 21:39
 */
require ("../connect.php");
$id = substr($_SERVER["QUERY_STRING"],3);
$sql = "DELETE FROM `report` WHERE `id` = '$id'";
$res = mysqli_query($conn,$sql);
header("Location: index.php");
?>