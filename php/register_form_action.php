<?php
require "EssentialClasses.php";
session_start();

if(isset($_POST['submit'])){

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password == $confirm_password){
        
        $id = 0;
        $Email = $_POST['email'];
        $Password = $_POST['password'];
        $Username  = $_POST['username']; 
        $Age = $_POST['age'];
        $Gender = $_POST['gender'];
        $Address = $_POST['address'];
        $City = $_POST['city'];
        $Mobile_number = $_POST['mobile_num'];
        $Rating = 3.5;

        $MyServer = new SERVER("projectdb", "users_information");
        $MyServer->Server_Conn();
        $MyServer_sql = "INSERT INTO " . $MyServer->get_table() . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $MyServer->get_ServerConnection()->prepare($MyServer_sql);
        $stmt->bind_param("isssissssd", $id, $Email, $Password, $Username, $Age, $Gender, $Address, $City, $Mobile_number, $Rating);

        $stmt->execute();

        $_SESSION['register_valid'] = true;

        header('Location: ../login_form.php');

        


    }
    // else flow if redirect bak to register page prompt to password and confirm did not match
    else{

        $_SESSION['register_valid'] = false;

        header('Location: ../register.php');

    }


    // header('Location: ../landing_page.php');

}


?>