<?php
session_start();
require "php/config.php";

$selectedPostId_InHome = $_SESSION['selectedPostId_InHome'];


?>


<?php
//this is the part  where we extract again the information of the $selectedPostId_InHome from the post_img table in the database

require "php/EssentialClasses.php";

$MyServer = new SERVER("projectdb", "post_img");
$MyServer->Server_Conn();
$sql="SELECT * FROM " . $MyServer->get_table() . " WHERE `id`=". $selectedPostId_InHome; 

$result = $MyServer->get_ServerConnection()->query($sql);

$DetailPostArray = PostObjectTools::PostRows_to_PostObjectArray($result);

$itemInformation = $DetailPostArray[0];




//this is the part where we get the information of the user who post the item

$MyServer1 = new SERVER("projectdb", "users_information");
$MyServer1->Server_Conn();
$sql_ForInformation = "SELECT * FROM " . $MyServer1->get_table() . " WHERE `Email`= " . StringManipulate::wrap_string_qoutation($itemInformation->get_email());
$result1 = $MyServer1->get_ServerConnection()->query($sql_ForInformation);

$TraderInformation = PostObjectTools::UserInfoRows_to_UserInfoObjectArray($result1)[0];






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trade only action</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/createpost_styles.css">
    <link rel="stylesheet" href="css/trade_only_action_style.css">

</head>
<body>

<div class="home_navigation">
        <div class="Logo_text">
            <p id="TradeMark_text">TradeMark</p>
        </div>

        
        <div class="Search_box_div">
            <form class="Search_Bar_form">
                <input type="text"  name="SearchBox" id="SearchBox">
                <input type="button"  id="SearchButton" name="submit" value="Search">
            </form>

        </div>

        
        <div class="Redirection_navigation">

            <ul class="ul_list">
                <li class="Redirect"><a class="links" href="home.php"><p>Home</p></a></li>
                <li class="Redirect"><a class="links" href="">Status</a></li>
                <li class="Redirect"><a class="links" href="createpost.php">Createpost</a></li>
                <li class="Redirect"><a class="links" href=" <?php echo "edit.php?Id=$res_id" ?>">User</a></li>
                
            </ul>

        </div>

    </div>


    <div class="main_div_trade_only">
        <div class="item_images_display">

            <?php 
            
                for($i = 0; $i < count($itemInformation->imageArray); $i++){

                    ?>

                    <div class="Images_display_inner">

                        <img class="itemImage_detail" src=<?php echo StringManipulate::wrap_string_qoutation("image-files/" . $itemInformation->imageArray[$i]) ?>>

                    </div>


                    <?php

                }
            
            ?>
        


        </div>

        <div class="information_and_form">
            <div class="trader_post_details">
                <p id="ITEMNAME"><?php echo $itemInformation->itemName ?></p> 
                <p>Trader Name: <?php echo $TraderInformation->UserName ?></p>
                <p>Trader Rating: <?php echo $TraderInformation->Rating ?></p>
                <p>Location: <?php echo $TraderInformation->Address ?> </p>

                <br>

                <p>Category: <?php echo $itemInformation->category ?> </p>
                <p>Description: <?php echo $itemInformation->description ?> </p>


            </div>




        </div>

    </div>


    
</body>
</html>