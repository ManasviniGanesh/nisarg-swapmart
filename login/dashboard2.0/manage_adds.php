<?php
    session_start();
    if(is_null($_SESSION['fname'])){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang='en'>

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
	<link rel = 'icon' href = '../../swapmart.ico'/>

    <title>SwapMart</title>
	
    <!-- Bootstrap Core CSS -->
    <link href='../../css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link href='../../css/creative.css' rel='stylesheet'>
    <link href='../../css/dashboardcss.css' rel='stylesheet'>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' href='font-awesome/css/font-awesome.min.css' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
    <![endif]-->

</head>

<body>

    <div class='swapmart'>Manage Adds</div>
    <div class='welcome_dashboard'>Until now yo have posted  
		<?php 
			require("../connect.php");
			$username=$_SESSION['username'];  
			$sql = "SELECT * from `advertisement` WHERE `username` = '$username';"; 
			$res = mysqli_query($conn,$sql); 
			$num_of_add = mysqli_num_rows($res); 
			echo "<b class ='red'>$num_of_add</b>";
		?> adds!
	</div>
    
    <!-- Navigation -->
    <nav class='navbar navbar-default' role='navigation'>
        <div class='container'>
            <!-- swapmart and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <!-- navbar-swapmart is hidden on larger screens, but visible when the menu is collapsed -->
                <a class='navbar-swapmart' href='index.php'></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse' id = 'bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
					<li>
                        <a href='index.php'>Main Dashboard</a>
                    </li>
                    <li>
                        <a href='index.php#cta'>Manage Account</a>
                    </li>
                    
                    <li>
                        <a href='post_add.php'>Post an Add</a>
                    </li>
                    <li>
                        <a href='#'>Messeges</a>
                    </li>
					<li>
                        <a name = 'logout' href='logout.php'>Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

			
	<?php 
	require('../connect.php');
	$username = $_SESSION['username'];
	$category_list	=	array(
							'notes'=>'Notes',
							'books'=>'Books',
							'qpaper'=>'Question Papers',
							'stationary'=>'Stationary',
							'electronics'=>'Electronics',
							'movies'=>'Movies',
							'others'=>'Others',
							'quantum'=>'Quantum',
							'decode'=>'Decode'
						);
	$pricing_style 	=	array(
							'free'=>'Free Gift',
							'sale'=>'Out For Sale',
							'rent'=>'Out For Rent'
						);
	#verifying if the user had verified his email id . if not he can not post adds
	$sql ="SELECT * from `user` WHERE `user`.`username` = '$username';";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	if($row['num_of_add']==0 and $row['status']!=2){
		$_SESSION["msg"]="No Adds Posted yet. Post an Add.";
	}
	if($row['status']==2){
		echo "
		<div class='row'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-12 text-center'>
							<p class = ''><b class = 'red'>Verify</b> your <b>E Mail ID</b>.</p>
						</div>
					</div>
				</div>
			</div>";
	}
	if(isset($_SESSION["msg"])){
		$msg=$_SESSION["msg"];
		echo"
			<div class='row'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-12 text-center'>
							<hr><p><i class = 'red fa fa-exclamation-circle fa-2x wow bounceIn tada'></i>&nbsp;$msg</p><hr>
						</div>
					</div>
				</div>
			</div>
	   ";
		$_SESSION["msg"]=null;
	}
	if(isset($_POST['submit_del_boxes'])){
		if(empty($_POST['del_box'])){
			echo"
			<div class='row'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-12 text-center'>
							<hr><p><i class = 'red fa fa-exclamation-circle fa-2x wow bounceIn tada'></i>&nbsp;No Add Selected To Delete</p><hr>
						</div>
					</div>
				</div>
			</div>
			";
		}
		else{
			var_dump($_POST['del_box']);
		}
	}
	if($row['num_of_add']!=0 and $row['status']!=2){
		echo "
			<div class='row'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-2 col-md-2 col-sm-2 text-center'>
							<p>Add Title</p><hr>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2 text-center'>
							<p>Category</p><hr>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2 text-center'>
							<p>Pricing Style</p><hr>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2 text-center'>
							<p>Cost</p><hr>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2 text-center'>
							<p>Add Status</p><hr>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2 text-center'>
							<p>View in Detail</p><hr>
						</div>
					</div>
				</div>
			</div>
			";

	}
	$sql = "SELECT * from `advertisement` WHERE `username` = '$username';";
   $res = mysqli_query($conn,$sql);
   $reverse_rows=array();
   $count=0;
   while($row = mysqli_fetch_assoc($res)){
		$reverse_rows[]=$row;
		$count++;
	}
	for($i=$count-1;$i>=0;$i--){
	   $title=$reverse_rows[$i]['title_of_add'];
	   $category=$reverse_rows[$i]['category'];
	   $price_status=$reverse_rows[$i]['price_status'];
	   $cost=$reverse_rows[$i]['cost'];
	   $add_status=$reverse_rows[$i]['add_status'];
	   #in DB 0=> free 1=> rent and 2=> sale for price_status
	   switch($price_status){
			case '0' :	$price_status='free';
						break;
			case '1' : $price_status='rent';
						break;
			case '2' : $price_status='sale';
						break;
	   };
	   $add_id=$reverse_rows[$i]['add_id'];
	  echo "
		<form action = 'add_description.php' method = 'POST'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-2 col-md-2 col-sm-2  text-center'>
							<h5>$title</h5>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2  text-center'>
							<h5>$category_list[$category]</h5>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2  text-center'>
							<h5>$pricing_style[$price_status]</h5>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2  text-center'>
							<h5><i class= 'fa fa-rupee fa-1x'></i>$cost/-</h5>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2  text-center'>
							<h5>$add_status</h5>
						</div>
						<div class='col-lg-2 col-md-2 col-sm-2  text-center'>
							<input type = 'text' name = 'add_id' value = '$add_id' hidden></input><input type = 'submit' name = 'view_desc' class = 'btn btn-primary' value = 'View Add'></input>
						</div>
					</div>
				</div>
		</form>";
    }
	mysqli_close($conn);
	?>

</body>
    <!-- jQuery -->
    <script src='../../js/jquery.js'></script>
	<!-- Bootstrap Core JavaScript -->
    <script src='../../js/bootstrap.min.js'></script>

</html>
