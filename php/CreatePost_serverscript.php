<?php

    require "EssentialClasses.php";
    require "SecondaryClasses.php";

    session_start();
    $user_id = $_SESSION['user_id'];
    $email = isset($_SESSION['valid']) ? $_SESSION['valid'] : "there is no email";
    echo $email;


    $method;
    $itemName;
    $Address;
    $category;
    $price;
    $City;
    $condition;
    $Descrip;
    $Proposals = "None";


    

    if(isset($_POST['submit'])){
        echo "<br>";

        $itemName = $_POST['itemName'];
        echo $itemName . " item <br>";

        $method = $_POST['method'];
        echo $method . " method <br>";

        $category = $_POST['category'];
        echo $category . " category <br>";


        $price = $_POST['price'];
        echo $price . "price <br>";

        $condition = $_POST['itemCondition'];
        echo $condition . "condition <br>";

        $Descrip = $_POST['itemDescrip'];
        echo $Descrip . "descrip <br>";

        $total_num_files = count($_FILES['uploadImg']['name']);

        $filesArray = array();

        for ($i = 0; $i < $total_num_files; $i++){
            
            //this is the variable to store the actual name of the file including its extension
            $imageName = $_FILES['uploadImg']['name'][$i];

            //this variable contains the temporary name of the file, typically it is a path location in xammp
            $tmpName = $_FILES['uploadImg']["tmp_name"][$i];


            // at this line the $imageName is pass in the explode functin which returns a substrings of the $imageName at the delimiter "."
            $imageExtension = explode('.', $imageName);
            //at this line only getting the last substring in the $imageExtension, using it will acess the end substring that contains the extension of the file, and converting it to lowercase
            $imageExtension = strtolower(end($imageExtension));

            //the uniqid() returns a generated string that is unique and then append the . extension of the original file name
            $newImageName = uniqid() . "." .$imageExtension;


            move_uploaded_file($tmpName, '../image-files/' . $newImageName);
            $filesArray[] = $newImageName;
        }


        //logical statement checks the method, if the method is trade only the price will be automatically set to 0.00
        if($method == "trade only"){
            $price = 0;
        }


        $imageNameArray = json_encode($filesArray);
        
        
        $MyServer = new SERVER("projectdb", "post_img");

        $MyServer->Server_Conn();
        $sql = "INSERT INTO " . $MyServer->get_table() . " (id, User_id, Email, name, image, Item_Condition, category, description, payment_method, price, Proposals, Date, Time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $id = 0;

        $stmt = $MyServer->get_ServerConnection()->prepare($sql);
        $stmt->bind_param("iisssssssdsss", $id, $user_id, $email, $itemName, $imageNameArray, $condition, $category, $Descrip, $method, $price, $Proposals, MyDateTime::DateNow(), MyDateTime::TimeNow());
        
        if($stmt->execute()){
            echo "<script> alert(\"post uploaded. Check your post on the Status Menu\")</script>";
            header('Location: ../newhome.php');
        }
        else{
            echo "<script> alert(\"uploading failed.\")</script>";
        }
        





    }








?>