<?php

require "EssentialClasses.php";
session_start();

$_SESSION['STATUS'] = null;
$_SESSION['filterForm_Method'] = null;
$_SESSION['filterForm_Category'] = null;
$_SESSION['filterForm_rating'] = null;

$FILTERFORM_OBJ = new FilterForm();


if(isset($_POST['filter_button'])){



    // $_SESSION['filterForm_Method'] = $_POST['method'];
    // $_SESSION['filterForm_Category'] = $_POST['category'];
    // $_SESSION['filterForm_Rating'] = $_POST['rating'];
    
    
    $_SESSION['STATUS'] = "ENABLED";    

    $_SESSION['filterForm_Status'] = "true";
    $_SESSION['filterForm_Method'] = $_POST['method'];
    $_SESSION['filterForm_Category'] = $_POST['category'];
    $_SESSION['filterForm_Rating'] = $_POST['rating'];


}



if(isset($_POST['filter_button_reset'])){
    $_SESSION['STATUS'] = "DISABLED";
    

    $_SESSION['filterForm_Status'] = "false";
    $_SESSION['filterForm_Method'] = null;
    $_SESSION['filterForm_Category'] = null;
    $_SESSION['filterForm_Rating'] = null;




}


header("Location: ../newhome.php");

?>