<?php
require ("header.php");
$_SESSION["chat"] = null;
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" >
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Description</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<?php
require ("connect.php");
$addID = "$_SERVER[QUERY_STRING]";
$addID = substr($addID,3);
$sql = "SELECT * from advertisement WHERE add_id = '$addID' ";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$title = $row["title_of_add"];
$cost = $row["cost"];
$description = $row["description"];
$src = $row["pic_upload_dir"];
$src = "../".$src;
$pricingStyle = $row["price_status"];
$avail = null;
if($pricingStyle == 1){
    $avail = $row["rent"];
}
$advertUname = $row["username"];
$uname = isset($_SESSION["username"])?$_SESSION["username"]:null;
?>
<!-- single -->
	<div class="single">
		<div class="container">
			<div class="col-md-12 single-left">
				<div class="col-md-5 single-right-left animated wow bounceInUp" >
                    <img src="<?php echo $src;?>" data-imagezoom="true" class="img-responsive">
				</div>
				<div class="col-md-7 single-right-left simpleCart_shelfItem animated wow slideInRight" >
					<h3><?php echo $title; ?></h3>
					<h4><span class="item_price"><?php if($cost!=0)echo "Rs.".$cost; else echo "Free";?></span></h4>
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
					</div>
                    <?php
                    if(isset($avail)){
                        ?>
                        <div class="description">
                            <h5>Rent Availablity:</h5>
                            <p><?php if($avail == 0) echo "Unavailable"; else echo "Available";?></p>
                        </div>
                        <?php
                    }
                    else {
                        ?>
                        <div class="description">
                        </div>
                        <?php
                    }
                    ?>
                    <div class="occasion-cart">
                        <a class="item_add" href="addBookmark.php?id=<?php echo $addID;?>"><i class="glyphicon glyphicon-paperclip"></i> Book Mark this add</a>
                    </div>
                    <div class="social">
						<div class="social-left">
							<p>We are hiring: </p>
						</div>
						<div class="social-right">
                            <ul class="social-icons">
								<li><a href="#" class="glyphicon glyphicon-envelope black"></a> <a href="../home/index.php#contact"> Mail your resume to us now! </a></li>
							</ul>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
				<div class="bootstrap-tab animated wow bounceInDown " >
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li></li>
                            <li role="presentation" class="dropdown">
                                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Take Action <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                                    <li><a href="../login/dashboard2.0/chat/index.php?mode=enquire&addID=<?php echo $addID;?>&title=<?php echo $title;?>&advertUname=<?php echo $advertUname;?>" tabindex="-1" role="tab">Enquire</a></li>
                                    <li><a href="report.php?id=<?php echo $addID;?>" tabindex="-1" role="tab">Report to Admin</a></li>
                                </ul>
                            </li>
                        </ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
								<h5>Product Brief Description</h5>
								<p><?php echo $description; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //single -->
<?php
require ("footer.php");
?>
