<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"]){
    header("Location: dashboard2.0/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SwapMart-Relive</title>
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
<!-- main -->
<div class="main-w3layouts wrapper">
    <h1>SwapMart | Relive</h1>
    <div class="main-agileinfo">
        <div class="agileits-top">
            <?php
            session_start();
            if(isset($_SESSION["loginMsg"])){
                $msg = $_SESSION["loginMsg"];
                echo "<p>$msg</p>";
            }
                ?>
                <form action="relive_form.php" method="post">
                    <input class="text" type="text" name="username" placeholder="Old username" required="required">
                    <input class="text" type="password" name="password" placeholder="New Password" required="required">
                    <input class="text" type="password" name="confirm_password" placeholder="New Password Confirmation" required="required">
                    <input type="submit" value="Go Alive" name="submit">
                </form>
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