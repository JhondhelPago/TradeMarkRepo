<?php

require "EssentialClasses.php";
require "SecondaryClasses.php";
session_start();







$id = 0;
$selectedpost_id = $_SESSION['selectedPostId_InHome'];
$email = isset($_SESSION['valid']) ? $_SESSION['valid'] : "there is no email";
$itemName = "None";
$category = "None";
$condition = "None";
$method = "trade coin";
$price;
$description = "None";
$imageNameArray = "None";
$status = "QEUED";


if(isset($_POST['submit'])){

    
    $DateCondition = MyDateTime::DateNow();
    $TimeCondition = MyDateTime::TimeNow();

    $price = $_POST['price_amount'];

    //this process insert the datas to the offer_pool table with trade coin method value
    $MyServer = new SERVER("projectdb", "offer_pool");
    $MyServer->Server_Conn();
    $sql = "INSERT INTO " . $MyServer->get_table() . " (id, selectedpost_id, Email, ItemName, Category, item_Condition, Method, Price, Description, images, Date, Time, status)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $MyServer->get_ServerConnection()->prepare($sql);
    $stmt->bind_param("iisssssdsssss", $id, $selectedpost_id, $email, $itemName, $category, $condition, 
    $method, $price, $description, $imageNameArray, $DateCondition, $TimeCondition,  $status);

    $stmt->execute();
    //


    //after inserting the data the id of the record must be retrieve 

    $SecondServer = new SERVER("projectdb", "offer_pool");
    $SecondServer->Server_Conn(); 
    $second_sql = "SELECT * FROM " . $SecondServer->get_table() . 
    " WHERE `selectedpost_id`=" . $selectedpost_id . 
    " AND `Email`="  . StringManipulate::wrap_string_qoutation($email) . 
    " AND `Date`=" . StringManipulate::wrap_string_qoutation($DateCondition) . 
    " AND `Time`=" . Stringmanipulate::wrap_string_qoutation($TimeCondition);

    $second_result = $SecondServer->get_ServerConnection()->query($second_sql);

    //the line below is error
    $Id_OfThis_offer = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($second_result)[0]->get_offer_id();



    //after getting the id of this offer it will be an appended value to the Proposal column in the post_img

    $ThirdServer = new SERVER("projectdb", "post_img");
    $ThirdServer->Server_Conn();
    $third_sql = "SELECT * FROM " . $ThirdServer->get_table() . " WHERE `id`=" . $selectedpost_id;
    
    $third_result = $ThirdServer->get_ServerConnection()->query($third_sql);

    $ProposalArray_offerId = PostObjectTools::PostRows_to_PostObjectArray($third_result)[0]->proposals_ids_array;

   
    //this is a varible that has the indexes of the offers from the selectedpost_id and the appended id of this offer creation
    $newProposalArray_offerId = Proposal_Formatter::add_id_to_proposal($Id_OfThis_offer, $ProposalArray_offerId);


    $FourthServer = new SERVER("projectdb", "post_img");
    $FourthServer->Server_Conn();
    $fourth_sql = "UPDATE " . $FourthServer->get_table() . " SET `Proposals`=" .

    StringManipulate::wrap_string_qoutation($newProposalArray_offerId) . 
    " WHERE `id`=" . $selectedpost_id;

    $FourthServer->get_ServerConnection()->query($fourth_sql);

 
    header('Location: ../newhome.php');


}


?>