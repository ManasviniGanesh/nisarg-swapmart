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
	<script>
		function colorChangeUpload(){
            document.getElementById("upload").setAttribute("class",'browse btn btn-success btn-xl');
		}
	</script>
<body>

<!-- ================================================== -->

<div class='swapmart'>Post Addvertisement</div>
    <div class='welcome_dashboard'>This is going to be your 
	<?php 
		require("../connect.php");
		$username=$_SESSION['username'];  
		$sql = "SELECT * from `advertisement` WHERE `username` = '$username';"; 
		$res = mysqli_query($conn,$sql); 
		$num_of_add = mysqli_num_rows($res); 
		$sql = "UPDATE `user` SET `num_of_add` = '$num_of_add' WHERE `username` = '$username';";
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

	<div class='row'>
		<div class='box'>
			<div class='col-lg-8 col-lg-offset-2 text-center'>
				<?php
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
					if(isset($_SESSION['save_status'])){
						$title_of_add=$_SESSION['title_of_add']=null;#user input
						$category=$_SESSION['category']=null;#user input
						$price_status=$_SESSION['price_status']=null;#user input
						$cost=$_SESSION['cost']=null;#user input
						$add_description=$_SESSION['add_description']=null;#user input
						$upload_dir=$_SESSION['upload_dir']=null;#user input
						$add_id=$_SESSION['add_id']=null;#computed
						$save_status=$_SESSION['save_status']=true;#arbitrary value
					}

					if(isset($_POST["submit_title_of_add"])){
						if(empty($_POST['title_of_add'])){
							echo "<p class = ''> Title .</p>";
							echo "
							<form action = '' method = 'POST' class = 'form'>
							<h3 class='section-heading'>
								<b class ='form_field_title'>Title of Add<i class = 'red'>*</i></b><br/>	
							</h3>
							<input type = 'text' name = 'title_of_add' '/>
							<button type = 'submit' name = 'submit_title_of_add' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
							</form>";
						}
						else{
							#save title_of_add in a global variable
							$_SESSION['title_of_add']=$_POST['title_of_add'];
							echo "<p class = ''> Advertisement Title - '<b>".$_SESSION['title_of_add']."</b>'. </p>";
							echo "
							<form action = '' method = 'POST' class = 'form'>
							<h3 class='section-heading'>
								<b class ='form_field_title'>Category&nbsp;</b><br/>
							</h3>
							<h5>
								Books
									<input type = 'radio' name = 'category' value = 'books' /><br/>
								Decode
									<input type = 'radio' name = 'category' value = 'decode' /><br/>
								Electronics
									<input type = 'radio' name = 'category' value = 'electronics' /><br/>
								Movies
									<input type = 'radio' name = 'category' value = 'movies' /><br/>
								Notes
									<input type = 'radio' name = 'category' value = 'notes' /><br/>
								Quantum
									<input type = 'radio' name = 'category' value = 'quantum' /><br/>
								Question Papers
									<input type = 'radio' name = 'category' value = 'qpaper' /><br/>
								Stationary
									<input type = 'radio' name = 'category' value = 'stationary' /><br/>
								Others
									<input type = 'radio' name = 'category' value = 'others' />
							</h5>
								<button type = 'submit' name = 'submit_title_of_add' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
								<button type = 'submit' name = 'submit_category' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
							</form>";
						}
					}
					if(isset($_POST["submit_category"])){
						if(empty($_POST["category"])){
							echo "<p class = ''> Category .</p>";
							echo "
							<form action = '' method = 'POST' class = 'form'>
								<h3 class='section-heading'>
									<b class ='form_field_title'>Category<i class = 'red'>*</i> &nbsp;</b><br/>
								</h3>
								<h5>
									Books
										<input type = 'radio' name = 'category' value = 'books' /><br/>
									Decode
										<input type = 'radio' name = 'category' value = 'decode' /><br/>
									Electronics
										<input type = 'radio' name = 'category' value = 'electronics' /><br/>
									Movies
										<input type = 'radio' name = 'category' value = 'movies' /><br/>
									Notes
										<input type = 'radio' name = 'category' value = 'notes' /><br/>
									Quantum
										<input type = 'radio' name = 'category' value = 'quantum' /><br/>
									Question Papers
										<input type = 'radio' name = 'category' value = 'qpaper' /><br/>
									Stationary
										<input type = 'radio' name = 'category' value = 'stationary' /><br/>
									Others
										<input type = 'radio' name = 'category' value = 'others' />
								</h5>
								<button type = 'submit' name = 'submit_title_of_add' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
								<button type = 'submit' name = 'submit_category' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
							</form>";
						}
						else{
							#save category in a global variable
							$_SESSION['category']=$_POST['category'];
							$cat=$_SESSION['category'];
							echo "<p class = ''> Advertisement Category - '<b>$category_list[$cat]</b>'</p>";
							echo "
							<form action = '' method = 'POST' class = 'form'>
								<h3 class='section-heading'>
									<b class ='form_field_title'>Price Type&nbsp;</b><br/>
								</h3>
								<h5>
									Free<input type = 'radio' name = 'price_status' value = 'free'  />&nbsp;
									sale<input type = 'radio' name = 'price_status' value = 'sale'  />&nbsp;						
									Rent<input type = 'radio' name = 'price_status' value = 'rent'  /><br/>						
									</h5>						
								<button type = 'submit' name = 'submit_category' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
								<button type = 'submit' name = 'submit_price_status' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
							</form>";
						}
					}		
					if(isset($_POST["submit_price_status"])){
						if(empty($_POST['price_status'])){
							echo "
							<form action = '' method = 'POST' class = 'form'>
								<h3 class='section-heading'>
									<b class ='form_field_title'>Price Type<i class = 'red'>*</i>&nbsp;</b><br/>
								</h3>
								<h5>
									Free<input type = 'radio' name = 'price_status' value = 'free'  />&nbsp;
									sale<input type = 'radio' name = 'price_status' value = 'sale'  />&nbsp;						
									Rent<input type = 'radio' name = 'price_status' value = 'rent'  /><br/>						
									</h5>						
								<button type = 'submit' name = 'submit_category' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
								<button type = 'submit' name = 'submit_price_status' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
							</form>";
						}
						else{
							#save price_status in a global variable
							$_SESSION['price_status']=$_POST['price_status'];
							$ps=$_SESSION['price_status'];
							echo "<p class = ''> Pricing Style Chosen : '<b>$pricing_style[$ps]</b>'</p>";
							if($_SESSION['price_status']=='sale' or $_SESSION['price_status']=='rent'){
								echo "
								<form action = '' method = 'POST' class = 'form'>
									<h3 class='section-heading form_field_title'>Cost</h3><h4 class='red'><i class= 'fa fa-rupee fa-2x'></i><input type = 'number' name = 'cost' value = '$cost' id = 'cost' ></h4>
									<button type = 'submit' name = 'submit_price_status' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
									<button type = 'submit' name = 'submit_cost' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
								</form>";
							}
							else{
								echo "
								<p class=''> Advertisement Selling Cost is '<b>Zero</b>'.</p>
								<form action = '' method = 'POST' class = 'form'>
									<h3 class='section-heading form_field_title'>Cost</h3><h4 class='red'><i class= 'fa fa-rupee fa-2x'></i><input type = 'number' name = 'cost' value = 0 disabled></h4>
									<button type = 'submit' name = 'submit_price_status' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
									<button type = 'submit' name = 'submit_cost' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
								</form>";
							}
						}
					}
					if(isset($_POST["submit_cost"])){
						if(empty($_POST["cost"])){
							if($_SESSION['price_status']=='sale' or $_SESSION['price_status']=='rent'){
								echo "
								<form action = '' method = 'POST' class = 'form'>
									<h3 class='section-heading form_field_title'>Cost<i class = 'red'>*</i></h3><h4 class='red'><i class= 'fa fa-rupee fa-2x'></i><input type = 'number' name = 'cost' value = '$cost' id = 'cost' ></h4>
									<button type = 'submit' name = 'submit_price_status' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
									<button type = 'submit' name = 'submit_cost' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
								</form>";
							}
							else{
								$_SESSION['cost']=0;
								echo"
								<form action = '' method = 'POST' class = 'form'>
									<h3 class='section-heading'>
										<b class ='form_field_title'>Description&nbsp;</b><br/>								
									</h3>								
									<textarea title = 'Description about what kind of product your selling.eg. for book author name, publisher etc..' name = 'add_description' value = '' rows = '7' cols = '60'/></textarea>
									<br/>
									<button type = 'submit' name = 'submit_cost' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
									<button type = 'submit' name = 'submit_add_description' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
.								</form>";
							}
						}
						else{
							#save cost in a global variable
							$_SESSION['cost']=$_POST['cost'];
							echo"
							<form action = '' method = 'POST' class = 'form'>
								<h3 class='section-heading'>
									<b class ='form_field_title'>Description&nbsp;</b><br/>								
								</h3>								
								<textarea title = 'Description about what kind of product your selling.eg. for book author name, publisher etc..' name = 'add_description' value = '$add_description' rows = '7' cols = '60'/></textarea>
								<br/>
								<button type = 'submit' name = 'submit_cost' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
								<button type = 'submit' name = 'submit_add_description' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
							</form>";
						}
					}
					if(isset($_POST["submit_add_description"])){
						#empty check not  - add_description is an optional field
						#save add_description in a global variable
						$_SESSION['add_description']=validate_input_data($_POST['add_description']);
						echo "<p class = ''> Add Description provided is <br/><blockquote class=''>".$_SESSION['add_description']."</blockquote></p>";
						echo"
						<form action = '' method = 'POST' enctype = 'multipart/form-data' class = 'form'>
							<h3 class='section-heading'>
								<b class ='form_field_title'><br/>
								Picture for Add...<br/><br/></b>
								<button type = 'submit' name = 'submit_add_description' class='btn btn-warning btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-left wow tada'></i></button>
								<label class='browse btn btn-info btn-xl' id='upload'>
									<input name = 'upload_add_pic' type='file' required onchange = 'colorChangeUpload()'/>
									<span><i class = 'fa fa-upload fa-2x'></i>Upload</span>
								</label>
								<button type = 'submit' name = 'submit_upload' class='btn btn-danger btn-xl wow tada'> <i class = 'fa fa-2x fa-arrow-right wow tada'></i></button>
							</h3>
						</form>";
					}
					if(isset($_POST["submit_upload"])){
						$target_dir = "add_uploads/";
						$add_id=$_SESSION['add_id'];
						$username=$_SESSION["username"];
						$uploadOK=true;
						$image_file_type = pathinfo(basename($_FILES['upload_add_pic']['name']),PATHINFO_EXTENSION);
						$check = getimagesize($_FILES["upload_add_pic"]["tmp_name"]);
						$target_file = "../../".$target_dir.$username."_".$add_id.".".$image_file_type;
                        if($check==false){
							echo "<p class = ''>File is <i class = 'red'>not</i> an <i class = 'red'>image</i>-".$check["mime"]."</p>";
							$uploadOK=false;
						}
						if(file_exists($target_file)){
							echo "<p class = ''>File <b>already exists</b>.</p>";
							$uploadOK=false;
						}
						if($uploadOK){
                            if(move_uploaded_file($_FILES["upload_add_pic"]["tmp_name"],$target_file)){
                                $_SESSION['upload_dir']=$target_file;
                                echo "<p class = ''> Upload success! : </p>"."<p class = ''>".basename($_FILES['upload_add_pic']['name'])."</p>";
                                echo"
                            <form action = '' method = 'POST' class = 'form'>
                                <h3 class='section-heading'>All Done. Click to 
                                    <b class ='form_field_title'>Submit</b> the Form.<br/>
                                    <button type = 'submit' name = 'submit_form_complete' class='btn btn-success btn-xl wow tada'> <i class = 'fa fa-2x fa-check wow tada'></i></button>
                                </h3>
                            </form>";
                            }
                            else{
                                $_SESSION["msg"]="Error Please try again.";
                                header("Location: manage_adds.php");
                            }
						}
						else{
                            $_SESSION["msg"]="Error Please try again.";
                            header("Location: manage_adds.php");
                        }
					}

					if(isset($_POST["submit_form_complete"])){
						require('../connect.php');
						#by counting num of rows per username we get no. of adds registered by each user
						$sql = "SELECT * FROM `advertisement` WHERE `username` = '$username';";
						$res = mysqli_query($conn,$sql);
						$num_of_add = mysqli_num_rows($res)+1;
						#sql query to update num_of_add in `user`
						$sql = "UPDATE `user` SET `num_of_add` = '$num_of_add' WHERE `username` = '$username';";
						$res = mysqli_query($conn,$sql);
						
						#advertisement table has to be updated
						#determining fields
						#add_id determination
						$find_id_sql =  "SELECT * from advertisement ORDER BY add_id DESC;";
						$res_find_id = mysqli_query($conn,$find_id_sql);
						$row = mysqli_fetch_assoc($res_find_id);
						#echo "num of rows till now was $count_num_row thus id will num of rows +1";
						$add_id = $row["add_id"]+1;
						#price_status=>0=free,1=rent,2=sale
						#if on rent then, rent =1 = available and rent = 0 = not available else leave as null
						if($_SESSION['price_status']=='rent'){
							$_SESSION['rent']='available';
						}
						#the values of each field
						$title_of_add=$_SESSION['title_of_add'];
						$category=$_SESSION['category'];
						$cost=$_SESSION['cost'];
						$add_description=$_SESSION['add_description'];
						$upload_dir=$_SESSION['upload_dir'];
						$_SESSION['add_id']=$add_id;
						if($_SESSION['price_status'] == 'rent'){
							$rent=1;
						}
						else{
							$rent=null;
						}
						switch($_SESSION['price_status']){
							case 'sale': $price_status=2;
							break;
							case 'rent': $price_status=1;
							break;
							case 'free': $price_status=0;
							break;
							default:$price_status=null;
						}
						$sql = "INSERT INTO `advertisement` (`add_id`, `username`, `title_of_add`, `add_status`, `rent`, `category`, `price_status`, `cost`, `pic_upload_dir`, `description`, `posted_time`) VALUES ('$add_id','$username','$title_of_add', 'posted', '$rent', '$category', '$price_status', '$cost', '$upload_dir', '$add_description', CURRENT_TIMESTAMP)";
						$res = mysqli_query($conn,$sql);
						if($res){
							$_SESSION['save_status']=null;	
							$_SESSION["msg"]="Add Posted Successfully";
						}
						else{
                            $_SESSION["msg"]="Error Please try again.";
                            header("Location: manage_adds.php");
						}

					}
					function validate_input_data($data){
						$value=htmlspecialchars(stripcslashes(trim($data)));
						return $value;
					}
				?>
			</div>
		</div>
	</div>
</body>
    <!-- jQuery -->
    <script src='../../js/jquery.js'></script>
	<!-- Bootstrap Core JavaScript -->
    <script src='../../js/bootstrap.min.js'></script>

</html>
