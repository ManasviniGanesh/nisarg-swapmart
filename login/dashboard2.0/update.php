<?php
    session_start();
    if(is_null($_SESSION['fname'])){
        header("Location: ../index.php");
    }
?>
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

    <div class='swapmart'>Update Credentials</div>
    <div class='welcome_dashboard'>Welcome <?php echo $_SESSION['fname'];echo '&nbsp;'.$_SESSION['lname'];?></div>
    

	<div class='row'>
		<div class='box'>
			<div class='col-lg-8 col-lg-offset-2 text-center'>
			<?php 
			require('../connect.php');
			$username_old = $password_old = $confirm_password_old = $mobile_old = $email_old = $fname_old = $lname_old = null;
			$username = $password = $confirm_password = $mobile = $email = $fname = $lname = null;
			$username = $_SESSION['username'];
			#setting up old values so that an update can be flagged
			$sql = "SELECT * from user WHERE username = '$username'";
			$res = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($res);
			$fname_old = $row['first_name'];
			$lname_old = $row['last_name'];
			$username_old = $row['username'];
			$password_old = $row['password'];
			$mobile_old = $row['mobile'];
			$email_old = $row['email'];
			#submitted form
			if(isset($_POST['submit'])) {
				#setting input to variables
				$fname = validate_input_data($_REQUEST["fname"]);
				$lname = validate_input_data($_REQUEST["lname"]);
				$username = validate_input_data($_REQUEST["username"]);
				$password = stripcslashes(trim($_REQUEST["password"]));
				$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
				$mobile = validate_input_data($_REQUEST["mobile"]);
				$email = validate_input_data($_REQUEST["email"]);
				#checking and notification if any field is empty
				if(empty($_POST['fname']) or empty($_POST['username']) or empty($_POST['password']) or empty($_POST['confirm_password']) or empty($_POST['mobile']) or empty($_POST['email'])){
					if(empty($_POST['fname'])){
						$fname = $fname_old;
					} 
					if(empty($_POST['username'])){
						$username = $username_old;
					} 
					if(empty($_POST['password'])){
						$password = $password_old;
					} 
					if(empty($_POST['confirm_password']) and !empty($_POST['password'])){
						#password Confirmation required
						echo "<p class = ''>Password Confirmation is required.</p>";
						echo "<p class = 'text-center'><form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password<i class = 'red'></i>&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Back </a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form></p>";
					} 
					if(empty($_POST['mobile'])){
						$mobile = $mobile_old;
					} 
					if(empty($_POST['email'])){
						$email = $email_old;
					}
				}
				else{
					if($fname!=$fname_old or $lname!=$lname_old or $password!=$password_old or $email!=$email_old or $mobile!=$mobile_old or $username!=$username_old){
						echo "<p class = ''>Field Modified.";
						$modified=false;
						if($fname!=$fname_old){
							if(validate_name($fname)){
								echo "<br/><i class = 'fa fa-arrow-circle-o-right fa-2x wow bounceIn tada'></i> <b>First Name $fname</b>";
								$modified=true;
							}
						}
						if($lname!=$lname_old){
							if(validate_name($lname)){
								echo "<br/><i class = 'fa fa-arrow-circle-o-right fa-2x wow bounceIn tada'></i> <b>Last Name $lname</b>";
								$modified=true;
							}
						}
						if($password!=$password_old){
							if(validate_password()){
								echo "<br/><i class = 'fa fa-arrow-circle-o-right fa-2x wow bounceIn tada'></i> <b>Password $password</b>";
								$modified=true;
							}
						}
						if($email!=$email_old){
							if(validate_email()){
								echo "<br/><i class = 'fa fa-arrow-circle-o-right fa-2x wow bounceIn tada'></i> <b>Email $email</b>";
								$modified=true;
							}
						}
						if($username!=$username_old){
							if(validate_username($username)){
								echo "<br/><i class = 'fa fa-arrow-circle-o-right fa-2x wow bounceIn tada'></i> <b>User Name $username</b>";
								$modified=true;
							}
						}
						if($mobile!=$mobile_old){
							if(validate_mobile()){
								echo "<br/><i class = 'fa fa-arrow-circle-o-right fa-2x wow bounceIn tada'></i> <b>Mobile Number $mobile</b>";
								$modified=true;
							}
						}
						echo "</p>";
						if($modified){
							$pass=$password;
							require("../connect.php");
							$sql_update = "UPDATE `user` SET `first_name` = '$fname', `last_name` = '$lname', `username` = '$username', `password` = '$pass', `mobile` = '$mobile', `email` = '$email' WHERE `user`.`username` = '$username_old'";
							$res = mysqli_query($conn,$sql_update);
							$_SESSION['fname']=$fname;
							$_SESSION['username']=$username;
							$_SESSION['lname']=$lname;
						}
                        echo "<a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-adjust fa-2x wow bounceIn tada'></i>kay </a>";
                    }
					else{
						echo "<p class= ''>No Field Modified.</p>";
                        echo "<a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-adjust fa-2x wow bounceIn tada'></i>kay </a>";
					}
				}
					
					
					/*#now to accept the data and update the table
					if(validate_name($fname) and validate_name($lname) and validate_username($username_old) and validate_password()and validate_mobile() and validate_email()){
						#send an email alerting request in change in data
						$from = "manasviniganesh@gmail.com";
						$to = $email_old;
						$subject = "Change in Data";
						$body = "<br/>Hi $fname $lname,<br/> You had requested change in credentials at SwapMart. Please verify and confirm it. <br/>First Name : $fname <br/> Last Name : $lname <br/> username: $username <br/> Password : $password <br/> Mobile no. : $mobile <br/> E Mail ID : $email";
						if(mail('manasviniganesh@gmail.com',$subject,$body,$from)){
							echo "<p class = ''>Mail has been sent to your registered mail address.</p>";
						}
						else{
							echo "<p class = ''>Oops Please try again later.</p>";
						}
						#var_dump("mail('manasviniganesh@gmail.com',$subject,$body)");
					}*/
			}
			#not submitted form
			else {
				echo "<p class = 'text-center'><form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname_old'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname_old'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username_old'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password_old'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$password_old'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile_old'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'email' name = 'email' value = '$email_old'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> back</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form></p>";
			}
			
			/********************************************************************************************************************************************************/
			
			/***************************************************************Functions Below**************************************************************************/
			
			/********************************************************************************************************************************************************/
			function validate_input_data($data){
				$data=htmlspecialchars(stripcslashes(trim($data)));
				return $data;
			}
			function validate_username($username_old){
				#setting input to variables
				$fname = validate_input_data($_REQUEST["fname"]);
				$lname = validate_input_data($_REQUEST["lname"]);
				$entered_username = validate_input_data($_REQUEST["username"]);
				$password = stripcslashes(trim($_REQUEST["password"]));
				$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
				$mobile = validate_input_data($_REQUEST["mobile"]);
				$email = validate_input_data($_REQUEST["email"]);
				$username_correction_required=false;
				#length of username
				if(strlen($entered_username)>30){
					$username_correction_required=true;
					echo "<p class='section-heading form_field_title'>Too long. User Name must be less than 30 characters.<br/></p>";
				}
				if(strlen($entered_username)<1){
					$username_correction_required=true;
					echo "<p class='section-heading form_field_title'>Too short. User Name must be at least more than a character.<br/></p>";
				}
				if($entered_username==$username_old){
					$username_correction_required=false;
				}
				else{
					#availability of username in database
					require("../connect.php");
					$sql = "SELECT * from user WHERE username = '$entered_username'";
					$row_exists = mysqli_query($conn,$sql);
					if(mysqli_num_rows($row_exists)>=1){
						echo "<p class='section-heading form_field_title'>User Name $entered_username is not available.<br/></p>";
						$username=null;
						$password=$confirm_password;
						$username_correction_required=true;
					}	
				}
				if(!$username_correction_required){
					return true;
				}
				else{
					$entered_username=$username_old;
					echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name<i class = 'red'>*</i>&nbsp;</b><input type = 'text' name = 'username' value = '$entered_username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'email' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form>";
				}
			}
			#validate_password to check the constraints satisfacton
				function validate_password(){
					#setting input to variables
					$fname = validate_input_data($_REQUEST["fname"]);
					$lname = validate_input_data($_REQUEST["lname"]);
					$username = validate_input_data($_REQUEST["username"]);
					$password = stripcslashes(trim($_REQUEST["password"]));
					$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
					$mobile = validate_input_data($_REQUEST["mobile"]);
					$email = validate_input_data($_REQUEST["email"]);
					
					$password_correction_required=false;
					if(strlen($password)<8 and $password!=NULL){
						$password_correction_required=true;
						echo "<p class='section-heading form_field_title'>Password must be at least 8 characters long.<br/></p>";
					}
					if(strlen($password)>30){
						$password_correction_required=true;
						echo "<p class='section-heading form_field_title'>Too long. Password must be less than 30 characters.<br/></p>";
					}
					if($password!=$confirm_password){
						$password_correction_required=true;
						echo "<p class='section-heading form_field_title'>Passwords in both the fields should match.<br/></p>";
						$password=$confirm_password=null;
					}
					if($password_correction_required){
						echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'email' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> back</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form>";
					}
					if(!$password_correction_required){
						#check pass strength is not eligibile then edit it and if good set true
						if(password_strength($password)){
							return true;
						}
					}
				}
				#to strenghthen password
				function password_strength($password){
					#setting input to variables
					$fname = validate_input_data($_REQUEST["fname"]);
					$lname = validate_input_data($_REQUEST["lname"]);
					$username = validate_input_data($_REQUEST["username"]);
					$password = stripcslashes(trim($_REQUEST["password"]));
					$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
					$mobile = validate_input_data($_REQUEST["mobile"]);
					$email = validate_input_data($_REQUEST["email"]);
					$lower_case=$upper_case=$special_symbol=$numeric=false;
					$small_alpha = "abcdefghijklmnopqrstuvwxyz";
					$big_alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$digit = "0123456789";
					$special_symbol_list = "`~!@#$%^&*()-_=+[]{}|\:;'<,>.?/";
					#check the conditions
					$strlen = strlen($password);
					for($i=0;$i<$strlen;$i++){
						$j=0;
						while($j<strlen($small_alpha) and !$lower_case){
							if($password[$i]==$small_alpha[$j]){
								$lower_case=true;
								#echo "lower case is true";
							}
							$j++;
						}
						$j=0;
						while($j<strlen($big_alpha) and !$upper_case){
							if($password[$i]==$big_alpha[$j]){
								$upper_case=true;
								#echo "upper case is true";
							}
							$j++;
						}
						$j=0;
						while($j<strlen($digit) and !$numeric){
							if($password[$i]==$digit[$j]){
								$numeric=true;
								#echo "numeric is true";
							}
							$j++;
						}
						$j=0;
						while($j<strlen($special_symbol_list) and !$special_symbol){
							if($password[$i]==$special_symbol_list[$j]){
								$special_symbol=true;
								#echo "special symbol is true";
							}
							else{
								if(!$upper_case and !$lower_case and !$numeric){
									$spl_char = $password[$i];
									$special_symbol_list=$special_symbol_list.$spl_char;
									$special_symbol=true;
									#echo "special symbol is true";
								}
							}
							$j++;
						}
					}
					#if all conditions are satisfied return password
					if($lower_case and $upper_case and $special_symbol and $numeric ){
						return true;
					}
					else{
						echo "<p class='section-heading form_field_title'><i class= 'red'>Ops! You entered $password </i></p>";
						echo "<p class='section-heading form_field_title'>Password must have following properties - <br/> <ol type = '1'> <li> lower case characters </li> <li> upper case characters </li> <li> digits(0-9) </li> <li> special symbols (@,#,etc.) </li> </ol></p>";
						echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'email' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> back</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form>";
						}
				}
				#validate_name
				function validate_name($name){
					#setting input to variables
					$fname = validate_input_data($_REQUEST["fname"]);
					$lname = validate_input_data($_REQUEST["lname"]);
					$username = validate_input_data($_REQUEST["username"]);
					$password = stripcslashes(trim($_REQUEST["password"]));
					$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
					$mobile = validate_input_data($_REQUEST["mobile"]);
					$email = validate_input_data($_REQUEST["email"]);
					
					if(! preg_match("/^[a-zA-Z]*$/",$name)){
					echo "<p class='section-heading form_field_title'>Only letters are allowed.<br/></p>";
					echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name<i class = 'red'>*</i>&nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'email' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> back</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form>";
					}
					else{
						return true;
					}
				}
				#validate_mobile
				function validate_mobile(){
					#setting input to variables
					$fname = validate_input_data($_REQUEST["fname"]);
					$lname = validate_input_data($_REQUEST["lname"]);
					$username = validate_input_data($_REQUEST["username"]);
					$password = stripcslashes(trim($_REQUEST["password"]));
					$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
					$mobile = validate_input_data($_REQUEST["mobile"]);
					$email = validate_input_data($_REQUEST["email"]);
					
					#length of mobile number
					if(strlen($mobile)!=10){
					echo "<p class='section-heading form_field_title'>Invalid mobile number entered.<br/></p>";
					echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number<i class = 'red'>*</i>&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'email' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> back</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form>";
					}
					return $mobile;
				}	
				#vaildate_email
				function validate_email(){
					#setting input to variables
					$fname = validate_input_data($_REQUEST["fname"]);
					$lname = validate_input_data($_REQUEST["lname"]);
					$username = validate_input_data($_REQUEST["username"]);
					$password = stripcslashes(trim($_REQUEST["password"]));
					$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
					$mobile = validate_input_data($_REQUEST["mobile"]);
					$email = validate_input_data($_REQUEST["email"]);
					
					if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					echo "<p class='section-heading form_field_title'>Invaild Email.(eg. brain@fire.com)<i class = 'fa fa-fire'></i><br/></p>";
					echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID<i class = 'red'>*</i>&nbsp;</b><input type = 'email' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> back</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Update </button></form>";
					}
					else{
					return $email;
					}
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
