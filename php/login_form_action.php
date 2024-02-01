<?php 

session_start();
include("config.php");
 
require "EssentialClasses.php";

if(isset($_POST['submit'])){

    $input_email = $_POST['email'];
    $input_password = $_POST['password'];




    $MyServer = new SERVER("projectdb", "users_information");
    $MyServer->Server_Conn();
    $sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `Email` = "  . StringManipulate::wrap_string_qoutation($input_email) . " AND `Password` = " . StringManipulate::wrap_string_qoutation($input_password);
    $result = $MyServer->get_ServerConnection()->query($sql);

    if($result){
        $row = $result->fetch_assoc();
        

            if($row != null){

                $_SESSION['user_id'] = $row['Id'];
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['age'] = $row['Age'];
                $_SESSION['id'] = $row['Id'];


                $_SESSION['Login_validate'] = true;
                header("Location: ../newhome.php");



            }
            else{
                $_SESSION['Login_validate'] = false;
                header("Location: ../login_form.php");

            }

        
        
    }else{
        echo "Errror: " . $sql . "<br>" . $MyServer->get_ServerConnection()->error;
    }


}

              

?>



