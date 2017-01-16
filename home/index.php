<!DOCTYPE html>
<html lang="en">

<head>
	<link rel = "icon" href = "../swapmart.ico"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="e-commerce,about swapmart, genesis">
    <meta name="author" content="Manasvini Ganesh">

    <title>SwapMart-Home</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/creative.css" type="text/css">
	<!-- Plugin CSS -->
    <link rel="stylesheet" href="../css/animate.min.css" type="text/css">
    
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">
	<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <!--For generating the three lines in toggle use icon-bar-->
					<span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<img src = "../img/logo.jpg" id = "logo"  class="navbar-brand page-scroll" /><a class="navbar-brand page-scroll" href="#page-top">SwapMart</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="navbar-brand page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="navbar-brand page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="navbar-brand page-scroll" href="#contact">Contact</a>
                    </li>
					<li>
						<a class="navbar-brand page-scroll" href="../index.php">Swap-Store</a>
					</li>
                    <?php
                    session_start();
                    if(isset($_SESSION["login"]) && $_SESSION["login"]){
                        ?>
                        <li>
                            <a class = 'navbar-brand page-scroll' href= '../login/dashboard2.0/index.php'><?php $fname = $_SESSION["fname"]; echo "Hi ".$fname;?></a>
                        </li>
                        <li>
                            <a class = 'navbar-brand page-scroll' href= '../login/dashboard2.0/index.php#testimonials'>Post An Add</a>
                        </li>
                    <?php
                    }
                    else{
                    ?>
                        <li>
                            <a class = 'navbar-brand page-scroll' href= '../login/index.php'>Hi Guest</a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
				<!--Yellow green swapmart -->
                <img src = "../img/swapmart.png" class = "wow bounceIn" />
				<hr>
                <p class="section-heading"> We help you sell burdens and easy buy needs. <br/> So Simply SwapON </p>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">We've got what you need. <br/> & <br/> We can help you throw what you don't need. </h2>
                    <hr class="light">
                    <p class="text-faded"> From handwritten notes, to the printed ones' or soft copies. We've got all the notes you need. Question papers from past or even calculator, bikes for rent, and all the necessities our Ipec'ians have it overflowing. Post it here and get a rent / swap it for money. Earn a little pocket money or find your need within pennies. </p>
					<p class="text-faded"> &copy; <?php echo date("Y");?> SwapMart is a Project under Genesis for Nisarg 2016 annual Project Exhibition in IPEC's Annual Techno Cultural Fest Udbhav 2k16.<br/>The idea was from <b>Ishan Rai</b>. <br/> And the site is developed by <b>Manasvini Ganesh</b> both, then core members - Team Genesis. </p>
				</div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-dribbble wow bounceIn text-primary"></i>
                        <h3> College Life Needs </h3>
                        <p class="text-muted">From formal wear to notes anything you want within campus. SwapMart is all you need.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-shirtsinbulk wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3> Too much stocked? </h3>
                        <p class="text-muted">Maybe someone else may need them. So swap it for right value or just gift it for free.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-rupee wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3> Sell/Buy/Rent/Gift </h3>
                        <p class="text-muted">Swap it for money or with money. Or even without it. Just the way it pleases you.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-clock-o wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3> Quick 'n' Easy </h3>
                        <p class="text-muted">Just swirl around the exotic lists we have. And swap what you want in seconds.</p>
                    </div>
                </div>
				<!--<div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-user-plus wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3> Privacy </h3>
                        <p class="text-muted"> Your details are safe with us. And that's a promise!  </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-user-secret wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3> Stay Anonymous </h3>
                        <p class="text-muted"> Want to make the swap secretly? Swap it with us in between.  </p>
                    </div>
                </div>-->
            </div>
        </div>
    </section>

    
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p> Have some queries or suggestions ?<br/>Feel free to contact us.<br/>We just love to talk. </p>
                </div>
				<div class="col-lg-3 col-lg-offset-2 text-center">
                    <p class = "yellow"><i class="fa fa-facebook-f fa-2x wow bounceIn"></i></p>
                    <p><a href="https://www.facebook.com/ipecgenesis" target = "_blank">FB-Genesis</a></p>
                </div>
				<div class="col-lg-3 col-lg-offset-2 text-center">
                    <p class = "yellow"><i class="fa fa-linkedin fa-2x wow bounceIn"></i></p>
                    <p><a href="https://www.linkedin.com/in/ipecgenesis" target = "_blank">Genesis LinkedIn</a></p>
                </div>
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<img src = "../img/logo.jpg" class = "wow bounceIn" height = "75" width = "75"/>
				</div>
				<div class="col-lg-3 col-lg-offset-2 text-center">
                    <p class = "yellow"><i class="fa fa-google-plus fa-2x wow bounceIn"></i></p>
                    <p><a href="https://plus.google.com/+ipecgenesis" target = "_blank">Genesis + </a></p>
                </div>
				<div class="col-lg-3 col-lg-offset-2 text-center">
                    <p class = "yellow"><i class="fa fa-globe fa-2x wow bounceIn"></i></p>
                    <p><a href = "http://www.ipecgenesis.org" target = "_blank">ipecgenesis.org</a></p>
                </div>
				<div class="col-lg-12 text-center">
                    <p class = "yellow"><i class="fa fa-envelope-o fa-2x wow bounceIn"></i></p>
                    <p><a href="mailto:team@ipecgenesis.org">team@ipecgenesis.org</a></p>
				</div>
			</div>
        </div>
    </section>
	
	<footer>
		<aside class="bg-dark">
			<div class="container text-center">
				<div class="call-to-action">
					<h2> Made with </h2><i class = "fa fa-heart fa-2x wow bounceIn red"></i> <h2> <a href = "http://www.ipecgenesis.org#coreteam" ><i class = "fa fa-medium fa-2x wow bounceIn tada"></i>anasvini <i class = "fa fa-google fa-2x wow bounceIn tada"></i>anesh </h2></a>
                    <p>&copy; <?php echo date("Y");?> SwapMart</p>
				</div>
			</div>
		</aside>
	</footer>
	
	
	
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/jquery.fittext.js"></script>
    <script src="../js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/creative.js"></script>

</body>
</html>
