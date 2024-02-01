<?php 
require "../php/EssentialClasses.php";

$MyServer = new SERVER("projectdb", "offer_pool");
$MyServer->Server_Conn();

$sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `Email` = " . StringManipulate::wrap_string_qoutation("firstentry@gmail.com");
$MyServer->get_ServerConnection()->query($sql);

$result = $MyServer->get_ServerConnection()->query($sql);

$row = $result->fetch_assoc();

while($row){
    echo $row['User_id'];
    echo "<br>";
}



?>