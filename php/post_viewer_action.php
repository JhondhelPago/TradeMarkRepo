<?php
session_start();

if(isset($_POST['submit'])){
    $_SESSION['idForPostViewer'] = $_POST['post_id'];

    header('Location: ../post_view.php');
}
?>