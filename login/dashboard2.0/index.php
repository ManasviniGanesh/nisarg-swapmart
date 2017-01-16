<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == false){
    header("Location: ../index.php");
}
require("../connect.php");
$myUname = $_SESSION["username"];
$_SESSION["chat"] = null;
if(isset($_SESSION['read']) and $_SESSION["read"]){
    $sql = "SELECT * FROM `chatbox` WHERE `advertUname` = '$myUname' and (`status` = 'sent')";
    $res = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($res);
    for($i=0;$i<$num;$i++){
        $row = mysqli_fetch_assoc($res);
        $chat = $row["chat"];
        $addID = $row["add_id"];
        $uname = $row["uname"];
        $chat = $chat."<br/><br/><-----##--READ--BY--ADVERTISER--##-----><br/><br/>";
        $sql = "UPDATE `chatbox` SET `chat` = '$chat', `status` = 'read' WHERE (`advertUname` = '$myUname' and `add_id` = '$addID' and `uname` = '$uname') and (`status` = 'sent')";
        mysqli_query($conn,$sql);
    }
    $sql = "SELECT * FROM `chatbox` WHERE `uname` = '$myUname' and (`status` = 'reply')";
    $res = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($res);
    for($i=0;$i<$num;$i++){
        $row = mysqli_fetch_assoc($res);
        $chat = $row["chat"];
        $addID = $row["add_id"];
        $advertUname = $row["advertUname"];
        $chat = $chat."<br/><br/><-----##--READ--BY--USER--##-----><br/><br/>";
        $sql = "UPDATE `chatbox` SET `chat` = '$chat', `status` = 'read' WHERE (`advertUname` = '$advertUname' and `add_id` = '$addID' and `uname` = '$myUname') and (`status` = 'reply')";
        mysqli_query($conn,$sql);
    }
    $_SESSION["read"]=false;
}
$sql = "SELECT * FROM `chatbox` WHERE `advertUname` = '$myUname' and `status` = 'sent'";
$res = mysqli_query($conn,$sql);
$msgBadge =0;
$msgBadge = mysqli_num_rows($res);
$sql = "SELECT * FROM `chatbox` WHERE `uname` = '$myUname' and `status` = 'reply'";
$res = mysqli_query($conn,$sql);
$msgBadge = $msgBadge + mysqli_num_rows($res);
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
	<meta charset="utf-8">
	<title>SwapMart-Dashboard</title>
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
       $_SESSION["fname"] = $row["first_name"];
       ?>
   	<div class="row">

	   	<nav id="main-nav-wrap">
				<ul class="main-navigation">
					<li><a class="smoothscroll"  href="#acct" title="">Manage Account</a></li>
					<li><a class="smoothscroll"  href="#postAdd" >Post an Add</a></li>
                    <li><a  href="manage_adds.php" >Manage Posted Adds</a></li>
                    <?php
                    if(isset($admin) and $admin == "master") {
                        ?>
                        <li><a class="smoothscroll" href="#admins" title="">Manage Admins</a></li>
                        <?php
                    }
                    if(isset($admin) and ($admin == "master" or $admin == "admin")) {
                        ?>
                        <li><a class="smoothscroll" href="#users" title="">Manage Users</a></li>
                        <li><a href="reportManagement.php" title="">Manage Reports</a></li>
                        <?php
                    }
                    ?>
                    <li><a class=""  href="messages.php" >Messages (<?php echo $msgBadge;?>)</a></li>
                    <?php
                    if($admin=="user") {
                        ?>
                        <li class="highlight with-sep"><a href="#promote" class="smoothscroll" title="">Promote Me</a></li>
                        <?php
                    }
                    ?>
                    <li class="highlight with-sep"><a href="logout.php" title="">Sign Out</a></li>
				</ul>
        </nav>

			<a class="menu-toggle" href="#"><span>Menu</span></a>
   		
   	</div>   	
   	
   </header> <!-- /header -->

	<!-- intro section
   ================================================== -->
   <section id="intro">

   	<div class="shadow-overlay"></div>

   	<div class="intro-content">
   		<div class="row">

   			<div class="col-twelve">

	   			<h1><?php echo "Namaste &nbsp;";echo $_SESSION['fname'];?></div></h1>
                <?php
                    require ("../connect.php");
                    $myUname = $_SESSION["username"];
                    $sql = "SELECT * FROM `user` WHERE `username` = '$myUname'";
                    $res = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($res);
                    if($row["demo"] != '0') {
                        $_SESSION["demo"]=true;
                        ?>
                        <h5> Temporary Privelleged Mode </h5>
                        <?php
                    }
                    else {
                        ?>
                        <h5> Welcome to dashboard. </h5>
                        <?php
                    }
                ?>

	   			<a class="button stroke" href="../../swapmart/index.php" title="">Visit Mart <i class="ion-android-cart"></i> </a>

	   		</div>  
   			
   		</div>   		 		
   	</div>

   </section>

   <!-- acct
   ================================================== -->
   <section id="acct" class="acct">

   	<div class="row acct-content">

   		<div class="col-twelve">

   			<h5 class="h05">Manage</h5>

			<h1 class="h01">Account</h1>

   			<p class="lead">Make your choice !</p>

            <?php
            if(isset($_SESSION["msg"])){
                $msg = $_SESSION["msg"];
                echo "<h5 class='h05'> $msg </h5>";
            }
            ?>

            <ul class="stores">
   				<li class="app-store">
   					<a onclick="showHidden('update')" name = "update" href="#update" class="button round large smoothscroll" title="">
   						<i class="ion-ios-redo"></i>Update Credentials
   					</a>
   				</li>
   				<li class="windows-store">
   					<a onclick="showHidden('delete')" name="delete" href="#deleteAcct" class="button round large smoothscroll" title="">
   						<i class="ion-android-delete"></i>Delete Account</a>
   					</li>
   			</ul>

   		</div>

   	</div> <!-- /acct-content -->

   </section> <!-- /acct -->
   
   <!-- update Section
   ================================================== -->
   <section id="update">

   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">
			<h5>Current</h5>
   			<h1>Credentials</h1>
				<div class="image-part">
		</div>  			

   		</div>   		
   	</div>

       <?php
       $username=$_SESSION['username'];
       $sql = "SELECT * from `user` WHERE `username` = '$username';";
       $res = mysqli_query($conn,$sql);
       $row = mysqli_fetch_assoc($res);
       $fname_old = $row["first_name"];
       $lname_old = $row["last_name"];
       $username = $row["username"];
       $password = $row["password"];
       $mobile = $row["mobile"];
       $email = $row["email"];
       ?>

       <div class="row update-content">

   		<div class="left-side">

   			<div class="item" data-item="1">

                <h5>First Name <input disabled type = 'text' name = 'fname' value = '<?php echo $fname_old;?>'/></h5>
				
   			</div>

            <div class="item" data-item="2">

                <h5>Last Name <input disabled type = 'text' name = 'lname' value = '<?php echo $lname_old;?>'/></h5>

            </div>

            <div class="item" data-item="3">

	   			<h5>User Name <input disabled type = 'text' name = 'username' value = '<?php echo $username;?>'/></h5>
					
   			</div>

   		</div> <!-- /left-side -->
   		
   		<div class="right-side">
   				
   			<div class="item" data-item="4">

   				<h5>Password <input disabled type = 'password' name = 'password' value = '<?php echo $password;?>'/></h5>
					
   			</div>

   			<div class="item" data-item="5">

   				<h5>Mobile Number <input disabled type = 'number' name = 'mobile' value = '<?php echo $mobile;?>'></h5>

   			</div>

			<div class="item" data-item="6">

	   			<h5>E-Mail ID <input disabled type = 'email' name = 'email' value = '<?php echo $email;?>'/></h5>

   			</div>

   		</div> <!-- /right-side -->  

   		<div class="image-part"></div>

   	</div> <!-- /update-content -->
	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">
			<div class="image-part">
				<div class="item">
                    <p> <?php echo $fname_old?>, do you want to update any credential ? </p>
                    <a class="button button-primary" href="update.php">Yes Please</a>
                    <a onclick="hideShown('update')" class="button button-primary smoothscroll" href="#acct">Noops</a>
                    <br/>
				</div>
			</div>
   		</div>
   	</div>

   </section> <!-- /update-->


   <!-- deletion Section
   ================================================== -->
	<section id = "deleteAcct" class="deletion">

		<div class="row section-intro">
			<div class="col-twelve with-bottom-line">
				<h5>Delete</h5>
				<h1>Account</h1>
			</div>   		
		</div>

   	<div class="row section-intro">
		<span class="icon"><i class="ion-sad-outline"></i></span>                          
			<div class="service-content">

                <div id = "askDelete">
                    <form id = "deleteForm">
                        <p>Are you sure? All your advertisements, bookmarks and chats will be termiated.</p>
                        <a onclick="confirmDelete()" class="button smoothscroll" name = 'submit'><i class = 'ion-android-delete'></i> Delete </a>
                        <a onclick="hideShown('delete')" class="button smoothscroll" href="#acct"><i class="ion-android-happy"></i> Neh! </a>
                    </form>
                </div>

                <div id="confirmDelete">
                    <form id = "deleteForm" action = "delete.php" method="get">
                        <p>We will miss you</p>
                        <p id="deleteValidationMessage"></p>
                        <a onclick="hideShown('delete')" class="button smoothscroll" href="#acct"><i class="ion-android-happy"></i> Nooo! </a>
                        <button type = 'submit' name = 'submit'><i class = 'ion-android-delete'></i> Confirm Delete </button>
                    </form>
                </div>

            </div>
   	</div> <!-- deletion-content -->
		
	</section> <!-- /deletion -->


    <!-- postAdd Section
   ================================================== -->
    <section id = "postAdd" class="postAdd">

        <div class="row">
            <div class="col-twelve">
                <?php
                $sql = "SELECT * from `user` WHERE `username` = '$username'";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                if($row['status']=='2'){
                    echo "<h2 class='h01'>Warning !</h2>";
                    echo "<p class=''>Oops! You have <i class='red'>not verified</i> your account yet. <i class='red'>Can't</i> post any add.</p>";
                }
                else{
                    echo "<h2 class='h01'>You have posted";
                    $username=$_SESSION['username'];
                    $sql = "SELECT * from `advertisement` WHERE `username` = '$username';";
                    $res = mysqli_query($conn,$sql);
                    $num_of_add = mysqli_num_rows($res);
                    echo "<b> $num_of_add </b>";
                    echo "adds so far</div></h2>";
                    echo "</div>
                    </div>
                    <div class='row'>
                            <div class='text-center'>
                                <form action = 'post_add.php' method='get'>
                                <button type = 'submit' class='button-primary' >Post Now!</button>
                                </form>
                            </div>
                        </div>
                    </div>";
                }?>

    </section> <!-- /postAdd -->

    <?php
    $unameViewer = $_SESSION["username"];
    $sqlViewer  = "SELECT * FROM `user` WHERE `username` = '$unameViewer'";
    $resViewer = mysqli_query($conn,$sqlViewer);
    $row = mysqli_fetch_assoc($resViewer);
    $adminViewer = $row["admin"];
    if(isset($adminViewer) and ($adminViewer == "master")) {
        ?>
        <!-- acct
       ================================================== -->
        <section id="admins">

            <div class="row acct-content text-center">

                <div class="col-twelve">

                    <h1 class="h01"><br></h1>
                    <h1 class="h01"><i class="fa fa-life-bouy fa-2x"></i> Manage Admins<br/></h1>

                    <p class="lead">Make or Revoke your admins of <i></i><i class="fa fa-fire fa-1x"><i> Power</i></i>
                    </p>
                </div>
            </div>
            <div class="row">

                <div class="col-twelve">

                <div class="table-responsive">

                        <table>
                            <thead>
                            <tr>
                                <th><a href="#admins">Serial No.</a></th>
                                <th><a href="#admins">Name</a></th>
                                <th><a href="#admins">Username</a></th>
                                <th><a href="#admins">No. Of Adds</a></th>
                                <th><a href="#admins">Admin Rights</a></th>
                                <th><a href="#admins">Control</a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM `user` WHERE `admin` = 'admin' or `admin` = 'master'";
                            $res = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($res);
                            for ($i = 1; $i <= $num; $i++) {
                                $row = mysqli_fetch_assoc($res);
                                $name = $row["first_name"] . " " . $row["last_name"];
                                $uname = $row["username"];
                                $num_of_add = $row["num_of_add"];
                                $admin = $row["admin"];
                                $control = null;
                                $bool_control = false;
                                if ($admin == "admin") {
                                    $admin = "Administrator";
                                    $control = "<u>Remove</u>";
                                    $bool_control = true;
                                } else {
                                    $admin = "Web Master";
                                    $control = "<i class = 'fa fa-star yellowHue' title='Web Master'></i>";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $uname; ?></td>
                                    <td><?php echo $num_of_add; ?></td>
                                    <td><?php echo $admin; ?></td>
                                    <td>
                                        <a href=
                                           <?php
                                           if ($bool_control) {
                                               echo 'removeAdmin.php?user=';
                                               echo $uname;
                                           } else {
                                               echo '#admins';
                                           }
                                           ?>
                                        ><?php echo $control; ?></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div> <!-- /acct-content -->

        </section> <!-- /acct -->
        <?php
    }
        ?>
    <?php
    if(isset($adminViewer) and ($adminViewer == "admin") or ($adminViewer == "master")) {
        $sql = "SELECT * FROM `user`";
        $res = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($res);
        ?>
    <!-- postAdd Section
       ================================================== -->
    <section class="postAdd" id="users">

        <div class="row acct-content">
            <div class="col-twelve">
                <h5 class="h05">Manage</h5>

                <h1 class="h01">Users</h1>

            </div>
        </div>
            <div class='row'>
                <div class='text-center'>
                    <form action= '<?php require ('viewUser.php');?>#users' method='post'><select onchange='submit()' name = 'viewUser'><option value=''>Filter Results By </option><option value='master'>Web Masters</option><option value='admin'>Admins</option><option value='0'>Users who deleted account</option><option value='-1'>Blocked Users</option><option value='1'>Active &amp; verified users</option><option value='2'>Unverified Users</option></select></form>
                    <p class="lead"><?php if(isset($_SESSION['msg'])) {echo $_SESSION["msg"]; $_SESSION['msg']=null;}?></p>
                    <div class="table-responsive">
                        <?php
                        if($num!=0) {
                            ?>
                            <table>
                                <thead>
                                <tr>
                                    <th><a href="#users">Serial No.</a></th>
                                    <th><a href="#users">Name</a></th>
                                    <th><a href="#users">Username</a></th>
                                    <th><a href="#admins">No. Of Adds</a></th>
                                    <th><a href="#users">Admin Rights</a></th>
                                    <th><a href="#users">Control</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ($i = 1; $i <= $num; $i++) {
                                    $row = mysqli_fetch_assoc($res);
                                    $name = $row["first_name"] . " " . $row["last_name"];
                                    $uname = $row["username"];
                                    $admin = $row["admin"];
                                    $status = $row["status"];
                                    $num_of_add = $row["num_of_add"];
                                    if ($status == "-1") {
                                        $status = "Unblock User";
                                    } else {
                                        $status = "Block User";
                                    }
                                    $control = null;
                                    /**
                                     * Control field management block
                                     */
                                    if ($adminViewer == "admin") {
                                        if ($admin == "admin") {
                                            $admin = "Administrator";
                                            $control = "<i class = 'fa fa-star yellowHue' title='Web Master'></i>";
                                        } else if ($admin == "master") {
                                            $admin = "Web Master";
                                            $control = "<i class = 'fa fa-star yellowHue' title='Web Master'></i>";
                                        } else if ($admin == "user") {
                                            $admin = "User Rights";
                                            $control = "<u><a href='userAction.php?user=$uname'>$status</a></u>";
                                        }
                                    }
                                    if ($adminViewer == "master") {
                                        if ($admin == "admin") {
                                            $admin = "Administrator";
                                            $control = "<u><a href='removeAdmin.php?user=$uname'>Remove Admin</a></u>";
                                        } else if ($admin == "master") {
                                            $admin = "Web Master";
                                            $control = "<i class = 'fa fa-star yellowHue' title='Web Master'></i>";
                                        } else if ($admin == "user") {
                                            $admin = "User Rights";
                                            $control = "<u><form action='userAction.php?user=$uname' method='post'><select onchange='submit()' name = 'userAction'><option value=''>User</option><option value='admin'>Make Admin</option><option value='block'>$status</option></select></form></u>";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $uname; ?></td>
                                        <td><?php echo $num_of_add; ?></td>
                                        <td><?php echo $admin; ?></td>
                                        <td><?php echo $control; ?></td>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </section> <!-- /postAdd -->
        <?php
    }
    else {
        ?>
        <!-- acct
       ================================================== -->
        <section id="promote" class="acct">

            <div class="row acct-content">

                <div class="col-twelve">

                    <h5 class="h05">Temporary</h5>

                    <h1 class="h01">Promotion</h1>

                    <p class="lead"><i class="fa fa-warning"></i> DISCLAIMER: <br/>Promotion will <b>expire</b> when you
                        log out. This section is made available for experiencing account as web master or admin or verified account
                        holder of the site. Permanent promotions are made by web administrator using CRM. In case of verifications of user, it will be done when you click on link e mailed to you on registration.It is thus a
                        temporary state. But all changes made to database will be recorded during the temporary
                        promotion. This is to ensure consistency. So make only relevant and careful changes. And to exit this, <b>please sign out from any logged in device</b>.</p>

                    <ul class="stores">
						<li>
                            <a href="promote.php?role=admin&uname=<?php echo $_SESSION['username']; ?>"
                               class="button round large" title="">
                                <i class="ion-ios-person-outline"></i>Promote as Site Admin</a>
                        </li>
                        <li>
                            <a href="promote.php?role=master&uname=<?php echo $_SESSION['username']; ?>"
                               class="button round large" title="">
                                <i class="ion-ios-person"></i>Promote as Web Master
                            </a>
                        </li>
                    </ul>

                </div>

            </div> <!-- /acct-content -->

        </section> <!-- /acct -->
        <?php
    }
    ?>

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
    <script type="text/javascript">
        function showHidden(whichButton) {
            switch (whichButton) {
                case "update" :
                    document.getElementById("update").style.display = "block";
                    break;
                case "delete" :
                    document.getElementById("deleteAcct").style.display = "block";
                    break;
            }
        }
        function hideShown(whichButton) {
            switch (whichButton){
                case "update" :document.getElementById("update").style.display = "none";
                break;
                case "delete" :document.getElementById("deleteAcct").style.display = "none";
                break;
            }
        }
        function confirmDelete() {
            document.getElementById("askDelete").style.display = "none";
            document.getElementById("confirmDelete").style.display = "block";
            validateDelete();
        }
        function validateDelete() {
            <?php
                $feedback = null;
                $uname = $_SESSION['username'];
                #verifying if the user had verified his email id . if not he can never re live his account warning is generated
                $sql_verify_email_check ="SELECT status from `user` WHERE `user`.`username` = '$uname';";
                $res_verify_email_check = mysqli_query($conn,$sql_verify_email_check);
                $row_verify_email_check = mysqli_fetch_assoc($res_verify_email_check);
            ?>
            var status = <?php echo $row_verify_email_check['status'];?> ;
            if(status == 2){
                document.getElementById("deleteValidationMessage").style.display = "block";
                document.getElementById("deleteValidationMessage").innerHTML = "<i class='ion-android-warning'></i> WARNING: You have not verified your email.<br/>If you delete without verification all your data will be destroyed so that you can <i>never</i> revoke your access again.";
            }
        }
        </script>

</body>
<!-- jQuery -->
<script src='../../js/jquery.js'></script>
<!-- Bootstrap Core JavaScript -->
<script src='../../js/bootstrap.min.js'></script>

</html>