<?php
require "php/EssentialClasses.php";
session_start();

$MyPostServer = new SERVER('projectdb', "post_img");
$MyPostServer->Server_Conn();
$MyPostServer_sql = "SELECT * FROM " . $MyPostServer->get_table() . " WHERE `id` = " . $_SESSION['transaction_PostID'];
$result = $MyPostServer->get_ServerConnection()->query($MyPostServer_sql);
$PostObject = PostObjectTools::PostRows_to_PostObjectArray($result)[0];
$ThisPostObjectUserInfo = new UserInfoRetriever($PostObject->get_email());


$MyOfferServer = new SERVER("projectdb", "offer_pool");
$MyOfferServer->Server_Conn();
$MyOfferServer_sql = "SELECT * FROM " . $MyOfferServer->get_table() . " WHERE `id` = " . $_SESSION['transaction_OfferID'];
$result1 = $MyOfferServer->get_ServerConnection()->query($MyOfferServer_sql);
$OfferObject = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($result1)[0];
$ThisOfferObjectUserInfo = new UserInfoRetriever($OfferObject->Email);


echo $PostObject->itemName, $ThisPostObjectUserInfo->userInforamation->UserName;
echo "<br>";

echo $OfferObject->ItemName, $ThisOfferObjectUserInfo->userInforamation->UserName; 
echo "<br>";
echo $_SESSION['user_id'];
echo "<br>";

if($_SESSION['user_id'] === $ThisPostObjectUserInfo->userInforamation->user_id()){
    echo "This User is the owner of the post";
    echo $ThisPostObjectUserInfo->userInforamation->user_id();
    echo "<br>";
}elseif($_SESSION['user_id'] === $ThisOfferObjectUserInfo->userInforamation->user_id()){
    echo "This User is the owner of the offer";
    echo $ThisOfferObjectUserInfo->userInforamation->user_id();
    echo "<br>";
}

echo "This is Shipping Page";

?>