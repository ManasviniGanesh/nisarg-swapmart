<?php
session_start();
if(!isset($_SESSION["username"]))
    header("Location: ../login/index.php");
require ("header.php");
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Bookmark Page</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<?php
$uname = $_SESSION["username"];

require ("connect.php");

$sql = "SELECT * FROM `bookmark` WHERE `username` = '$uname'";
$res = mysqli_query($conn,$sql);
$num = mysqli_num_rows($res);
?>
<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your wish cart contains: <span><?php echo $num;?> Products</span></h3>
			<div class="checkout-right animated wow bounceIn" data-wow-delay=".5s">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>Product</th>
							<th>Product Name</th>
							<th>Price</th>
                            <th>Rent Availablity</th>
							<th>Remove</th>
						</tr>
					</thead>
                    <?php
                    for ($i=1;$i<=$num;$i++){
                        $row = mysqli_fetch_assoc($res);
                        $rent = $row["rent"];
                        $addID = $row["add_id"];
                        $src = $row["pic_upload_dir"];
                        $src = "../".$src;
                        $cost = $row["cost"];
                        $title = $row["title_of_add"];
                        ?>
                        <tr class="rem1">
                            <td class="invert"><?php echo $i;?></td>
                            <td class="invert-image"><a href="addDescription.php?id=<?php echo $addID;?>"><img src= "<?php echo $src;?>" alt="<?php echo $src;?>" class="img-responsive" /></a></td>
                            <td class="invert"><?php echo $title;?></td>
                            <td class="invert"><?php echo $cost;?></td>
                            <?php
                            if($rent== 1)
                                echo "<td class=\"invert\">Available</td>";
                            if($rent === 0)
                                echo "<td class=\"invert\">Unavailable</td>";
                            if($rent == null)
                                echo "<td class=\"invert\"><i class=\"glyphicon-minus\"></i></td>";
                            ?>
                            <td class="invert">
                                <div class="rem">
                                    <a href="removeBookmark.php?id=<?php echo $addID?>"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
			</div>
			<div class="checkout-left">	
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Basket</h4>
					<ul>
                        <?php
                        $sql = "SELECT * FROM `bookmark` WHERE `username` = '$uname'";
                        $res = mysqli_query($conn,$sql);
                        $num = mysqli_num_rows($res);
                        $totalCharge = 0;
                        for ($i=1;$i<=$num;$i++){
                            $row = mysqli_fetch_assoc($res);
                            $cost = $row["cost"];
                            $title = $row["title_of_add"];
                            $totalCharge = $totalCharge + $cost;
                            ?>
                            <li><?php echo ucfirst($title);?> <i>-</i> <span>Rs. <?php echo $cost;?></span></li>
                            <?php
                        }
                        ?>
                        <li><b>Total <i>-</i> <span>Rs. <?php echo $totalCharge;?></span></b></li>
					</ul>
				</div>
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="index.php#collection"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //checkout -->
<?php
require ("footer.php");
?>