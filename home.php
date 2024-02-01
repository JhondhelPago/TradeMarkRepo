<?php

use FFI\Exception;

   session_start();

   require "php/EssentialClasses.php";   // this the reference module for classes in the php scripts

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>

<?php
$itemname = null;
$itemprice = null;
$itemcondition = null;
$itemcategory = null;
$itemmethod = null;
$itemdescription = null;

$post_id = null;

?>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["review_button"])){

        $post_id = $_POST["post_id"];

        // $username = $_POST['usersample'];
        $itemname = $_POST["item"];
        $itemprice = $_POST["price"];
        $itemcondition = $_POST["condition"];
        $itemcategory = $_POST["category"];
        $itemmethod = $_POST["method"];
        $itemdescription = $_POST["description"];
    }
}
?>


<?php

// $MyServer = new SERVER("projectdb", "post_img");
// $MyServer->Server_Conn();

// $sql = "SELECT * FROM " . $MyServer->get_table();
// $result = $MyServer->get_ServerConnection()->query($sql);



// $PostArray = PostObjectTools::PostRows_to_PostObjectArray($result);
// $Post_length = count($PostArray);


$filter_form = new FilterForm();


//$_SESSION['STATUS'] in first run is undefined because it is  defiennd in the other php file , it will onky defiend onlce the process direct to that php script and then olny that the the session variable will exist in the system

if(isset($_SESSION['STATUS'])){
    if($_SESSION['STATUS'] == "ENABLED"){
        $filter_form->Status = $_SESSION['filterForm_Status'];

        $filter_form->Method = $_SESSION['filterForm_Method'];
        $filter_form->Category = $_SESSION['filterForm_Category'];
        $filter_form->Rating =$_SESSION['filterForm_Rating'];




        //this the control flow for enabled filter parameter


        // first approach to handle this control flow is the make a query for each filter parameter, then combination of query for not null filter parameters

        //create an instance of the CustomizedQuery

        $Custom_query = new CustomizedQuery($filter_form);


        // echo "binary filters value " . $Custom_query->get_boolean_filters();
        // echo "<br>";

        // echo $Custom_query->auto_query_selection();
        $sql = $Custom_query->auto_query_selection();

        


    }
    else if($_SESSION['STATUS'] == "DISABLED"){
        $filter_form->Status = "false";

        $filter_form->Method = $_SESSION['filterForm_Method'];
        $filter_form->Category = $_SESSION['filterForm_Category'];
        $filter_form->Rating = $_SESSION['filterForm_Rating'];

        //this is the control flow for default result of post, due to null filter parameter
        $sql = "SELECT * FROM " . "`post_img`";

    }
}
else{
    //in the first run this control flow will make a default query to the $sql varible
    $sql = "SELECT * FROM " . "`post_img`";
}





// $result = $MyServer->get_ServerConnection()->query($sql);N

// $PostArray = PostObjectTools::PostRows_to_PostObjectArray($result);
// $Post_length = count($PostArray);




?>







<!-- this is the php script for fetching the record in the post_img -->
<?php


$MyServer = new SERVER("projectdb", "post_img");
$MyServer->Server_Conn();
//$sql = "SELECT * FROM " . $MyServer->get_table();
$result = $MyServer->get_ServerConnection()->query($sql);

$PostArray = PostObjectTools::PostRows_to_PostObjectArray($result);

if ($PostArray != null){
    $Post_length = count($PostArray);
}
else{
    $Post_length = 0;
}


            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="createPost.css">
    <link rel="icon" type="image/x-icon" href="PRIMARY_game-icons_cardboard-box-closed.svg">
    <link rel="stylesheet" href="css/createpost_styles.css">
    <title>Home</title>
</head>
<body>

    
<!--

    <div class="nav">
        <div class="logo">
            <p><a class="TradeMark_a_text" href="home.php">TradeMark</a> </p>
        </div>

        <div class="right-links">

            
                <a class="createpost" href="createpost.php"><button class="btn" id="createpost_btn">Create Post</button></a>
            

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users_information WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['_Name'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }
            
            echo " <a class=\"TradeMark_a_text\" href='edit.php?Id=$res_id'><button class=\"btn\">Change Profile</button></a>  ";
            ?>

            <a class="TradeMark_a_text" href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>

        -->


    <div class="home_navigation">
        <div class="Logo_text">
            <p id="TradeMark_text">TradeMark</p>
        </div>

        <div class="Search_box_div">
            <form class="Search_Bar_form">
                <input type="text"  name="SearchBox" id="SearchBox">
                <input type="button"  id="SearchButton" name="submit" value="Search">
            </form>

        </div>

        <div class="Redirection_navigation">

            <ul class="ul_list">
                <li class="Redirect"><a class="links" href="home.php"><p>Home</p></a></li>
                <li class="Redirect"><a class="links" href="">Status</a></li>
                <li class="Redirect"><a class="links" href="createpost.php">Createpost</a></li>
                <li class="Redirect"><a class="links" href="<?php echo "edit.php?Id=$res_id" ?>">User</a></li>
            </ul>

        </div>


        

    </div>

    




 

    <!--    this division is containing the search filter option
            Table for item fetching
            division for deatialed information of selected post
    -->

    <div class="Main_div_container">

        <div id="filter_param" class="inner_partion">
            

            <form class="filter_form" method="post" action="php/filter_sample.php">

                <div class="Filters" id="method_filter">
                    <h3>Method</h3>    
                    <input type="radio" id="radio_method1" name="method" value="trade only" <?php $filter_form->Method_check("trade only");?>>
                    <label for="radio_method1">trade only</label><br>

                    <input type="radio" id="radio_method2" name="method" value="top-up trade" <?php $filter_form->Method_check("top-up trade");?>>
                    <label for="radio_method2">top-up trade</label><br>

                    <input type="radio" id="radio_method3" name="method" value="trade coin" <?php $filter_form->Method_check("trade coin");?>>
                    <label for="radio_method3">trade coin</label><br>
                </div>

                <div class="Filters" id="category_filter">
                    <h3>Category</h3>
                    <input type="radio" id="radio_category1" name="category" value="electronic accessories" <?php $filter_form->Category_check("electronic accessories");?>>
                    <label for="radio_category1">Electronic Accessories</label><br>

                    <input type="radio" id="radio_category2" name="category" value="HomeApp" <?php $filter_form->Category_check("HomeApp");?>>
                    <label for="radio_category2">Home Appliances</label><br>

                    <input type="radio" id="radio_category3" name="category" value="women fashion" <?php $filter_form->Category_check("women fashion");?>>
                    <label for="radio_category3">Women's Fashion</label><br>

                    <input type="radio" id="radio_category4" name="category" value="men fashion" <?php $filter_form->Category_check("men fashion");?>>
                    <label for="radio_category4">Men's Fashion</label><br>

                    <input type="radio" id="radio_category5" name="category" value="toys collection" <?php $filter_form->Category_check("toys collection");?>>
                    <label for="radio_category5">Toys & Collectibles</label><br>

                    <input type="radio" id="radio_category6" name="category" value="sports lifestyle" <?php $filter_form->Category_check("sports lifestyle");?>>
                    <label for="radio_category6">Sports & Lifestyle</label><br>

                    <input type="radio" id="radio_category7" name="category" value="auto motive" <?php $filter_form->Category_check("auto motive");?>>
                    <label for="radio_category7">Automotive & Motorcycles</label><br>

                </div>


                <div class="Filters" id="rating_filter">
                    <h3>Rating</h3>

                    <label for="rating">Rate Scale</label>  
                    <input type="number" id="ratings" name="rating" min="1" max="5" placeholder="1 - 5" value = <?php $filter_form->Rating_check($filter_form->Rating);?>>
                </div>

                
                <input type="submit" name="filter_button" value="filter result">
                <br><br>
                <input type="submit" name="filter_button_reset" value="Reset filter">


            </form>


        </div>

        <div id="post_table" class="inner_partion">
            
            <div class="post_items">
            <!-- this area is the php script that fetch the record in post_img before -->
            
        
            <?php

                $myname = "jhondhel pago";

                if($Post_length > 0){
                    $i = 0;
                    $td_col = 0;

                    

                    while($i < $Post_length) {

                        echo "<tr>";   

                            $j = 1;
                            while($i < $Post_length && $j <= 3){

            ?>

                               
                                <td>

                                <div class="div_button">


                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                                            <input class="hidden" type="text" name="post_id" id="post_id"  value="<?php echo $PostArray[$i]->get_post_id() ?>">
                                          
                                            <div class="thumbnail_container">

                                                <div class="center_div_image">

                                                    <img class="itemImage" src="<?php echo "../image-files/" . $PostArray[$i]->Display_Item_Thumbnail() ?>" >
                                            
                                                </div>

                                            </div>
                                            

                                            <!--
                                            // echo "<input class=\"hidden\" type=\"text\" name=\"usersample\" id=\"usersample\"  value=". $myname.">";
                                            // echo "<p> username:". $myname."<p>";
                                            -->

                                            <div class="post_text_info">

                                                <input class="hidden" type="text" name="item" id="item" maxlength="50" value="<?php echo $PostArray[$i]->itemName ?>">
                                                <p> Item Name: <?php echo  $PostArray[$i]->itemName ?> <p>

                                                <input class="hidden" type="text" name="price" id="price" maxlength="20" value="<?php echo $PostArray[$i]->price ?>">
                                                <p> Price: <?php echo $PostArray[$i]->price ?> <p>

                                                <input class="hidden" type="text" name="condition" id="condition" maxlength="50" value="<?php echo $PostArray[$i]->item_condition ?>">
                                                <p> Condition: <?php echo $PostArray[$i]->item_condition ?><p>

                                                <input class="hidden" type="text" name="category" id="category"  value="<?php echo $PostArray[$i]->category ?>">
                                                <p> Category: <?php echo $PostArray[$i]->category ?><p>

                                                <?php $method = $PostArray[$i]->payment_method; ?>
                                                
                                                <input class="hidden" type="text" name="method" id="method"  value="<?php echo  $method ?>">
                                                <p> Method: <em id="detailed_paymentMethod"><?php echo $method ?> </em><p>

                                                <input class="hidden" type="text" name="description" id="description"  value="<?php echo $PostArray[$i]->description ?>">

                                             </div>
                                            <!--
                                            //echo "<p> Description: ". $PostArray[$i]->shortening_description() ."<p>";
                                            -->
                                            
                                            <div class="Review_button_parent">
                                                <input class="Review_button" type="submit" name="review_button" value="Review">
                                            </div>

                                    </form>
                                </div>
                        
                                </td>

                            <?php
                                $i++;
                                $j++;
                            ?>

                        <?php
                            }
                        
                        ?>
                        </tr>
            <?php
                    }
                }
                else{
                    echo "NO Result Found";
                }
                            
            
            ?>

            </div>

        </div>

        



        <div id="detailed_window" class="inner_partion">
            
            
           <?php

        //    echo $myname . "<br>";
        //    echo $itemname . "<br>"; 
        //    echo $itemprice . "<br>";
        //    echo $itemcondition . "<br>";
        //    echo $itemcategory . "<br>";
        //    echo $itemmethod . "<br>";
        //    echo $itemdescription . "<br>";

                // echo $post_id . "<br>";

            
                //this if statement prevent an error because the variable $post_id is not yet set, that means its value is null and the query to second server returns null since there is no return found.
            
                
            if($post_id === null){
                
                //$post_id = $PostArray[0]->get_post_id();
                if($PostArray != null){
                    $post_id = $PostArray[0]->get_post_id();
                }
            }

            
            //this is to store the $post_id that will be reference to another file.

            if($post_id != null){
            $_SESSION['post_id'] = $post_id;

            $SecondServer = new SERVER("projectdb", "post_img");

            // In this part i will ask the server in the post_img using the $post_id in the query and then dispaly the full details of the object
            
            $SecondServer->Server_Conn();
            $sql = "SELECT * FROM ". StringManipulate::wrap_string_backticks($SecondServer->get_table())  . " WHERE `id` =" . intval($post_id);
            $second_result = $SecondServer->get_ServerConnection()->query($sql);
            
             
            $DetailPostArray = PostObjectTools::PostRows_to_PostObjectArray($second_result);
            
            
           // $Detail_length = count($DetailPostArray);
            
                    

            $ThirdServer =  new SERVER("projectdb", "users_information");
            $ThirdServer->Server_Conn();
            $users_sql = "SELECT * FROM " . StringManipulate::wrap_string_backticks($ThirdServer->get_table()) . "WHERE `Email` = " . StringManipulate::wrap_string_qoutation($DetailPostArray[0]->get_email());
            $third_result = $ThirdServer->get_ServerConnection()->query($users_sql);

            
            $UserDetailArray = PostObjectTools::UserInfoRows_to_UserInfoObjectArray($third_result);

            if($UserDetailArray != null){
                $Users_info_length = count($UserDetailArray);
            }
            



            //this UserDetailArray will the value of DetailPostArray in the attribute $userInformation

            if($Users_info_length > 0){

        
            }
            else{
                echo "Users_info_lengt have zero length";
            }
                


            if($post_id != null){


            ?>

                


                    <!--
                   
                    // echo $DetailPostArray[0]->itemName . "<br>";
                    // echo $DetailPostArray[0]->item_condition . "<br>";
                    // echo $DetailPostArray[0]->category . "<br>";
                    // echo $DetailPostArray[0]->payment_method . "<br>";
                    // echo $DetailPostArray[0]->price . "<br>";
                    // echo $DetailPostArray[0]->description . "<br>";

                    -->


                    <div class="detailed_post_div">

                        <p class="detailing_info">Item Name:<em id="detailed_productname"> <?php echo $DetailPostArray[0]->itemName ?> </em></p> <br>

                        <p class="detailing_info"> Category:  <?php echo $DetailPostArray[0]->category ?></p>
                        <p class="detailing_info">Condition:  <?php echo $DetailPostArray[0]->item_condition ?></p>
                        <p class="detailing_info">Price: <?php echo $DetailPostArray[0]->price ?></p>
                        <p class="detailing_info">Method: <em id="detailed_paymentMethod"><?php echo $DetailPostArray[0]->payment_method ?></em></p>  <br>
                        <p class="detailing_info"><em id="detailed_description">Description: </em><?php echo $DetailPostArray[0]->description ?></p>
                        <!--<p class="detailing_info">post id <?php //echo $DetailPostArray[0]->get_post_id(); ?></p>  -->
                        <?php
                        
                            $_SESSION['selectedPostId_InHome'] = $DetailPostArray[0]->get_post_id();
                        ?>
 


                        <!--
                        //here there is a button for a given method

                        //redirect  to a page that handles trade coin

                        //redirect to a page that handles straight trade

                        //redirect to a page that handles top-up trade

                        require "php/SecondaryClasses.php";
                        $actionPageToPost = null;
                        -->

                        <?php
                        require "php/SecondaryClasses.php";
                        $actionPageToPost = ActionPage::PageToDirect($DetailPostArray[0]->payment_method);

                        ?>

                        
                        

                        <div class="Review_button_parent_detail">

                            <form method="post" action=<?php echo StringManipulate::wrap_string_qoutation($actionPageToPost) ?>>

                                <button class="Review_button" type ="submit"><?php echo $DetailPostArray[0]->payment_method ?></button>

                            </form>

                        </div>

                    
                    </div>


                    <div class="detailed_post_div">


                        <p class="detailing_userinfo" id="TraderInformation">Trader Information</p>

                        <p class="detailing_userinfo"> Name:  <?php echo $UserDetailArray[0]->UserName ?></p>

                        <p class="detailing_userinfo"> City:  <?php echo $UserDetailArray[0]->City ?></p>

                        <p class="detailing_userinfo"> Address:  <?php echo $UserDetailArray[0]->Address ?></p>

                        <p class="detailing_userinfo"> Mobile Number:  <?php echo $UserDetailArray[0]->Mobile_number ?></p>
                        <p class="detailing_userinfo"> Trader Rating: <?php echo $UserDetailArray[0]->Rating ?>
                        

                    </div>



                    <div class="Images_display">

                        <?php

                            for($i = 0; $i < count($DetailPostArray[0]->imageArray); $i++){

                            ?>

                                <div class="Images_display_inner">
                                    <img class="itemImage_detail" src=<?php echo  StringManipulate::wrap_string_qoutation("image-files/" . $DetailPostArray[0]->imageArray[$i]) ?>>
                                </div>

                        <?php        
                            }

                        ?>

                    </div>
                    

                 
                    

            <?php  
            }
        }

      
           ?>

        </div>

    </div>

    <?php
    
        // //try to output the MethodFilter attribute
        // echo "MethodFilter" . "<br>";
        // echo "THE VALUE OF THE SESSION[STATUS] " .  $_SESSION['STATUS'] . "<br>";

        // // echo $_SESSION['STATUS'] . "<br>";

        // // echo $_SESSION['filterForm_Method'] . "<br>";

        // // echo $_SESSION['filterForm_Category'] . "<br>";

        // // echo $_SESSION['filterForm_Rating'] . "<br>";


        // echo $filter_form->Status . "<br>";
        // echo $filter_form->Method . "<br>";
        // echo $filter_form->Category . "<br>";
        // echo $filter_form->Rating . "<br>";

        





     

            
    ?>


    
</body>
</html>