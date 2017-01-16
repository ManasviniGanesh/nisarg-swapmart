<?php
#set values for everything to connect
/**$servername = "mysql.hostinger.in";
$username_server = "u478684902_manu";
$password_server = "M@n@5v1n1";
$dbname = "u478684902_mart";
#executing connection
$conn = mysqli_connect($servername,$username_server,$password_server,$dbname);
if(!$conn){
echo "Oops! Connection Failed";
}**/

$servername = "localhost";
$username_server = "root";
$password_server = "";
$dbname = "swapmart";
#executing connection
$conn = mysqli_connect($servername,$username_server,$password_server,$dbname);
if(!$conn){
    echo "Oops! Connection Failed";
}
?>