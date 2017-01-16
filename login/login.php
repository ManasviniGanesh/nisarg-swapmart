<!-- 1->Re Capthca-->
<?php
    session_start();
    require('connect.php');
	$username = $password = null;
	#This will be executed only when user clicks submit
	if(isset($_POST['submit'])) {
		#validating the input as submit button is clicked
		$username = validate($_REQUEST["username"]);
		$password = validate($_REQUEST["password"]);
        #setting the query to be fetched
        #validating if such a data exists in DB
        $sql = "SELECT * from `user` WHERE `username` = '$username'";
        $res = mysqli_query($conn,$sql);
        if(is_bool($res)){
            #invalid chars entered
            $_SESSION["loginMsg"] = "Oops invalid characters entered!";
            header("Location:  index.php");
        }
        else{
            #valid chars for username
            #now check if username exists in DB
            $count_rows = mysqli_num_rows($res);
            $row = mysqli_fetch_assoc($res);
            #if no such username exists at all
            if($count_rows!=1){
                print_r($res);
                $_SESSION["loginMsg"] = "You entered <i class = 'red'>$username</i> . No such username exist. <br/>Check your username or if you are new. Sign up with us with button below.";
                header("Location:  index.php");
            }
            else{
                #username exists in DB
                #disclaimers for those who can't access the account
                $fname = $row['first_name'];
                if($row['status']==0 or $row['status']==-1){
                    #failure because of special reason as described in following cases
                    switch($row['status']){
                        case '0'  : $_SESSION["loginMsg"] =  "Dear User, your account with username: <b><u>$row[username]</b></u> has been <i class = 'red'>deleted</i> by you.<br/>To relive your account click <a href = 'relive_deleted_acct.php'><u>here</u></a>.";#relive your account
                                    break;
                        case '-1' : $_SESSION["loginMsg"] = "Sorry you are not allowed to access your account. Please contact Site Admin @ <a href='../home/index.php#contact' target = '_blank'><i class = 'fa fa-2x fa-tags '></i><u>Contact</u></a>";
                                    break;
                    }
                    header("Location:  index.php");
                }
                else{
                    #username exists and can access his/her account
                    if(!isset($_SESSION['login_attempts'])){
                        $_SESSION['login_attempts']=0;
                    }
                    #now we verify the password to give appropriate access
                    $sql = "SELECT * from `user` WHERE `username` = '$username' and `password` = '$password'";
                    $res = mysqli_query($conn,$sql);
                    #if password entered has invalid chars
                    if(is_bool($res)){
                        $_SESSION["loginMsg"] = "Oops invalid characters entered as password!";
                        header("Location:  index.php");
                    }
                    else{
                        #validchars but is the password right?
                        $count_rows = mysqli_num_rows($res);
                        $row = mysqli_fetch_assoc($res);
                        if($count_rows==1 and $row['status']>0){
                            #password is right
                            #Credentials found
                            #echo 'Login Successful';
                            $_SESSION["fname"]=$row['first_name'];
                            $_SESSION["lname"]=$row['last_name'];
                            $_SESSION["username"]=$row['username'];
                            $_SESSION["login"] = true;
                            if($row['status']==2){
                                #login given but warned that the user is still unverified
                                $_SESSION["loginMsg"] = "Please verify your email ID as soon as possible. Go to <a href='dashboard2.0/index.php' target = '_self'><u>Dashboard</u></a>";
                                header("Location:  index.php");
                            }
                            else{
                                #status must be 1
                                $_SESSION["fname"] = $fname;
                                $_SESSION["username"] = $username;
                                header('Location: dashboard2.0/index.php');
                            }
                        }
                        elseif($count_rows!=1){
                            #username and password do not match!
                            increment_login_attempts();
                            if($_SESSION['login_attempts']==5){
                                $_SESSION["loginMsg"] = "Oops! <i class = 'red'>".$fname." </i> You have made 5 login attempts.";
                                #if the user had not verified his/her account before then blocking is of no use
                                #as s/he can't re live his/her account
                                #because we are not sure about the user's e mail id.
                                #thus we delete the user off the data base and inform the same
                                #but a user can re register him/her self
                                #also if we block such users then neither can they re live the account nor can the re create
                                #causing a lost customer
                                $sql = "SELECT status from `user` WHERE `username` = '$username';";
                                $res = mysqli_query($conn,$sql);
                                $row = mysqli_fetch_assoc($res);
                                if($row['status']=='2'){
                                    $_SESSION["loginMsg"] = "You had not verified your e mail. We are sorry. Your record has been deleted.</p>";
                                    $sql = "DELETE FROM `user` WHERE `user`.`username` = '$username';";
                                    $res = mysqli_query($conn,$sql);
                                    header("Location:  index.php");
                                }
                                else{
                                    #Blocking the user in the background
                                    $_SESSION["loginMsg"] = " We have sent an email to you :)";
                                    $sql = "UPDATE `user` SET `status` = '-1' WHERE `username` = '$username';";
                                    $res = mysqli_query($conn,$sql);
                                    $sql = "INSERT INTO `user_do_not_login` (`username`, `status`, `reason_for_no_access`, `when_no_access`) VALUES ('$username','-1','5 times entry block', CURRENT_TIMESTAMP)";
                                    $res = mysqli_query($conn,$sql);
                                    #mailing left out
                                    header("Location:  index.php");
                                }
                                #to stop the session so that other users from the same computer can access their accounts
                                session_unset();
                            }
                            $_SESSION["loginMsg"] = "Hi <i class = 'red'>".$fname." </i> is that not you?<br/>Because User Name and Password do not match.</p>";
                            header("Location:  index.php");
                        }
                    }
                }
            }
        }
	}
	function validate($data){
		$data=htmlspecialchars(stripcslashes(trim($data)));
		return $data;
	}
	function increment_login_attempts(){
		echo ++$_SESSION['login_attempts'];
		return($_SESSION['login_attempts']);
	}
	mysqli_close($conn);
	?> 
					