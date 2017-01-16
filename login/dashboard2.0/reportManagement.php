<?php
/**
 * Created by PhpStorm.
 * User: Manasvini Ganesh
 * Date: 14-01-2017
 * Time: 21:29
 */
?>
<?php
session_start();
if(is_null($_SESSION['fname'])){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>SwapMart-Report Management</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/vendor.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>

    <!-- favicons
     ================================================== -->
    <link rel = 'icon' href = '../../swapmart.ico'/>

    <link rel='stylesheet' href='font-awesome/css/font-awesome.min.css' type='text/css'>



</head>

<body id="top">

<!-- header
================================================== -->
<header>
    <div class="row">

        <nav id="main-nav-wrap">
            <ul class="main-navigation">
                <li><a class=""  href="index.php" title="">Dashboard</a></li>
                <li class="highlight with-sep"><a href="logout.php" title="">Sign Out</a></li>
            </ul>
        </nav>

        <a class="menu-toggle" href="#"><span>Menu</span></a>

    </div>

</header> <!-- /header -->


<!-- cta
       ================================================== -->
<section id="report">

    <div class="row acct-content text-center">

        <div class="col-twelve">

            <h1 class="h01"><br></h1>
            <h1 class="h01"><br></h1>
            <h1 class="h01"><br></h1>
            <h1 class="h01"><i class="fa fa-user-secret fa-2x"></i> Report Management <br/></h1>

            <p class="lead">Scroll through the table of all conversations.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-twelve">

            <div class="table-responsive">

                <table>
                    <thead>
                    <tr>
                        <th><a href="#report">Add ID</a></th>
                        <th><a href="#report">E Mail</a></th>
                        <th><a href="#report">Description</a></th>
                        <th><a href="#report">Review</a></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        require("../connect.php");
                        $sql = "SELECT * FROM `report` ";
                        $res = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($res);
                        for ($i = 1; $i <= $num; $i++) {
                            $row = mysqli_fetch_assoc($res);
                            $id = $row["id"];
                            $email = $row["email"];
                            $description = $row["description"];
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><a href = "removeReport.php?id=<?php echo $id;?>"><i class="fa fa-check"></i></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div> <!-- /cta-content -->

</section> <!-- /cta -->

<!--footer-->
<footer>
    <div class="footer-bottom">

        <div class="row">

            <div class="col-twelve">
                <div class="copyright">
                    <span>© Copyright SwapMart <?php echo date("Y");?>.</span>
                    <span>Design by <a href="">Manasvini Ganesh</a></span>
                </div>

                <div id="go-top" style="display: block;">
                    <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon ion-android-arrow-up"></i></a>
                </div>
            </div>

        </div> <!-- /footer-bottom -->

    </div>

</footer>

<div id="preloader">
    <div id="loader"></div>
</div>

<!-- Java Script
================================================== -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
<!-- jQuery -->
<script src='../../js/jquery.js'></script>
<!-- Bootstrap Core JavaScript -->
<script src='../../js/bootstrap.min.js'></script>

</html>
