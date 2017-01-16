<?php
require ("header.php");
?>
<!-- collections -->
<?php
    $query = "$_SERVER[QUERY_STRING]";
    $query = substr($query,6);
    $uname = null;
    if(isset($_SESSION["username"])){
        $uname = $_SESSION["username"];
    }
    $sql = "SELECT * from `advertisement` WHERE `username` <> '$uname' ORDER BY posted_time DESC";
    switch($query){

        case "free" :   $sql = "SELECT * from advertisement WHERE price_status = 0 and `username` <> '$uname' ORDER BY posted_time DESC";
                        $collectionCriteria = "Freebies !";
                        $addType = "free";
                        break;

        case "rent" :   $sql = "SELECT * from advertisement WHERE price_status = 1 and `username` <> '$uname' ORDER BY posted_time DESC";
                        $collectionCriteria = "Rental Goodies !";
                        $addType = "sale";
                        break;

        case "buy"  :   $sql = "SELECT * from advertisement WHERE price_status = 2 and `username` <> '$uname' ORDER BY posted_time DESC";
                        $collectionCriteria = "Make it your's <b>sale</b>!";
                        $addType = "rent";
                        break;

        default     :   $sql = "SELECT * from advertisement WHERE category = '$query' and `username` <> '$uname' ORDER BY posted_time DESC";
                        $query = ucfirst($query);
                        $addType = $query;
                        $collectionCriteria = "Select from range of Category: <b>$query</b>";

    }
?>
<div id = "collection" class="new-collections">
    <div class="container">
        <?php
        require('connect.php');
        $res = mysqli_query($conn,$sql);
        $numOfAdds = mysqli_num_rows($res);
        if($numOfAdds == 0){
            echo "<h3 class='animated wow zoomIn' data-wow-delay='.5s'>No adds for <i>$addType</i> yet!</h3>";
        }
        else{
            ?>
            <h3 class="animated wow zoomIn" data-wow-delay=".5s">Our Collections</h3>
            <p class="est animated wow zoomIn" data-wow-delay=".5s"><?php echo $collectionCriteria;?></p>
            <?php
            }
        $rows = floor($numOfAdds/4);
        $extraCols = 0;
        if(($numOfAdds%4)!=0){
            $extraCols = $numOfAdds%4;
        }
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
                    $addID = $row['add_id'];
                    if(strlen($description)>30){
                        $description = shortenDescription($description);
                    }
                    echo "
                            <!--col-md-3 new-collections-grid represents one column of that row-->
                            <div class='col-md-3 new-collections-grid'>
                                <div class='new-collections-grid1 animated wow bounceIn' data-wow-delay='.5s'>
                                    <div class='new-collections-grid1-image'>
                                        <a href='addDescription.php?id=$addID' class='product-image'><img src = $src alt='$src ' class='img-responsive' /></a>
                                        <div class='new-collections-grid1-image-pos'>
                                            <a href='addDescription.php?id=$addID'>Quick View</a>
                                        </div>
                                        <div class='new-collections-grid1-right'>
                                        </div>
                                    </div>
                                    <h4><a href='addDescription.php'> $title </a></h4>
                                    <p> $description </p>
                                    <div class='new-collections-grid1-left simpleCart_shelfItem'>
                                        <p><span class='item_price'>Rs. $cost </span></p>
                                    </div>
                                </div>
                            </div><!--end of column-->
                            ";
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
                echo "
                            <!--col-md-3 new-collections-grid represents one column of that row-->
                            <div class='col-md-3 new-collections-grid'>
                                <div class='new-collections-grid1 animated wow bounceIn' data-wow-delay='.5s'>
                                    <div class='new-collections-grid1-image'>
                                        <a href='addDescription.php?id=$addID' class='product-image'><img src = $src alt='$src ' class='img-responsive' /></a>
                                        <div class='new-collections-grid1-image-pos'>
                                            <a href='addDescription.php?id=$addID'>Quick View</a>
                                        </div>
                                        <div class='new-collections-grid1-right'>
                                        </div>
                                    </div>
                                    <h4><a href='addDescription.php'> $title </a></h4>
                                    <p> $description </p>
                                    <div class='new-collections-grid1-left simpleCart_shelfItem'>
                                        <p><span class='item_price'>Rs. $cost </span></p>
                                    </div>
                                </div>
                            </div><!--end of column-->
                            ";
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
<?php
require ("footer.php");
?>