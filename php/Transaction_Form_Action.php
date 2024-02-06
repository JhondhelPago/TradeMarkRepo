<?php
session_start();
if(isset($_POST['transaction_button'])){

    if(isset($_POST['MethodTC'])){
        $_SESSION['transaction_PostID'] = $_POST['PostObjectID'];
        

        header('Location: ../progress_for_TC.php');
        exit();
    }

    if($_POST['delivery_method'] == "meetup"){
        $_SESSION['transaction_PostID'] = $_POST['PostObjectID'];
        $_SESSION['transaction_OfferID'] = $_POST['OfferObjectID'];

        header('Location: ../meet_up_page.php');
        exit();
    }else{
        $_SESSION['transaction_PostID'] = $_POST['PostObjectID'];
        $_SESSION['transaction_OfferID'] = $_POST['OfferObjectID'];

        header('Location: ../progress.php');
        exit();
    }
    
}


?>