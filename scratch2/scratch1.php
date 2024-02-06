<?php 
require "../php/EssentialClasses.php";

$ArrivalTime = TimeCalcu::Arrival_time("3:15", "0:29");

echo $ArrivalTime;


echo "<br>";


$Time_remaining = TimeCalcu::CalculateTimeDif("3:20", "3:45");

echo $Time_remaining;

echo "<br>";
echo "<br>";


$Time_remaining = TimeCalcu::CalculateTimeDif("3:15", "3:45");

echo $Time_remaining;

echo "<br>";
echo "<br>";


$Percentage = TimeCalcu::time_percentage("3:15", "3:55", "3:45");

echo $Percentage;



?>