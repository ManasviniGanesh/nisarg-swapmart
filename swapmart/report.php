<?php
session_start();
if( !$_SESSION["login"] ){
    header("Location: ../login/index.php");
}
require ("header.php");
$addID = "$_SERVER[QUERY_STRING]";
$addID = substr($addID,3);
require ("connect.php");
$uname = $_SESSION["username"];
$sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$email = $row["email"];
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Report to Admin</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- mail -->
	<div class="mail animated wow zoomIn" data-wow-delay=".5s">
		<div class="container">
			<h3>Report</h3>
			<p class="est">We keep weeds at bay!</p>
			<div class="mail-grids">
				<div class="col-md-12 mail-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<form action="reportMyProblem.php" method="post">
                        <input name = "id" type="hidden" value = "<?php echo $addID;?>">
						<input name = "email" type="email" value="<?php echo $email;?>">
						<textarea name = "description" type="text"  placeholder="problem description: " required="required"></textarea>
						<input id = "submit" type="submit" value="Submit Now">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
            <p><?php if($_SESSION["reportMsg"]){$msg = "<i class = 'fa fa-bell'></i>".$_SESSION["reportMsg"]; echo $msg; $_SESSION["reportMsg"] = null;}?></p>
		</div>
	</div>
<!-- //mail -->
<?php
require ("footer.php");
?>