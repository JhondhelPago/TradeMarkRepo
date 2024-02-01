<?php
session_start();

if(isset($_POST['viewer'])){

    $_SESSION['idForViewer'] = $_POST['offer_id'];

    header('Location: ../plain_viewer.php');




}



?>