<?php
require ("header.php");
?>
<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container"> 
			<div class="banner-bottom-grids">
				<div class="banner-bottom-grid-left animated wow slideInRight" data-wow-delay=".5s">
					<div class="grid">
						<figure class="effect-julia">
							<img src="images/4.jpg" alt=" " class="img-responsive" />
							<figcaption>
								<h3>Campus's own <span>Store</span><i> for online </i>shopping!</h3>
								<div>
									<p> By Friends </p>
									<p> For Friends</p>
									<p> With Friends </p>
								</div>
							</figcaption>			
						</figure>
					</div>
				</div>
				<div class="banner-bottom-grid-left1 animated wow bounce" data-wow-delay=".5s">
					<div class="banner-bottom-grid-left-grid left1-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="images/1.jpg" alt=" " class="img-responsive" />
						</div>
						<div class="banner-bottom-grid-left1-pos">
							<p>Buy/Borrow Anything</p>
						</div>
					</div>
					<div class="banner-bottom-grid-left-grid left1-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="images/2.jpg" alt=" " class="img-responsive" />
						</div>
						<div class="banner-bottom-grid-left1-position">
							<div class="banner-bottom-grid-left1-pos1">
								<p>Choose products from your own friend's room </p>
							</div>
						</div>
					</div>
				</div>
                <div class="banner-bottom-grid-right animated wow slideInLeft" data-wow-delay=".5s">
                    <div class="grid">
                        <figure class="effect-julia">
                            <img src="images/27.jpg" alt=" " class="img-responsive" />
                            <figcaption>
                                <h3>Don't  <span>waste</span><i> your money </i> on <span>one time</span> uses.</h3>
                                <div>
                                    <p> Cheap </p>
                                    <p> Easily Available </p>
                                    <p> Quick Access </p>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //banner-bottom -->
<!-- collections -->
	<div class="new-collections" id="collection">
		<div class="container">
			<?php
            require('connect.php');
            $uname = null;
            if(isset($_SESSION["username"])){
                $uname = $_SESSION["username"];
            }
            $sql = "SELECT * from `advertisement` WHERE `username` <> '$uname'";
            $res = mysqli_query($conn,$sql);
            $numOfAdds = mysqli_num_rows($res);
            if($numOfAdds == 0){
                echo "<h3 class='animated wow zoomIn' data-wow-delay='.5s'>No adds yet!</h3>";
            }
            else{
                ?>
                <h3 class="animated wow zoomIn" data-wow-delay=".5s">Our Collections</h3>
                <p class="est animated wow zoomIn" data-wow-delay=".5s">Posted by our college mates</p>
                <?php
            }
            $rows = floor($numOfAdds/4);
            $extraCols = 0;
            if(($numOfAdds%4)!=0){
                $extraCols = $numOfAdds%4;
            }
            $sql = "SELECT * from `advertisement` ORDER BY posted_time DESC";
            $res = mysqli_query($conn,$sql);
            while($rows>0){
                ?>
                <!-- new-collections-grids represents one row-->
                <div class="new-collections-grids">
                    <?php
                    for($i=0;$i<4;$i++) {
                        $row = mysqli_fetch_assoc($res);
                        $title = $row["title_of_add"];
                        $description = $row["description"]."";
                        $cost = $row["cost"];
                        $src = "../".$row["pic_upload_dir"];
                        $addID = $row["add_id"];
                        if(strlen($description)>30){
                            $description = shortenDescription($description);
                        }
                        ?>
                            <!--col-md-3 new-collections-grid represents one column of that row-->
                            <div class='col-md-3 new-collections-grid'>
                                <div class='new-collections-grid1 animated wow bounce' data-wow-delay='.5s'>
                                    <div class='new-collections-grid1-image'>
                                        <a href='addDescription.php?id=<?php echo $addID;?>' class='product-image'><img src = <?php echo $src;?> alt='<?php echo $src;?> ' class='img-responsive' height = '300' width = '400'/></a>
                                        <div class='new-collections-grid1-image-pos'>
                                            <a href='addDescription.php?id=<?php echo $addID;?>'>Quick View</a>
                                        </div>
                                        <div class='new-collections-grid1-right'>
                                        </div>
                                    </div>
                                    <h4><a href='addDescription.php'> <?php echo $title;?> </a></h4>
                                    <p> <?php echo $description;?> </p>
                                    <div class='new-collections-grid1-left simpleCart_shelfItem'>
                                        <p><span class='item_price'>Rs. <?php echo $cost;?> </span></p>
                                    </div>
                                </div>
                            </div><!--end of column-->
                            <?php
                    }?>
                <div class="clearfix"> </div>
                </div><!--end of row-->
                <?php
                $rows--;
            }?>
            <!-- new-collections-grids represents one row-->
            <div class="new-collections-grids">
                <?php
                    while($extraCols>0){
                        $row = mysqli_fetch_assoc($res);
                        $title = $row["title_of_add"];
                        $description = $row["description"];
                        $cost = $row["cost"];
                        $src = "../".$row["pic_upload_dir"];
                        $addID = $row["add_id"];
                        if(strlen($description)>30){
                            $description = shortenDescription($description);
                        }
                        ?>
                            <!--col-md-3 new-collections-grid represents one column of that row-->
                        <div class='col-md-3 new-collections-grid'>
                            <div class='new-collections-grid1 animated wow bounce' data-wow-delay='.5s'>
                                <div class='new-collections-grid1-image'>
                                    <a href='addDescription.php?id=<?php echo $addID;?>' class='product-image'><img src = <?php echo $src;?> alt='<?php echo $src;?> ' class='img-responsive' height = '300' width = '400'/></a>
                                    <div class='new-collections-grid1-image-pos'>
                                        <a href='addDescription.php?id=<?php echo $addID;?>'>Quick View</a>
                                    </div>
                                    <div class='new-collections-grid1-right'>
                                    </div>
                                </div>
                                <h4><a href='addDescription.php'> <?php echo $title;?> </a></h4>
                                <p> <?php echo $description;?> </p>
                                <div class='new-collections-grid1-left simpleCart_shelfItem'>
                                    <p><span class='item_price'>Rs. <?php echo $cost;?> </span></p>
                                </div>
                            </div>
                        </div><!--end of column-->
                            <?php
                        $extraCols--;
                    }
                    function shortenDescription($description)
                    {
                        $desc = "";
                        $description = str_split($description, 1);
                        for ($k = 0; $k < 31; $k++) {
                            $desc = $desc . "" . $description[$k];
                        }
                        $desc = $desc . "...";
                        return $desc;
                    }
                    ?>
                <div class="clearfix"> </div>
            </div><!--end of row-->
		</div>
	</div>
<!-- //collections -->
<!-- new-timer -->
<?php
if(!(isset($_SESSION["login"]) && $_SESSION["login"])){
?>
	<div class="timer">
		<div class="container">
			<div class="timer-grids">
				<div class="col-md-8 timer-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<h3><a href="products.php"> Want to get rid of your old stuffs ?</a></h3>
                    <p>and thus...</p>
					<div class="new-collections-grid1-left simpleCart_shelfItem timer-grid-left-price">
						<p><i>help </i><i>friends</i> <span class="item_price">make money?</span></p>
						<h4> Well all you need to do is, swipe or scroll up and register with us. Once you do so you will receive a verification mail. Verify your mail ID and bingo you are good to post your own adds. But yes, they will be scrutinized for your own best experience. </h4>
						<p><a class="item_add timer_add" href="../login/register/index.php">Wow! Let's do this!! </a></p>
					</div>
				</div>
				<div class="col-md-4 timer-grid-right animated wow slideInRight" data-wow-delay=".5s">
					<img src="images/16.jpg" alt=" " class="img-responsive" />
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //new-timer -->
<?php
}
?>
<?php
require ("footer.php");
?>