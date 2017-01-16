<?php
session_start();
if(is_null($_SESSION['fname'])){
    header("Location: ../index.php");
}
require("../connect.php");
$myUname = $_SESSION["username"];
$_SESSION["read"]=true;
$sql = "SELECT * FROM `chatbox` WHERE (`advertUname` = '$myUname' and `status` = 'sent') or (`uname` = '$myUname' and `status` = 'reply')";
$res = mysqli_query($conn,$sql);
$msgBadge =0;
$msgBadge = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>SwapMart-Messages</title>
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
    <?php
    require ("../connect.php");
    $uname = $_SESSION["username"];
    $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    $admin = $row["admin"];
    ?>
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
<section id="msgs">

    <div class="row acct-content text-center">

        <div class="col-twelve">

            <h1 class="h01"><br></h1>
            <h1 class="h01"><br></h1>
            <h1 class="h01"><br></h1>
            <h1 class="h01"><i class="fa fa-user-secret fa-2x"></i> Messages <br/></h1>

            <p class="lead">Scroll through the table of all conversations.</p>
            <p class="lead"><?php echo $msgBadge;?> <i> new </i> messages and <i>replies</i> waiting for you.</i></p>
        </div>
    </div>
    <div class="row">

        <div class="col-twelve">

            <div class="table-responsive">

                <table>
                    <thead>
                    <tr>
                        <th><a href="#msgs">Advertiser Username</a></th>
                        <th><a href="#msgs">Add Title</a></th>
                        <th><a href="#msgs">Picture</a></th>
                        <th><a href="#msgs">Chat</a></th>
                        <th><a href="#msgs">Mail Box</a></th>
                        <th><a href="#msgs">Respond</a></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $myUname = $_SESSION["username"];
                    $sql = "SELECT * FROM `chatbox` WHERE `uname` = '$myUname' and `status` = 'reply'";
                    $res = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($res);
                    for ($i = 1; $i <= $num; $i++) {
                        $row = mysqli_fetch_assoc($res);
                        $uname = $row["advertUname"];
                        $chat = $row["chat"];
                        $addID = $row["add_id"];
                        $sql = "SELECT * FROM `advertisement` WHERE `add_id` = '$addID'";
                        $resADD = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($resADD);
                        $title = $row["title_of_add"];
                        $src = $row["pic_upload_dir"];
                        $src = "../../".$src;
                        ?>
                        <tr>
                            <td><?php echo $uname; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><img src = "<?php echo $src; ?>" height = 100 width = 100></td>
                            <td><?php echo $chat; ?></td>
                            <td>Reply from advertiser <i class="fa fa-envelope-square fa-1x"></i></td>
                            <td><a href="chat/index.php?mode=enquire&addID=<?php echo $addID;?>&title=<?php echo $title;?>&advertUname=<?php echo $uname;?>"><i class="fa fa-eye fa-1x"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <?php
                    $sql = "SELECT * FROM `chatbox` WHERE `advertUname` = '$myUname' and `status` = 'sent'";
                    $res = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($res);
                    for ($i = 1; $i <= $num; $i++) {
                        $row = mysqli_fetch_assoc($res);
                        $uname = $row["uname"];
                        $chat = $row["chat"];
                        $addID = $row["add_id"];
                        $sql = "SELECT * FROM `advertisement` WHERE `add_id` = '$addID'";
                        $resADD = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($resADD);
                        $title = $row["title_of_add"];
                        $src = $row["pic_upload_dir"];
                        $src = "../../".$src;
                        ?>
                        <tr>
                            <td><?php echo $uname; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><img src = "<?php echo $src; ?>" height = 100 width = 100></td>
                            <td><?php echo $chat; ?></td>
                            <td>New from  users <i class="fa fa-envelope fa-1x"></i></td>
                            <td><a href="chat/index.php?mode=respond&addID=<?php echo $addID;?>&title=<?php echo $title;?>&enquirerUname=<?php echo $uname;?>"><i class="fa fa-reply-all fa-1x"></i></a></td>
                        </tr>
                        <?php
                    }
                    $myUname = $_SESSION["username"];
                    $sql = "SELECT * FROM `chatbox` WHERE (`advertUname` = '$myUname' and `status` = 'read') or (`uname` = '$myUname' and `status` = 'read') ";
                    $res = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($res);
                    for ($i = 1; $i <= $num; $i++) {
                        $row = mysqli_fetch_assoc($res);
                        $uname = $row["uname"];
                        $chat = $row["chat"];
                        $addID = $row["add_id"];
                        $sql = "SELECT * FROM `advertisement` WHERE `add_id` = '$addID'";
                        $resADD = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($resADD);
                        $title = $row["title_of_add"];
                        $src = $row["pic_upload_dir"];
                        $src = "../../".$src;
                        ?>
                        <tr>
                            <td><?php echo $uname; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><img src = "<?php echo $src; ?>" height = 100 width = 100></td>
                            <td><?php echo $chat; ?></td>
                            <td>Read <i class="fa fa-envelope-o fa-1x"></i></td>
                            <td><a href="chat/index.php?mode=respond&addID=<?php echo $addID;?>&title=<?php echo $title;?>&enquirerUname=<?php echo $uname;?>"><i class="fa fa-check fa-1x"></i></a></td>
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