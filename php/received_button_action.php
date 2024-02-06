<?php
require "EssentialClasses.php";
require "SecondaryClasses.php";
session_start();

if(isset($_POST['received_button'])){
    TransactionCheck::ReceivedStatus($_POST['receiver_id'], $_POST['sender_id']);

    header('Location: ../status.php');
}


?>