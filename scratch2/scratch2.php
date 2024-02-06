<?php
require "../php/EssentialClasses.php";



$result = DistanceDuration::calculateDistanceDuration("Manila", "Baguio City");

echo $result[0] . ", " . $result[1];

$time_array = explode(":", $result[1]);

echo "<br>";


$Hour = $time_array[0];
$Minute = $time_array[1];


echo (int)$Hour;

echo "<br>";

echo (int)$Minute;



?>