<?php
require "EssentialClasses.php";
Require "SecondaryClasses.php";

session_start();

if(isset($_POST['submit'])){
    $id = 0;
    $User_Id = $_SESSION['user_id'];
    $Email = $_SESSION['valid'];
    $ItemName = $_POST['itemName'];
    $ItemCondition = $_POST['itemCondition'];
    $Category = $_POST['category'];
    $Description = $_POST['itemDescrip'];
    $PaymentMethod = "trade coin";
    $Price = $_POST['price'];
    $Proposals ="None";
    $Date = MyDateTime::DateNow();
    $Time = MyDateTime::TimeNow();

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


    $imageNameArray = json_encode($filesArray);

    $MyServer = new SERVER("projectdb", "post_img");
    $MyServer->Server_Conn();
    $MyServer_sql = "INSERT INTO " . $MyServer->get_table() . " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $MyServer->get_ServerConnection()->prepare($MyServer_sql);
    $stmt->bind_param("iisssssssdsss", $id, $User_Id, $Email, $ItemName, $imageNameArray, $ItemCondition, $Category, $Description, $PaymentMethod, $Price, $Proposals, $Date, $Time);

    $stmt->execute();


    header('Location: ../newhome.php');
    
}


?>