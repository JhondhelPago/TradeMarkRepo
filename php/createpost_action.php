<?php

$name = null;
$totalFiles = null;

if(isset($_POST['submit'])){
    $name = $_POST['itemname'];
    $totalFiles = count($_FILES["fileimg"]["name"]);
    $filesArray = array();


    echo $name . "\n";
    echo $totalFiles . "\n";
    echo $_FILES["fileimg"]["name"][0] . "\n";
    echo $_FILES["fileimg"]["name"][1] . "\n";
    echo $_FILES["fileimg"]["tmp_name"][0] . "\n";
}
   

?>