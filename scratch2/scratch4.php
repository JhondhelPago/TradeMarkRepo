<?php
require "../php/EssentialClasses.php";


$TC_Transfer_obj =  new TradeCointransfer(10, 1000, 1003);


$TC_Transfer_obj->minus_balance();
$TC_Transfer_obj->plus_balance();



?>