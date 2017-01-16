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

    <div class='swapmart'>Add Description</div>
    <div class='welcome_dashboard'>Until now you have posted  
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
                <a class='navbar-swapmart' href='index.php'>SwapMart</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse'id = 'bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
					<li>
                        <a href='index.php'>Main Dashboard</a>
                    </li>
                    <li>
                        <a href='manage_adds.php'>Manage Adds</a>
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
	if(isset($_POST['submit_del_boxes'])){
			$title=$_POST['title'];
			$add_id=$_POST['add_id'];
			echo"
			<div class='row'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-12 text-center'>
							<hr><p><i class = 'red fa fa-xing fa-2x wow bounceIn tada'></i>&nbsp;Are You Sure you want to delete $title add?</p><hr>
						</div>
					</div>
				</div>
			</div>
			";
			 echo"
			<form action = '' method = 'POST'>
				<div class='row table_add'>
						<div class='col-lg-12 text-center'>
							<input type = 'text' name = 'add_id' value = '$add_id' hidden></input>
							<button type = 'submit' name = 'submit_no' class='btn btn-warning btn-xl wow tada'><i class = 'fa fa-2x fa-arrow-left wow tada'></i>&nbsp;No</button>
							<button type = 'submit' name = 'submit_yes' class='btn btn-danger btn-xl wow tada'><i class = 'fa fa-2x fa-trash wow tada'></i>&nbsp;Yes</button>
							<br/><br/>
						</div>
				</div>
			</form>";
	}
	if(isset($_POST['submit_no'])){
		$_SESSION['msg']="Deletion terminated!";
		header("Location: manage_adds.php");
	}
	if(isset($_POST['submit_yes'])){
		$add_id=$_POST['add_id'];
		$sql = "SELECT * FROM `user` WHERE `username` = '$username';";
		$res = mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($res);
		$num_of_add=$row['num_of_add'];
		$num_of_add-=1;
		$sql = "UPDATE `user` SET `num_of_add` = '$num_of_add' WHERE `user`.`username` = '$username';";
		$res = mysqli_query($conn,$sql);
		$sql = "DELETE FROM `advertisement` WHERE `advertisement`.`add_id` = '$add_id';";
		$res = mysqli_query($conn,$sql);
		if($res){
			$_SESSION['msg']="Add deleted successfully!";
		}
		else{
			$_SESSION['msg']="Oops! Add could not be deleted. Try again later.";
		}
		header("Location: manage_adds.php");
	}
	if(isset($_POST['view_desc'])){
		require("../connect.php");
		$add_id=$_POST['add_id'];
		$sql = "SELECT * FROM `advertisement` WHERE `add_id` = '$add_id';";
		$res = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($res);
		$title=$row['title_of_add'];
		$category=$row['category'];
		$price_status=$row['price_status'];
		$cost=$row['cost'];
		$not_rent=null;
		$rent=$row['rent'];
		$add_description=$row['description'];
		$add_status = $row['add_status'];
		$posted_time=$row['posted_time'];
		$src = "../../".$row['pic_upload_dir'];
		$year=$month=$date=$hour=$min=$sec=array();
		#in DB 0=> free 1=> rent and 2=> sale for price_status
		switch($price_status){
			case '0' :	$price_status='free';
						$rent=null;
						break;
			case '1' : $price_status='rent';
						if($rent=='1'){
							$rent='AVAILABLE';
						}
						else{
							$rent='UNAVAILABLE';
						}
						break;
			case '2' : $price_status='sale';
						$rent=null;
						break;
	   };
	   for($i=0;$i<19;$i++){
			switch ($i){
			   case 0 : $year[$i]=$posted_time[$i];
			   break;
			   case 1 : $year[$i]=$posted_time[$i];
			   break;
			   case 2 : $year[$i]=$posted_time[$i];
			   break;
			   case 3 : $year[$i]=$posted_time[$i];
			   break;
			   case 5 : $month[0]=$posted_time[$i];
			   break;
			   case 6 : $month[1]=$posted_time[$i];
			   break;
			   case 8 : $date[0]=$posted_time[$i];
			   break;
			   case 9 : $date[1]=$posted_time[$i];
			   break;
			   case 11 : $hour[0]=$posted_time[$i];
			   break;
			   case 12 : $hour[1]=$posted_time[$i];
			   break;
			   case 14 : $min[0]=$posted_time[$i];
			   break;
			   case 15 : $min[1]=$posted_time[$i];
			   break;
			   case 17 : $sec[0]=$posted_time[$i];
			   break;
			   case 18 : $sec[1]=$posted_time[$i];
			   break;
			}
		}
		if($rent=='AVAILABLE'){
			$not_rent = 'UNAVAILABLE';
		}
		elseif($rent=='UNAVAILABLE'){
			$not_rent='AVAILABLE';
		}
		else{
			$not_rent=$rent=null;#this is when the item is not for rent
		}
		$posted_time=$date[0].$date[1]."-".$month[0].$month[1]."-".$year[0].$year[1].$year[2].$year[3]." ".$hour[0].$hour[1].":".$min[0].$min[1].":".$sec[0].$sec[1];
	  if($price_status=='rent'){
		  echo "
			<form action = '' method = 'POST'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-3 text-center'>
							<hr><p>Add Title</p><hr><h5>$title</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Add Status</p><hr><h5><i class= 'green fa fa-bookmark fa-1x'></i>$add_status</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Rent Availability</p><hr><h5 class='section-heading text-center'><select name = 'rent_status'><option value='$rent'>$rent</option><option value = '$not_rent'>$not_rent</option></select>
							<button type = 'submit' name = 'rent_status_submit' class='btn btn-success btn-xs wow tada'> <i class = 'fa fa-2x fa-check wow tada'></i></button></h5>
							<input type = 'text' value = '$rent' name = 'rent_value' hidden></input>
							<input type = 'text' value = '$add_id' name = 'add_id_value' hidden></input>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Category</p><hr><h5>$category_list[$category]</h5>
						</div>
					</div>
				</div>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-3 text-center'>
							<hr><p>Pricing Style</p><hr><h5>$pricing_style[$price_status]</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Cost</p><hr><h5><i class= 'red fa fa-rupee fa-1x'></i>$cost/-</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Add Description</p><hr><h5><i class= 'fa fa-quote-left fa-1x'></i>&nbsp;$add_description&nbsp;<i class= 'fa fa-quote-right fa-1x'></i></h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Posted Time</p><hr><h5>$posted_time</h5>
						</div>
					</div>
				</div>
				<div class='box'>
                    <div class='row table_add'>
                        <div class='col-lg-12 text-center'>
                            <hr><p>Image </p><hr><h5><img src='$src' height='400' width='300'></h5>
                        </div>
                    </div>
                </div>
			</form>
		   ";
		   echo"
			<form action = '' method = 'POST'>
				<div class='row table_add'>
						<div class='col-lg-12 text-center'>
							<input type = 'text' name = 'add_id' value = $add_id hidden></input>
							<input type = 'text' name = 'title'  value = $title hidden></input>
							<button type = 'submit' name = 'submit_del_boxes' class='btn btn-danger btn-xl wow tada'><i class = 'fa fa-2x fa-xing wow tada'></i>Delete</button>
							<br/><br/>
						</div>
				</div>
			</form>";			
		}
		else{
			echo "
			<form action = '' method = 'POST'>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-3 text-center'>
							<hr><p>Add Title</p><hr><h5>$title</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Add Status</p><hr><h5><i class= 'green fa fa-bookmark fa-1x'></i>$add_status</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Rent Availability</p><hr><h5 class='section-heading text-center'>_</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Category</p><hr><h5>$category_list[$category]</h5>
						</div>
					</div>
				</div>
				<div class='box'>
					<div class='row table_add'>
						<div class='col-lg-3 text-center'>
							<hr><p>Pricing Style</p><hr><h5>$pricing_style[$price_status]</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Cost</p><hr><h5><i class= 'red fa fa-rupee fa-1x'></i>$cost/-</h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Add Description</p><hr><h5><i class= 'fa fa-quote-left fa-1x'></i>&nbsp;$add_description&nbsp;<i class= 'fa fa-quote-right fa-1x'></i></h5>
						</div>
						<div class='col-lg-3 text-center'>
							<hr><p>Posted Time</p><hr><h5>$posted_time</h5>
						</div>
					</div>
				</div>
				<div class='box'>
                    <div class='row table_add'>
                        <div class='col-lg-12 text-center'>
                            <hr><p>Image </p><hr><h5><img src='$src' height='400' width='300'></h5>
                        </div>
                    </div>
                </div>
			</form>
		   ";
		   echo"
			<form action = '' method = 'POST'>
				<div class='row table_add'>
						<div class='col-lg-12 text-center'>
							<input type = 'text' name = 'add_id' value = '$add_id' hidden></input>
							<input type = 'text' value=$title name = 'title' hidden></input>
							<button type = 'submit' name = 'submit_del_boxes' class='btn btn-danger btn-xl wow tada'><i class = 'fa fa-2x fa-xing wow tada'></i>Delete</button>
							<br/><br/>
						</div>
				</div>
			</form>";
		}
	}
	if(isset($_POST['rent_status_submit'])){
		$rent = $_POST['rent_value'];
		$add_id = $_POST['add_id_value'];
		$rent_status = $_POST['rent_status'];
		$sql=$res=null;
		if($rent_status!=$rent){
			$rent=$rent_status;
			if($rent=='AVAILABLE'){
				$rent=1;
			}
			else{
				$rent=0;
			}
			$sql = "UPDATE `advertisement` SET `rent` = '$rent' WHERE `add_id` = '$add_id';";
			$res = mysqli_query($conn,$sql);
			$_SESSION['msg']="Saved Updated Preferences.";
		}
		else{
			$_SESSION['msg']="No Change In Preferences.";
			$res=true;
		}
		var_dump($res);
		if($res){
			header("Location: manage_adds.php");
		}
	}
	mysqli_close($conn);
	?>
</body>
    <!-- jQuery -->
    <script src='../../js/jquery.js'></script>
	<!-- Bootstrap Core JavaScript -->
    <script src='../../js/bootstrap.min.js'></script>

</html>
