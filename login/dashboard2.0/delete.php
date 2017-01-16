<!DOCTYPE html>
<html lang='en'>

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
	<link rel = 'icon' href = '../../swapmart.ico'/>

    <title>SwapMart</title>
	
    <!-- Bootstrap Core CSS -->
    <link href='../../css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link href='../../css/creative.css' rel='stylesheet'>
    <link href='../../css/dashboardcss.css' rel='stylesheet'>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' href='font-awesome/css/font-awesome.min.css' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
    <![endif]-->

</head>

<body>

    <div class='swapmart'>Delete Account&nbsp;<i class = 'fa fa-frown-o fa-1x wow bounceIn tada'></i></div>
    <div class='welcome_dashboard'> <?php session_start();echo $_SESSION['fname'];echo '&nbsp;'.$_SESSION['lname'];?></div>

	<div class='row'>
		<div class='box'>
			<div class='col-lg-8 col-lg-offset-2 text-center'>
			
	<?php 
	require('../connect.php');
	$feedback = null;
	$uname = $_SESSION['username'];
	#verifying if the user had verified his email id . if not he can never re live his account warning is generated
	$sql_verify_email_check ="SELECT status from `user` WHERE `user`.`username` = '$uname';";
	$res_verify_email_check = mysqli_query($conn,$sql_verify_email_check);
	$row_verify_email_check = mysqli_fetch_assoc($res_verify_email_check);
	if($row_verify_email_check['status']==2){
		echo "<p class = ''>You have not verified your email. If you delete now, you would have to CREATE new login to access SWAPMART.</p>";
	}
	#submitted form
	if(isset($_POST['submit'])) {
		#now update the table
		$feedback = validate_input_data($_REQUEST['feedback']);
		if($row_verify_email_check['status']==2){
		    $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
		    $res = mysqli_query($conn,$sql);
		    $row = mysqli_fetch_assoc($res);
		    if($row["admin"] == "master"){
		        $_SESSION["msg"] = "You are Web Master! You cannot delete your account.";
		        header("Location: index.php#acct");
            }
            else{
                $sql1 ="DELETE FROM `user` WHERE `user`.`username` = '$uname';";
                $sql = "DELETE FROM `advertisement` WHERE `username` = '$uname';";
                $res = mysqli_query($conn,$sql);
                $sql = "DELETE FROM `bookmark` WHERE `username` = '$uname';";
                $res = mysqli_query($conn,$sql);
                $sql = "SELECT * FROM `chatbox` WHERE `uname` = '$uname' or `advertUname` = '$uname';";
                $res = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($res);
                for ($i=0;$i<$num;$i++){
                    $row = mysqli_fetch_assoc($res);
                    $chat = $row["chat"];
                    $chat = $chat."<br/><br/><-----##--".$uname."--DELETED--SWAPMART--ACCOUNT--##-----><br/><br/>";
                    $sql = "UPDATE `chatbox` SET `chat` = '$chat' WHERE `uname` = '$uname' or `advertUname` = '$uname';";
                    $res = mysqli_query($conn,$sql);
                }
            }
        }
		else {
            $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            if ($row["admin"] == "master") {
                $_SESSION["msg"] = "OMG! You are Web Master! You cannot delete your account.";
                header("Location: index.php#acct");
            } else {
                $sql = "DELETE FROM `advertisement` WHERE `username` = '$uname';";
                $res = mysqli_query($conn, $sql);
                $sql = "DELETE FROM `bookmark` WHERE `username` = '$uname';";
                $res = mysqli_query($conn, $sql);
                $sql = "SELECT * FROM `chatbox` WHERE `uname` = '$uname' or `advertUname` = '$uname';";
                $res = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($res);
                for ($i = 0; $i < $num; $i++) {
                    $chat = "<br/><br/><-----##--" . $uname . "--DELETED--SWAPMART--ACCOUNT--##-----><br/><br/>";
                    $sql = "UPDATE `chatbox` SET `chat` = '$chat', `status` = 'sent' WHERE `uname` = '$uname' or `advertUname` = '$uname';";
                    $res = mysqli_query($conn, $sql);
                }
                $sql1 = "UPDATE `user` SET `status` = '0', `feedback` = '$feedback', `num_of_add` = '0' WHERE `user`.`username` = '$uname';";
                $sql2 = "INSERT INTO `user_do_not_login` (`username`, `status`, `reason_for_no_access`, `when_no_access`) VALUES ('$uname', '0', 'deleted', CURRENT_TIMESTAMP);";
                $res1 = mysqli_query($conn, $sql1);
                $res2 = mysqli_query($conn, $sql2);
                $res3 = mysqli_query($conn, "SELECT * from `user` WHERE `username` = '$uname';");
                $row  = mysqli_fetch_assoc($res3);
                #send an email alerting request in change in data
                $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                $from = "From: manasviniganesh@gmail.com";
                $to = $row['email'];
                $subject = "Account TERMINATED";
                $fname = $row['first_name'];
                $lname = $row['last_name'];
                $body = "Hi $fname $lname, \n You had requested to delete your account at SwapMart. We are sorry to see you go. You gave the following as feedback : \n $feedback. \n Project SwapMart \n Manasvini Ganesh";
                mail($to,$subject,$body,$from);
                require("logout.php");
            }
        }
	}
	#not submitted form
	else {
		echo "<p class = 'text-center'><form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>Why are you doing this?<i class = 'red'>*</i>&nbsp;</b><br/></h3><h5 class = 'red'><textarea rows = '7' cols = '60' name = 'feedback' value = '$feedback'/></textarea></h5><h3 class='section-heading'><b class ='form_field_title'><br/><br/></h3>&nbsp;</b><button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'red fa fa-2x fa-heartbeat wow tada'></i> Delete </button></form></p>";
	}
	function validate_input_data($data){
		$data=htmlspecialchars(stripcslashes(trim($data)));
		return $data;
	}
			
	mysqli_close($conn);
	?>

		</div>
		</div>
	</div>
</body>
    <!-- jQuery -->
    <script src='../../js/jquery.js'></script>
	<!-- Bootstrap Core JavaScript -->
    <script src='../../js/bootstrap.min.js'></script>

</html>
