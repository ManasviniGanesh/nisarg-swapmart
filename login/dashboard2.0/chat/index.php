    <?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: ../../index.php");
    }
    $query = $_SERVER["QUERY_STRING"];
    parse_str($query,$magic);

    $addID = isset($magic["addID"])?$magic["addID"]:null;
    $title = isset($magic["title"])?$magic["title"]:null;
    $advertUname= isset($magic["advertUname"])?$magic["advertUname"]:null;
    $enquirerUname = isset($magic["enquirerUname"])?$magic["enquirerUname"]:null;
    $mode = isset($magic["mode"])?ucfirst($magic["mode"]):null;
    $with;
    $redTag;
    $redLink;
    $quoteLine;
    $chat;
    $person;
    if($mode == "Enquire"){
        $with = "With Advertiser";
        $redTag = "BACK TO SHOPPING";
        $redLink = "../../../swapmart/addDescription.php?id=$addID";
        $quoteLine = "Ask me?";
        $person = $advertUname;
        $uname = $_SESSION["username"];
        require ("../../connect.php");
        $sql = "SELECT * FROM `chatbox` WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname'";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        $_SESSION["chat"] = $row["chat"];
        $chat = $_SESSION["chat"];
    }
    else{
        $with = "To Enquirer";
        $redTag = "BACK TO MESSEGES";
        $redLink = "../messages.php";
        $quoteLine = "Your answer..";
        parse_str($_SERVER["QUERY_STRING"],$q);
        $addID = $q["addID"];
        $uname = $q["enquirerUname"];
        $advertUname = $_SESSION["username"];
        require ("../../connect.php");
        $sql = "SELECT * FROM `chatbox` WHERE `add_id` = '$addID' and `uname` = '$uname' and `advertUname` = '$advertUname'";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        $_SESSION["chat"] = $row["chat"];
        $chat = $_SESSION["chat"];
        $person = $enquirerUname;
    }
    $uname = $_SESSION["username"];
    $msg   = isset($_GET['msg'])?$_GET['msg']:null;
    ?>
    <!DOCTYPE html>
    <html >
        <head>
            <meta charset="UTF-8">
            <title>SwapMart-Chat</title>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
            <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
            <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
            <link rel="stylesheet" href="css/style.css">

        </head>

        <body>
            <!-- Mixins-->
            <!-- Pen Title-->
            <div class="pen-title">
                <h1><?php echo $mode;?></h1><span> <?php echo $with;?> <i class='fa fa-code'></i> <a href='#'><?php echo $person;?></a></span>
            </div>
            <div class="rerun"><a href=<?php echo $redLink;?>><?php echo $redTag;?></a></div>

            <div class="container">
            <div class="card"></div>
            <div class="card">
            <h1 class="title"><?php echo $title;?></h1>
            <div>
                <?php
                if(isset($_SESSION['chat'])){
                    $chat = $_SESSION['chat'];
                    echo $chat;
                }
                ?>
                <br/>
            </div>

            <form action="insertChat.php" method="post">

                <input type="text" name = "addID" value="<?php echo $addID;?>" hidden>
                <input type="text" name = "title" value="<?php echo $title;?>" hidden>
                <input type="text" name = "mode" value="<?php echo $mode;?>" hidden>
                <input type="text" name = "<?php if(isset($magic['advertUname'])) echo 'advertUname'; else echo 'enquirerUname';?>" value="<?php if(isset($magic['advertUname'])) echo $advertUname; else echo $enquirerUname;?>" hidden>

                <div class="input-container">
                    <input type="#{type}" name = "msg" id="#{label}" required="required"/>
                    <label for="#{label}" ><?php echo $quoteLine;?></label>
                    <div class="bar"></div>
                </div>

                <div class="button-container">
                    <button><span>Send</span></button>
                </div>

            </form>
            </div>
            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script src="js/index.js"></script>

        </body>
    </html>
