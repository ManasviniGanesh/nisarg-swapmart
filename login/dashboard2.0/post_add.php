<!--Will ot work on safari because empty has not been defined-->
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

    <div class='swapmart'>Post Addvertisement</div>
    <div class='welcome_dashboard'>This is going to be your 
	<?php 
		require("../connect.php");
		$username=$_SESSION['username'];  
		$sql = "SELECT * from `advertisement` WHERE `username` = '$username';"; 
		$res = mysqli_query($conn,$sql); 
		$num_of_add = mysqli_num_rows($res); 
		++$num_of_add;
		echo "<b class ='red'>$num_of_add</b>";
		switch($num_of_add){
			case 1:
			echo "<sup class ='red'>st</sup>";
			break;
			
			case 2:
			echo "<sup class ='red'>nd</sup>";
			break;
			
			case 3:
			echo "<sup class ='red'>rd</sup>";
			break;
			
			default:
			echo "<sup class ='red'>th</sup>";
		}
	?>add!</div>

    <div class="swapmart">
        <a href = "index.php" class="btn btn-warning"><i class="fa fa-backward"></i> Dashboard</a>
    </div>

    <section id="postAnAdd">
        <div class='row'>
            <div class='box'>
                <div class='col-lg-8 col-lg-offset-2 text-center'>
                    <?php
                    $sql = "SELECT * from `user` WHERE `username` = '$username'";
                    $res = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($res);
                    if($row['status']=='2'){
                        echo "<p class=''>Oops! You have <i class='red'>not verified</i> your account yet. <i class='red'>Can't</i> post any add.</p>";
                    }
                    else{
                        echo "
                        <form action = 'post_my_add.php' method = 'POST' class = 'form'>
                        <h3 class='section-heading'>
                            <b class ='form_field_title'>Title of Add</b><br/>	
                        </h3>
                        <input type = 'text' name = 'title_of_add' value = '' required/>
                        <button type = 'submit' name = 'submit_title_of_add' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
                        </form>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>
    <!-- jQuery -->
    <script src='../../js/jquery.js'></script>
	<!-- Bootstrap Core JavaScript -->
    <script src='../../js/bootstrap.min.js'></script>

</html>
