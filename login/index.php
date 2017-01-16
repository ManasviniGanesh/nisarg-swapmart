<!DOCTYPE html>
<html>
<head>
    <title>SwapMart - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Magical Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Custom Theme files -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href='//fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
    <!-- //web font -->
    </head>
<body>
<?php $GLOBALS['count_login_attempts']=0;?>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>SwapMart | Login</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
                <p><?php session_start(); if(isset($_SESSION["loginMsg"])){$msg = $_SESSION["loginMsg"]; echo $msg;}?></p>
				<form action="login.php" method="post">
					<input class="text" type="text" name="username" placeholder="Username" required="required">
					<input class="text" type="password" name="password" placeholder="Password" required="required">
					<input type="submit" value="LOGIN" name="submit">
				</form>
                <p>Don't have an Account? <a href="register/index.php"> <u>Signup Now!</u></a></p>
			</div>	 
		</div>	
		<!-- copyright -->
		<div class="copyright-agile">
			<p>© <?php echo date("Y")?> SwapMart . All rights reserved | Design by Manasvini Ganesh</p>
		</div>
		<!-- //copyright -->
	</div>	
	<!-- //main --> 
</body>
</html>