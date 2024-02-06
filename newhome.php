<?php
require "php/EssentialClasses.php";
require "php/SecondaryClasses.php";
session_start();


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



<?php

if(isset($_POST['review_button'])){
    $post_id = $_POST['post_id'];

    // $itemname = $_POST['item'];
    // $itemprice = $_POST["price"];
    // $itemcondition = $_POST["condition"];
    // $itemcategory = $_POST["category"];
    // $itemmethod = $_POST["method"];
    // $itemdescription = $_POST["description"];


    $MyServer = new SERVER("projectdb", "post_img");
    $MyServer->Server_Conn();
    $MyServer_sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `id` = " . $post_id;

    $result = $MyServer->get_ServerConnection()->query($MyServer_sql);
    $PostObject = PostObjectTools::PostRows_to_PostObjectArray($result)[0];

    $UserInfoObject = new UserInfoRetriever($PostObject->get_email());


    
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- nav css -->
    <link rel="stylesheet" href="css/nav.css">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="assets/PRIMARY_game-icons_cardboard-box-closed.svg">
    <style>
        :root {
            --primary: rgba(61, 83, 201, 1);
            --secondary: rgba(89, 61, 201, 1);
            --highlight: rgba(255, 188, 60, 1);
            --white: rgba(255, 255, 255, 1);
            --black: rgba(0, 0, 0, 1);
            --gray: rgba(239, 241, 244, 1);
        }
    </style>
    <script src="style/imgEnlarge.js"></script>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center ">
                <!-- navbar bg -->
                <div class="col-12 position-absolute top-0 justify-content-center" style="z-index: 3; background: linear-gradient(117deg, #3D53C9 40%, #593DC9 70%);">
                    <div class="navbar">
                        <div class="navbar-brand">
                            <div class="h3 fw-semibold text-light user-select-none" style="margin: 0; opacity: 0;">
                                <img class="w-25" src="assets/WHITE_game-icons_cardboard-box-closed.svg" alt="logo"/>
                                TradeMark
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- navbar -->
                <div class="col col-md-10 position-absolute top-0" style="z-index: 4;">
                    <nav class="navbar navbar-light navbar-expand-xxl">
                        <div class="container-fluid justify-content-between p-0">
                            <div class="navbar-brand">
                                <div class="h3 fw-semibold text-light m-0 user-select-none">
                                    <img class="w-25" src="assets/WHITE_game-icons_cardboard-box-closed.svg" alt="logo"/>
                                    TradeMark
                                </div>
                            </div>
                            <!-- search bar outside menu -->
                            <form class="col-5 col-xxl-3 d-none d-sm-flex d-xxl-flex">
                                <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-warning" type="s-0">
                                    <i class="uil uil-search"></i>
                                </button>
                            </form>
                            <!-- navbar menu -->
                            <button class="navbar-toggler border border-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <!-- menu icon -->
                                <i class="bi bi-list text-warning fs-1"></i>
                                <!-- <i class="bi bi-x-lg text-warning fs-1"></i> -->
                            </button>
                            <div class="col-2 collapse navbar-collapse p-2" id="navbarSupportedContent">
                                <ul class="navbar-nav mx-auto my-2 my-lg-0 align-items-center justify-content-end w-100">
                                    <!-- search bar inside menu -->
                                    <form class="container-fluid d-flex d-sm-none mb-2">
                                        <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                                        <button id="toggleBtn" class="btn btn-warning d-flex" type="submit">
                                            <i id="menuIcon" class="uil uil-search"></i>
                                        </button>
                                    </form>
                                    <li class="nav-item rounded">
                                        <a class="nav-link text-light navActive me-xxl-2 px-3 my-1 my-xxl-0 border border-light rounded disabled" aria-current="page" href="newhome.php">Home</a>
                                    </li>
                                    <!-- <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="#">Browse</a>
                                    </li> -->
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="status.php">Status</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="history.php">History</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="scratch/trademark/addBalance.php">TC Balance</a>
                                    </li>
                                    <!-- profile for sm screen -->
                                    <li class="nav-item d-xxl-none rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="edit.php">Profile</a>
                                    </li>
                                    <!-- <li class="nav-item rounded">
                                        <a class="nav-link text-light navActive ms-2 px-3 my-1 my-xl-0 border border-light rounded disabled" aria-current="page" href="#">Create Post</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="new_createpost.php">
                                            <div class="btn btn-warning scaleHover">Create Post</div>
                                        </a>
                                    </li>
                                    <!-- profile for xxl screen -->
                                    <li class="nav-item d-none d-xxl-inline">                                        
                                        <a class="nav-link" aria-current="page" href="edit.php">
                                            <div class="profile-pic-btn rounded-circle">
                                                <img class="frame bg-warning rounded-circle p-1" src="assets/profileSvg.svg" />
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- navbar menu end -->

                        </div>
                    </nav>
                </div>

                <!-- bg boxes -->
                <div class="row position-fixed" style="z-index: -1;">
                    <div class="col w-100 h-100 position-fixed top-0 start-0">
                        <div class="row h-100">
                            <div class="h-100 w-100 top-0 translate-middle" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                            <div class="position-absolute w-75 h-100 bottom-0 end-0" style=" border-radius: 10px; background-color: #d3d7eb; filter: blur(100px);"></div>
                            <div class="h-25 w-50 position-absolute bottom-0 end-0 translate-middle-y" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                        </div>
                    </div>
                </div>

                <!-- hero section -->
                <div class="col col-md-10" style="margin-top: 90px;">
                    <!-- sm screen filter btn -->
                    <div class="container-fluid d-flex justify-content-end p-0 m-0">
                        <button class="btn btn-outline-dark fs-3 fw-regular d-xl-none border-start border-end m-0 py-0" id="ocFilterToggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#filter_param" aria-controls="offcanvasWithBothOptions">FILTER</button>
                    </div>

                    <!-- main content container -->
                    <div class="row p-0 m-0 my-2 justify-content-center shadow bg-white gap-1 rounded overflow-hidden">

                        <!-- filter col -->
                        <div class="col-3 justify-content-start align-items-start bg-light p-2 m-0" style="max-width: 300px;" id="filter_param" data-bs-scroll="true" tabindex="-1" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <div class="offcanvas-header m-0 p-0 px-2">
                                <button type="button" class="btn-close d-xl-none text-reset me-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                <div class="offcanvas-title h2 fw-bold header1 m-0 p-0">FILTER</div>
                            </div>
                            <!-- filter form -->
                            <form class="offcanvas-body row m-0 p-2 gap-2 overflow-scroll filterHeight" method="post" action="php/filter_sample.php">
                                <hr class="mx-0 my-2">

                                <!-- method filter -->
                                <div class="h5 row m-0 p-0">Method</div>
                                <div class="row gap-2 m-0 p-0 px-2" id="method_filter">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_method1" name="method" value="trade only"  <?php $filter_form->Method_check("trade only");?>> 
                                            <!-- > -->
                                        <label class="form-check-label" for="radio_method1">Trade Only</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_method2" name="method" value="top-up trade" <?php $filter_form->Method_check("top-up trade");?>> 
                                            <!---->
                                        <label class="form-check-label" for="radio_method2">Top-up Trade</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_method3" name="method" value="trade coin" <?php $filter_form->Method_check("trade coin");?>> 
                                            <!-- ?>> -->
                                        <label class="form-check-label" for="radio_method3">Trade Coin</label>
                                    </div>
                                </div>
                                <hr class="mx-0 my-2">

                                <!-- category filter -->
                                <div class="h5 row m-0 p-0">Category</div>
                                <div class="row gap-2 m-0 p-0 px-2" id="category_filter">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_category1" name="category" value="electronic accessories" <?php $filter_form->Category_check("electronic accessories");?>> 
                                            
                                        <label class="form-check-label" for="radio_category1">Electronic Accessories</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_category2" name="category" value="HomeApp" <?php $filter_form->Category_check("HomeApp");?>> 
                                            
                                        <label class="form-check-label" for="radio_category2">Home Appliances</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_category3" name="category" value="women fashion" <?php $filter_form->Category_check("women fashion");?>> 
                                            
                                        <label class="form-check-label" for="radio_category3">Women's Fashion</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_category4" name="category" value="men fashion" <?php $filter_form->Category_check("men fashion");?>> 
                                            
                                        <label class="form-check-label" for="radio_category4">Men's Fashion</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_category5" name="category" value="toys collection" <?php $filter_form->Category_check("toys collection");?>> 
                                        <label class="form-check-label" for="radio_category5">Toys & Collectibles</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_category6" name="category" value="sports lifestyle" <?php $filter_form->Category_check("sports lifestyle");?>> 
                                        <label class="form-check-label" for="radio_category6">Sports & Lifestyle</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_category7" name="category" value="auto motive" <?php $filter_form->Category_check("auto motive");?>> 
                                            
                                        <label class="form-check-label" for="radio_category7">Automotive & Motorcycles</label>
                                    </div>

                                <!-- <label for="category">Select Item Category</label>
                                <select name="category">
                                    <option value="electronic accessories"></option>
                                    <option value="HomeApp"></option>
                                    <option value="women fashion"></option>
                                    <option value="men fashion"></option>
                                    <option value="toys collection"></option>
                                    <option value="sports lifestyle"></option>
                                    <option value="auto motive"></option>
                                </select> -->
                                </div>
                                <hr class="mx-0 my-2">
                
                                <!-- rating filter -->
                                <div class="h5 row m-0 p-0">Rating</div>
                                <div class="row gap-2 m-0 p-0 px-2" id="rating_filter">
                                    <label class="p-0 m-0" for="rating">Rate Scale</label>
                                    <input class="form-control" type="number" id="ratings" name="rating" min="1" max="5" placeholder="1 - 5" value = <?php $filter_form->Rating_check($filter_form->Rating);?>>
                                    <!-- value > -->
                                </div>
                                <hr class="mx-0 my-2">
                                
                                <div class="row m-0 my-3 p-0 gap-2">
                                    <input class="col-12 col-md btn btn-warning scaleHover" type="submit" name="filter_button" value="Filter Result">
                                    <input class="col-12 col-md btn btn-outline-danger" type="submit" name="filter_button_reset" value="Reset Filter">
                                </div>
                            </form>
                        </div>

                        <!-- list col -->
                        <div class="row col justify-content-center align-items-start rounded overflow-auto p-3 m-0" id="post_table" >
                            <div class="row row-cols-auto justify-content-center p-0 m-0 gap-3 postListHeight">
                                <!-- item form container -->

                                <?php
                                    for($i = 0; $i < $Post_length; $i++){
                                ?>
                                <form class="row col m-0 p-0 pb-3 pt-1 p-sm-2 bg-light justify-content-center rounded borderHover" id="itemForm" style="max-width: 190px;" method="post" action="<?php $_SERVER['PHP_SELF'] ;?>">
                                    <!-- action="" method="post"> -->
                                    <div class="row justify-content-center overflow-auto">
                                        <input class="d-none" type="text" name="post_id" id="post_id"  value="<?php echo $PostArray[$i]->get_post_id() ;?>">
                                        <!-- img/condition container -->
                                        <div class="row justify-content-center">
                                            <!-- img -->
                                            <img class="img-fluid m-0 p-0 rounded-top" style="max-width: 250px;" alt="Item Picture" src="<?php echo "../image-files/" . $PostArray[$i]->Display_Item_Thumbnail(); ?>">
                                            <!-- condition -->
                                            <input class="d-none" type="text" name="condition" id="condition" maxlength="50" value="<?php echo $PostArray[$i]->item_condition; ?>">
                                            <span class="badge rounded-0 rounded-bottom d-flex justify-content-center align-items-center m-0 p-1 bg-secondary">
                                                <?php echo $PostArray[$i]->item_condition; ?>
                                            </span>
                                        </div>
                                        
                                        <!-- post info -->
                                        <div class="row justify-content-center text-start p-0 px-2 pb-2 m-0 mt-2 gap-1 overflow-auto" style="max-width: 250px;">
                                            <!-- item name -->
                                            <input class="d-none" type="text" name="item" id="item" maxlength="60" value="<?php echo $PostArray[$i]->itemName; ?>">
                                            <h1 class="fw-semibold text-break fs-6 px-2 m-0 mt-1" style="overflow: hidden; -webkit-box-orient: vertical; -webkit-line-clamp: 3; display: -webkit-box;">
                                                <?php echo $PostArray[$i]->itemName; ?>
                                            </h1>

                                            <!-- price -->
                                            <input class="d-none" type="text" name="price" id="price" maxlength="20" value="">
                                            <p class="fs-5 fw-bold rounded px-2 m-0 mt-2" style="color: var(--primary);" data-bs-toggle="tooltip" data-bs-placement="top" title="Trade Coin">
                                                <?php if($PostArray[$i]->payment_method == "trade coin" or $PostArray[$i]->payment_method == "top-up trade"){echo "TC: " . $PostArray[$i]->price;} ;?>
                                            </p>

                                            <!-- method -->
                                            <input class="d-none" type="text" name="method" id="method"  value="<?php echo $PostArray[$i]->payment_method;  ?>">
                                            <p class="fw-semibold px-2 p-0 m-0 rounded" style="color: var(--secondary);" id="detailed_paymentMethod">
                                                
                                                <?php echo $PostArray[$i]->payment_method; ?>
                                                
                                            </p>


                                            <p class="fw-semibold px-2 p-0 m-0 rounded" style="color: var(--secondary);" id="exchange_method">
                                                Delivery Type: 
                                                <?php echo $PostArray[$i]->exchange_method; ?>
                                                
                                            </p>

                                            <!-- <input class="d-none" type="text" name="post_id" id="post_id"  value="">
                                            <p class="p-0 px-2 mb-2 m-0">
                                                New
                                                
                                            </p> -->

                                            <!-- category -->
                                            <!-- <input class="d-none" type="text" name="category" id="category"  value="">
                                            <p class="rounded px-2 m-0">
                                                Women's Fashion & Accessories
                                            </p> -->

                                            <input class="d-none" type="text" name="description" id="description"  value="">

                                            <!-- review btn -->
                                            <div class="row p-0 m-0 mt-2 mx-sm-0 mt-3">
                                                <input class="btn btn-outline-warning text-black border-black" onclick="showDetails()" id="quickViewBtn" type="submit" name="review_button" value="Quick View">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                }
                                ?>


                                <!-- temp -->
                            </div>
                        </div>

                        <!-- details col -->
                        <!-- style="background: linear-gradient(117deg, #3d52c927 40%, #593dc927 70%);" -->

                        <?php
                        
                            if(isset($PostObject)){
                            ?>
                                <div class="row col-5 col-lg-4 justify-content-center align-items-start rounded-end p-2 m-0 overflow-auto" id="detailed_window">
                                    <div class="row p-2 m-0 gap-2 postListHeight">
                                        <!-- <button type="button" class="btn-close text-reset ms-auto mb-2 m-0" onclick="hideDetails()" aria-label="Close"></button> -->
                                        <!-- img container -->
                                        <div id="quickViewImgs" class="carousel carousel-dark slide rounded" data-bs-ride="carousel">
                                            <div class="carousel-inner rounded">
                                                <!-- active img -->
                                                <?php
                                                    foreach($PostObject->imageArray as $filename){
                                                    ?>
                                                        <div class="carousel-item active">
                                                        <?php //echo "image-files/" . $filename ;?>
                                                            <img src=" <?php echo "image-files/" . $filename ;?>" class="d-block w-100 rounded" alt="Item Picture" onclick="enlargeImg()" id="imgs" style="cursor:pointer;">
                                                        </div>
                                                <?php
                                                    }
                                                ?>
                                                <!-- 2nd img remove active -->
                                            </div>
                                            <?php
                                                if(count($PostObject->imageArray) > 1){
                                                ?>
                                                    <button class="carousel-control-prev" style="opacity: 100%;" type="button" data-bs-target="#quickViewImgs" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" style="opacity: 100%;" type="button" data-bs-target="#quickViewImgs" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                        </div>
                                        <!-- <div class="row justify-content-center text-center p-0 m-0 mb-2">
                                            <image class="img-fluid m-0 p-0 rounded" style="max-width: 350px;" src="assets/sample-img.png">
                                                src=""
                                            </image>
                                        </div> -->

                                        <!-- details -->
                                        <div class="row p-0 pb-2 px-sm-3 m-0 gap-2">

                                            <!-- item name -->
                                            <p class="fw-bold fs-5 m-0 p-0" id="detailed_productname">
                                                <?php echo $PostObject->itemName; ?>
                                                
                                            </p>
                                            <!-- price -->

                                            <?php
                                                if($PostObject->payment_method == "trade coin" or  $PostObject->payment_method == "top-up trade"){
                                                ?>
                                                    <p class="fs-3 fw-semibold text-break text-center rounded p-0 m-0 mt-3" style="background: #8393ec2f;">
                                                        TC
                                                        <span>
                                                            <?php echo $PostObject->price; ?>
                                                            
                                                        </span>
                                                    </p>
                                                <?php
                                                }
                                                ?>

                                            <div class="row m-0 p-0 gap-2">
                                                
                                                <p class="col rounded d-flex align-items-center justify-content-center text-center m-0 p-2" style="background: #7c62e42f;" id="detailed_paymentMethod">
                                                    <?php echo $PostObject->payment_method; ?>
                                                    
                                                </p>
                                                <!-- condition -->
                                                <p class="col rounded d-flex align-items-center justify-content-center text-center m-0 p-2" style="background: #7c62e42f;">
                                                    <?php echo $PostObject->item_condition; ?>
                                                    
                                                </p>
                                                <!-- category -->
                                                <p class="col-12 text-center rounded m-0 mb-2 p-2" style="background: #ac55df2f;">
                                                    <?php echo $PostObject->category; ?>
                                                    
                                                </p>

                                                <p class="col-12 text-center rounded m-0 mb-2 p-2" style="background: #ac55df2f;">
                                                    <?php echo $PostObject->exchange_method; ?>
                                                    
                                                </p>
                                                
                                            </div>

                                            <!-- desc -->
                                            <h6 class="row fw-light fs-6 m-0 p-0 ">Description:</h6>
                                            <p class="m-0 p-0 px-2" id="detailed_description">
                                                <?php echo $PostObject->description; ?>
                                            </p>
                                            
                                            <h5 class="row p-0 m-0 mt-3" id="TraderInformation">Trader Information</h5>

                                            <div class="row p-0 px-2 m-0">
                                                <h6 class="m-0 p-0 d-flex gap-1 align-items-center">Trader Badge(<?php echo $UserInfoObject->userInforamation->Rating;?>)
                                                    
                                                <?php
                                                        for($i = 0; $i < (int)$UserInfoObject->userInforamation->Rating; $i++){
                                                            ?>
                                                            <span class="badge p-2 m-0" style="font-size: 0.75rem; background: var(--primary);">
                                                                <i class="bi bi-star-fill"></i>
                                                            </span>
                                                        <?php
                                                        }
                                                        ?>
                                                </h6>
                                                <h4 class="m-0 p-0 py-1"><?php echo $UserInfoObject->userInforamation->UserName; ?></h4>
                                                <h6 class="m-0 p-0 py-1"><em><?php echo $UserInfoObject->userInforamation->Email; ?></em></h6>
                                                <h6 class="m-0 p-0 py-1"><em><?php echo $UserInfoObject->userInforamation->Mobile_number; ?></em></h6>
                                                <h6 class="m-0 p-0 py-1">Location: <?php echo $UserInfoObject->userInforamation->Address; ?></h6>
                                                <h6 class="m-0 p-0 py-1">City: <?php echo $UserInfoObject->userInforamation->City; ?></h6>

                                            </div>

                                            <div class="row m-0 mt-2 mb-4 p-0 justify-content-center text-center">
                                                <form class="m-0 p-0" method="post" action="<?php echo ActionPage::PageToDirect($PostObject->payment_method); ?>">

                                                    <?php $_SESSION['selectedPostId_InHome'] = $PostObject->get_post_id() ;?>
                                                    <button class="btn btn-warning fs-5 px-3" type ="submit" >
                                                        View Item
                                                        
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php
                            }
                        ?>
                        
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- for navbar -->
    <script>
        $(document).ready(function () {
            $(document).on('click', function (e) {
                if (!$(e.target).closest('.navbar').length && !$(e.target).is('#toggleBtn')) {
                    $('#navbarSupportedContent').removeClass('show');
                }
            });
        });
    </script>

    <!-- logo -->
    <script>
        function redirectToHome() {
            window.location.href = 'home.html';
        }
    </script>

    <!-- for filter display -->
    <script>
        function handleWindowSize() {
            var screenWidth = window.innerWidth;
    
            var element = document.getElementById('filter_param');
    
            if (screenWidth < 1200) {
                element.classList.add('offcanvas');
                element.classList.add('offcanvas-start');
            } else {
                element.classList.remove('offcanvas');
                element.classList.remove('offcanvas-start');
            }
        }
        
        handleWindowSize();
        
        window.addEventListener('resize', handleWindowSize);
    </script>

    <!-- for details window close btn -->
    <!-- <script>
        const detailed_window = document.getElementById('detailed_window');
        
        function hideDetails() {
            detailed_window.style.display = 'none';
        }
        function showDetails() {
            detailed_window.style.display = 'inline';
        }
    </script> -->
<!-- 
    <script>
        // Show scrollbar on hover
        document.getElementById('post_table').addEventListener('mouseenter', function() {
            this.style.overflowY = 'scroll';
        });

        // Hide scrollbar when not hovered
        document.getElementById('post_table').addEventListener('mouseleave', function() {
            this.style.overflowY = 'hidden';
        });

        // Show scrollbar on hover
        document.getElementById('detailed_window').addEventListener('mouseenter', function() {
            this.style.overflowY = 'scroll';
        });

        // Hide scrollbar when not hovered
        document.getElementById('detailed_window').addEventListener('mouseleave', function() {
            this.style.overflowY = 'hidden';
        });
    </script> -->
</body>
</html>