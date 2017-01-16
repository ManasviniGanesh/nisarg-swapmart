<!DOCTYPE html>
<html>
<head>
    <title>SwapMart</title>
    <link rel = "icon" href = "../swapmart.ico"/>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script src="js/jquery.min.js"></script>
    <!-- //js -->
    <!-- cart -->
    <script src="js/simpleCart.min.js"></script>
    <!-- cart -->
    <!-- for bootstrap working -->
    <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
    <!-- //for bootstrap working -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <!-- animation-effect -->
    <link href="css/animate.min.css" rel="stylesheet">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
</head>

<body>
<!-- header -->
<div class="header">
    <div class="container">
        <div class="header-grid">
            <div class="header-grid-left animated wow slideInLeft" data-wow-delay=".2s">
                <ul>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:team@ipecgenesis.org">team@ipecgenesis.org</a></li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+91 9999999999</li>
                    <?php
                    if(!isset($_SESSION["username"]))
                        session_start();
                    if(isset($_SESSION["login"]) && $_SESSION["login"]){
                        ?>
                        <li><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a href="../login/dashboard2.0/index.php"><?php $fname = $_SESSION["fname"]; echo "Hi ".$fname;?></a></li>
                        <li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href="../login/dashboard2.0/logout.php">Log Out</a></li>
                        <?php
                    }
                    else{
                        ?>
                        <li><i class="glyphicon glyphicon-book" aria-hidden="true"></i><a href="../login/index.php">Sign IN/Sign UP</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="header-grid-right animated wow slideInRight" data-wow-delay=".5s">
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/ipecgenesis" class="facebook"></a></li>
                    <li><a href="https://www.plus.google.com/+ipecgenesis" class="g"></a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="logo-nav">
            <div class="logo-nav-left animated wow zoomIn" data-wow-delay=".5s">
                <h1><a href="#">Swap Mart<span>The Campus Store</span></a></h1>
            </div>
            <div class="logo-nav-left1">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header nav_2">
                        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php" class="act">Store</a></li>
                            <li class="active"><a href="../home/index.php" class="act">Home</a></li>
                            <!-- Mega Menu -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pricing Style <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-column columns-1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <ul class="multi-column-dropdown">
                                                <h6> Select your need </h6>
                                                <li><h4><a href="products.php?style=free#collection"> Free </a></h4></li>
                                                <li><h4><a href="products.php?style=buy#collection"> Buy </a></h4></li>
                                                <li><h4><a href="products.php?style=rent#collection"> Rent </a></h4></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-column columns-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <ul class="multi-column-dropdown">
                                                <h6> Choose from our Collection </h6>
                                                <li><h4><a href="products.php?ctgry=notes#collection"> Notes </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=books#collection"> Books </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=qpaper#collection"> Question Papers </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=quantum#collection"> Quantum </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=decode#collection"> Decode </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=stationary#collection"> Stationary </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=electronics#collection"> Electronics </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=movies#collection"> Movies </a></h4></li>
                                                <li><h4><a href="products.php?ctgry=others#collection"> Others </a></h4></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </ul>
                            </li>
                            <?php
                            if(isset($_SESSION["login"]) && $_SESSION["login"]){
                                ?>
                                <li><a href="bookmark.php">Bookmarks</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //header -->