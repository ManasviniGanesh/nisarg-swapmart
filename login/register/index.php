<!DOCTYPE html>
<html lang="en">

<head>
	<link rel = "icon" href = "../../swapmart.ico"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SwapMart-Register</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="../../css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <img src = "../../img/logo.jpg" id = "logo" class = "wow tada"/><img src = "../../img/swapmart.png" class = "wow bounceIn" /><br/>
					<h2 class="section-heading">Register</h2>
                    <hr class="primary">
				</div>
			</div>
        </div>
    
		<section class = "bg-dark">
			<div class="container text-center" id = "table">
				<div class="call-to-action" id = "row">
					<?php require('register.php');?>
				</div>
			</div>
		</section>
	
	<footer>
		<aside>
			<div class="container text-center">
				<div class="call-to-action">
					<h2> Made with </h2><i class = "fa fa-heart fa-2x wow bounceIn"></i> <h2> <a href = "http://www.ipecgenesis.org#coreteam" ><i class = "fa fa-medium fa-2x wow bounceIn tada"></i>anasvini <i class = "fa fa-google fa-2x wow bounceIn tada"></i>anesh </h2></a>
                    <p>&copy; <?php echo date("Y");?> SwapMart</p>
				</div>
			</div>
		</aside>
	</footer>
	
	
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../../js/jquery.easing.min.js"></script>
    <script src="../../js/jquery.fittext.js"></script>
    <script src="../../js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../js/creative.js"></script>

</body>
</html>
