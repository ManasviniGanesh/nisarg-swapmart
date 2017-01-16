<!-- 1->Re Capthca  -->
<?php
    session_start();
    require('connect.php');
	$username = $password = $confirm_password = null;
	
	#This will be executed only when user clicks submit
	if(isset($_POST['submit'])) {
		#validating the input as submit button is clicked
		$username = validate_input_data($_REQUEST["username"]);
		$password = stripcslashes(trim($_REQUEST["password"]));
		$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
        #if password criteria is satisfied and the user already exists in the data base then update the table and grant access to the dashboard2.0
        if(validate_password()and validate_username($username)){
            #setting the queries
            $update_user = "UPDATE `user` SET `password` = '$password' , `status` = '1' WHERE `username` = '$username';";
            $update_user_do_not_login = "DELETE FROM `user_do_not_login` WHERE `username` = '$username';";
            $res_update_user = mysqli_query($conn,$update_user);
            $res_update_user_do_not_login = mysqli_query($conn,$update_user_do_not_login);
            if($res_update_user==1 and $res_update_user_do_not_login==1){
                $_SESSION["loginMsg"] = "Success! <a href = 'dashboard2.0/index.php'><u>Login</u></a> to continue.";
                $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                $from = "From: project_swapmart@manasviniganesh.in";
                $to = $row["email"];
                $user = $row["first_name"];
                $subject = "Welcome BACK to SwapMart";
                $body = "Dear,".$user."\n Your account is live again. Happy to see you back. \n Project SwapMart \n Manasvini Ganesh";
                mail($to,$subject,$body,$from);
                if(isset($_SESSION["loginMsg"])){
                    header("Location: relive_deleted_acct.php");
                }
            }
        }
        if(isset($_SESSION["loginMsg"])){
            header("Location: relive_deleted_acct.php");
        }
	}
	
	/*********************************************************************************************************************************/
	/*********************************************************************************************************************************/


	/** 									Below are the different functions required in this code **/


	/*********************************************************************************************************************************/
	/*********************************************************************************************************************************/

	
		#validate simple input to prevent basic xss
		function validate_input_data($data){
			$data=htmlspecialchars(stripcslashes(trim($data)));
			return $data;
		}
		
		#validate_username to check the constraints satisfacton
		function validate_username($username){
			$user=$username;
			$user_exists=false;
			require('connect.php');
		
			#check whether user exists
			$sql= "SELECT * from `user` WHERE `username` = '$user'";
			$res = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($res);
			$count_rows = mysqli_num_rows($res);
				
			#if user exists set user_exists as true
			if($count_rows==1){
				$user_exists=true;
				switch($row['status']){
				case '0' :	return true;
				case '1' : 	$_SESSION["loginMsg"] = "You are already an alive user. If you wish to change password login in <a href = 'dashboard2.0/index.php'> <u>dashboard</u> </a>";
							break;
				case '2' : 	$_SESSION["loginMsg"] = "You are already an alive user. You have not verified your email. But temporarily you can still access <a href = 'dashboard2.0/index.php'> <u>dashboard </u></a>";
							break;
				case '-1':  $_SESSION["loginMsg"] = "Sorry you are not allowed to access your account. Please contact Site Admin @ <a href='../home/index.php#contact' target = '_blank'><i class = 'fa fa-2x fa-tags '></i><u>Contact</u></a>";
							break;
				}
			}
			if(!$user_exists){
				#user does not exist in the data base
                $_SESSION["loginMsg"] = "Oops! No record with username $user found. Please register your self.<br/><a href='register/index.php' class='btn btn-primary btn-xl '><i class = 'fa fa-2x fa-pencil '></i> <u>Register</u></a>";
			}
		}
		#validate_password to check the constraints satisfacton
		function validate_password(){
			#setting input to variables
			$password = stripcslashes(trim($_REQUEST["password"]));
			$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
			
			$password_correction_required=false;
			if(strlen($password)<8 and $password!=NULL){
				$password_correction_required=true;
                $_SESSION["loginMsg"] = "Password must be at least 8 characters long.<br/>";
			}
			if(strlen($password)>30){
				$password_correction_required=true;
                $_SESSION["loginMsg"] = $_SESSION["loginMsg"]."Too long. Password must be less than 30 characters.<br/>";
			}
			if($password!=$confirm_password){
				$password_correction_required=true;
                $_SESSION["loginMsg"] = $_SESSION["loginMsg"]."Passwords in both the fields should match.<br/>";
				$password=$confirm_password=null;
			}
			if($password_correction_required){
                $_SESSION["loginMsg"] = $_SESSION["loginMsg"]."Password Correction Required.";
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
			$username = validate_input_data($_REQUEST["username"]);
			$password = stripcslashes(trim($_REQUEST["password"]));
			$confirm_password = stripcslashes(trim($_REQUEST["confirm_password"]));
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
					}
					$j++;
				}
				$j=0;
				while($j<strlen($big_alpha) and !$upper_case){
					if($password[$i]==$big_alpha[$j]){
						$upper_case=true;
					}
					$j++;
				}
				$j=0;
				while($j<strlen($digit) and !$numeric){
					if($password[$i]==$digit[$j]){
						$numeric=true;
					}
					$j++;
				}
				$j=0;
				while($j<strlen($special_symbol_list) and !$special_symbol){
					if($password[$i]==$special_symbol_list[$j]){
						$special_symbol=true;
					}
					else{
						if(!$upper_case and !$lower_case and !$numeric){
							$spl_char = $password[$i];
							$special_symbol_list=$special_symbol_list.$spl_char;
							$special_symbol=true;
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
                $_SESSION["loginMsg"] = "Error"."<br/>".$_SESSION["loginMsg"];
				}
		}
		mysqli_close($conn);
?> 


