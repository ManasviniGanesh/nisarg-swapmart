<!--=>Re Capthca-->
<?php
    session_start();
	require('../connect.php');
	$username = $password = $confirm_password = $mobile = $email = $fname = $lname = null;
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
		$_SESSION["username"] = $username;
		#checking and notification if any field is empty
		if(empty($_POST['fname']) or empty($_POST['username']) or empty($_POST['password']) or empty($_POST['confirm_password']) or empty($_POST['mobile']) or empty($_POST['email'])){
			echo "<p class='section-heading form_field_title'><i class = 'red'>*Fields Required</i></p>";
			echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name<i class = 'red'>*</i>&nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name<i class = 'red'>*</i>&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number<i class = 'red'>*</i>&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID<i class = 'red'>*</i>&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
		}
		else{
			$check_already_a_user_sql = "SELECT * from `user` WHERE `mobile`='$mobile' or `email` = '$email'";
				$check_already_a_user_res = mysqli_query($conn,$check_already_a_user_sql);
				$count_num_row = mysqli_num_rows($check_already_a_user_res);
				if($count_num_row==1){
					#user already is a swapper 
					echo "<p class='section-heading form_field_title'>Your Mobile/E Mail exists!<br/>Hi <a href = '../dashboard2.0/index.php'>$fname $lname</a> Login to go to <a href = '../dashboard2.0/index.php'>dashboard</a>. </p>";
				}
				else{
					#now to finally accept the data and udate the table
					#no field is empty so let's validate each input
					if(validate_name($fname) and validate_name($lname) and validate_username() and validate_password()and validate_mobile() and validate_email()){
						#we can now update the table in our data base
						$find_id_sql = "SELECT * from user";
						$res_find_id = mysqli_query($conn,$find_id_sql);
						$count_num_row = mysqli_num_rows($res_find_id);
						#echo "num of rows till now was $count_num_row thus id will ne num of rows +1";
						$id = $count_num_row+1;
						$insert_user_sql = "INSERT INTO `user` (id,first_name,last_name,username,password,email,mobile,status) VALUES ('$id','$fname','$lname','$username','$password','$email','$mobile','1')";
						$res = mysqli_query($conn,$insert_user_sql);
						if($res){
                        #send an email alerting registeration
                        $from = "From: project_swapmart@manasviniganesh.in";
                        $to = $email;
						$subject = "Welcome to SwapMart";
						$body = "Hi $fname $lname, \n Welcome to SwapMart! You just registered into college's best resource. Check out the details you entered during registeration. If any changes are to be made, you simply logon to your dashboard at our site and get going. \n First Name : $fname \n Last Name : $lname \n UserName: $username \n Password : $password \n Mobile no. : $mobile \n E Mail ID : $email \n Project SwapMart \n Manasvini Ganesh";
                        mail($to,$subject,$body,$from);
						$_SESSION["login"]= true;
                        header("Location: ../dashboard2.0/index.php");
						}
					}
				}
		}
	}
	#not submitted form
	else {
		echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
	}
	
	/********************************************************************************************************************************************************/
	
	/***************************************************************Functions Below**************************************************************************/
	
	/********************************************************************************************************************************************************/
	function validate_input_data($data){
		$data=htmlspecialchars(stripcslashes(trim($data)));
		return $data;
	}
	function validate_username(){
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
		if(!$username_correction_required){
			return true;
		}
		else{
			echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name<i class = 'red'>*</i>&nbsp;</b><input type = 'text' name = 'username' value = '$entered_username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
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
				echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
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
				echo "<p class='section-heading form_field_title'>Password must have following properties - <br/> <li> lower case characters </li> <li> upper case characters </li> <li> digits(0-9) </li> <li> special symbols (@,#,etc.) </li></p>";
				echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password<i class = 'red'>*</i>&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
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
			echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name<i class = 'red'>*</i>&nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
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
			echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number<i class = 'red'>*</i>&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
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
			echo "<form action = '' method = 'POST' class = 'form'><h3 class='section-heading'><b class ='form_field_title'>First Name &nbsp;</b><input type = 'text' name = 'fname' value = '$fname'/></h3><h3 class='section-heading'><b class ='form_field_title'>Last Name &nbsp;</b><input type = 'text' name = 'lname' value = '$lname'/></h3><h3 class='section-heading'><b class ='form_field_title'>User Name&nbsp;</b><input type = 'text' name = 'username' value = '$username'/></h3><h3 class='section-heading'><b class ='form_field_title'>Password&nbsp;</b><input type = 'password' name = 'password' value = '$password'/></h3><h3 class='section-heading'><b class ='form_field_title'> Confirm Password&nbsp;</b><input type = 'password' name = 'confirm_password' value = '$confirm_password'/></h3><h3 class='section-heading'><b class ='form_field_title'>Mobile Number&nbsp;</b>+91&nbsp;<input type = 'text' name = 'mobile' value = '$mobile'/></h3><h3 class='section-heading'><b class ='form_field_title'>E-Mail ID<i class = 'red'>*</i>&nbsp;</b><input type = 'textarea' name = 'email' value = '$email'/></h3><a href='index.php' class='btn btn-default btn-xl wow bounceIn tada'> <i class = 'fa fa-repeat fa-2x wow bounceIn tada'></i> Reset</a> &nbsp; <button type = 'submit' name = 'submit' class='btn btn-primary btn-xl wow tada'><i class = 'fa fa-2x fa-pencil wow tada'></i> Register </button></form>";
			}
			else{
			return $email;
			}
		}		
	mysqli_close($conn);
	?> 