<?php
require "EssentialClasses.php";
require "SecondaryClasses.php";
session_start();

if(isset($_POST['ship_now'])){
    $id = $_POST['sender_id'] .  "-" . $_POST['receiver_id'] . "-" . CodeGenerator::GenerateRandomCode();
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $transaction_mode = "shipment";
    $date_of_shipment = MyDateTime::DateNow();
    $arrival_date = MyDateTime::DateNow();
    $shipping_time = MyDateTime::TimeNow();
    $arrival_time = TimeCalcu::Arrival_time(MyDateTime::TimeNow(), DistanceDuration::calculateDistanceDuration($_POST['sender_location'], $_POST["receiver_location"])[1]);
    $status = "shipping";
   
    

    $MyServer = new SERVER("projectdb", "transaction_details");
    $MyServer->Server_Conn();
    $MyServer_sql = "INSERT INTO " . $MyServer->get_table() . " (id, sender_id, receiver_id, transaction_mode, date_of_shipment, arrival_date, shipping_time, arrival_time, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $MyServer->get_ServerConnection()->prepare($MyServer_sql);

    $stmt->bind_param("siissssss", $id, $sender_id, $receiver_id, $transaction_mode, $date_of_shipment, $arrival_date, $shipping_time, $arrival_time, $status);
    $stmt->execute();


   



    header('Location: ../status.php');

}

?>