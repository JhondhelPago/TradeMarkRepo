<?php
require "EssentialClasses.php";
session_start();

if(isset($_POST['complete_submit'])){
    //get the record for the post_id
    $MyPostServer = new SERVER("projectdb", "post_img");
    $MyPostServer->Server_Conn();

    $MyPostServer_sql_move = "INSERT INTO history_post_img
    (`id`, `User_Id`, `Email`, `name`, `image`, `item_Condition`, `category`, `description`, `payment_method`, `price`, `Proposals`, `Date`, `Time`)" . 
    " SELECT `id`, `User_Id`, `Email`, `name`, `image`, `item_Condition`, `category`, `description`, `payment_method`, `price`, `Proposals`, `Date`, `Time` 
    FROM  " . $MyPostServer->get_table() . " WHERE `id` = " . $_POST['post_id'];

    //moved
    $MyPostServer->get_ServerConnection()->query($MyPostServer_sql_move);

    $MyPostServer_sql_delete = "DELETE FROM " . $MyPostServer->get_table() . " WHERE `id` = " . $_POST['post_id'];

    //deleted
    $MyPostServer->get_ServerConnection()->query($MyPostServer_sql_delete);
    
    //store to history_post_img
    
    




    //get the record for the offer_id
    $MyOfferServer = new SERVER("projectdb", "offer_pool");
    $MyOfferServer->Server_Conn();

    $MyOfferServer_sql_move = "INSERT INTO history_offer_pool 
    (`id`, `selectedpost_id`, `Email`, `ItemName`, `Category`, `item_Condition`, `Method`, `Price`, `Description`, `images`, `Date`, `Time`, `status`)" . 
    " SELECT `id`, `selectedpost_id`, `Email`, `ItemName`, `Category`, `item_Condition`, `Method`, `Price`, `Description`, `images`, `Date`, `Time`, `status` 
    FROM " . $MyOfferServer->get_table() . " WHERE `id` = " . $_POST['offer_id'];

    //moved
    $MyOfferServer->get_ServerConnection()->query($MyOfferServer_sql_move);


    $MyOfferServer_sql_delete = "DELETE FROM " . $MyOfferServer->get_table() . " WHERE `id` = " . $_POST['offer_id'];

    //deleted
    $MyOfferServer->get_ServerConnection()->query($MyOfferServer_sql_delete);


    //store to history_offer_pool



    header('Location: ../status.php');





}


?>