<?php
require "php/EssentialClasses.php";
require "php/SecondaryClasses.php";
session_start();


$MyPostServer = new SERVER("projectdb", "post_img");
$MyPostServer->Server_Conn();
$MyPostServer_sql = "SELECT * FROM " . $MyPostServer->get_table() . " WHERE `id` = " . $_SESSION['transaction_PostID'];
$result = $MyPostServer->get_ServerConnection()->query($MyPostServer_sql);
try{

    
    $PostObject = PostObjectTools::PostRows_to_PostObjectArray($result)[0];
    if($PostObject == null){
        header("Location: status.php");
        exit();
    }
    
}catch(Exception $e){
    header("Location: status.php");
}


$ThisPostObjectUserInfo = new UserInfoRetriever($PostObject->get_email());




$OfferID = StringManipulate::unwrap_square_bracket($PostObject->proposals_ids_array);

$MyOfferServer = new SERVER("projectdb", "offer_pool");
$MyOfferServer->Server_Conn();
$MyOfferServer_sql = "SELECT * FROM " . $MyOfferServer->get_table() . " WHERE `id` = " . $OfferID;
$result1 = $MyOfferServer->get_ServerConnection()->query($MyOfferServer_sql);
$OfferObject = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($result1)[0];
$ThisOfferObjectUserInfo = new UserInfoRetriever($OfferObject->Email);


// true if this is trader session, false if its receiver session
$TraderView = $_SESSION['user_id'] == $ThisPostObjectUserInfo->userInforamation->user_id();


$Sender_id;
$Receiver_id;
$SenderItem;
$ReceiverItem;

if($_SESSION['user_id'] == $ThisPostObjectUserInfo->userInforamation->user_Id()){
    $Sender_id = $ThisPostObjectUserInfo->userInforamation->user_Id();
    $Receiver_id = $ThisOfferObjectUserInfo->userInforamation->user_Id();

    $SenderInfo = $ThisPostObjectUserInfo->userInforamation;
    $SenderItem = $PostObject;

    $TCamount = $SenderItem->price;

    $ReceiverInfo = $ThisOfferObjectUserInfo->userInforamation;
    $ReceiverItem = $OfferObject;


    

}elseif($_SESSION['user_id'] == $ThisOfferObjectUserInfo->userInforamation->user_Id()){
    $Sender_id = $ThisOfferObjectUserInfo->userInforamation->user_Id();
    $Receiver_id = $ThisPostObjectUserInfo->userInforamation->user_Id();

    $SenderInfo = $ThisOfferObjectUserInfo->userInforamation;
    $SenderItem = $OfferObject;

    $ReceiverInfo = $ThisPostObjectUserInfo->userInforamation;
    $ReceiverItem = $PostObject;
}


// check if there is a record existed in the transaction_details using the sender_id and user_id
if($SenderItem->tableOrientation == "post_img"){
    $S_id = $SenderItem->get_post_id();
}else{
    $S_id = $SenderItem->get_offer_id();
}

if($ReceiverItem->tableOrientation == "post_img"){
    $R_id = $ReceiverItem->get_post_id();
}else{
    $R_id = $ReceiverItem->get_offer_id();
}

$Sender_transaction_record =  TransactionCheck::TransactionDetailsExist($S_id, $R_id);
$Receiver_transaction_record = TransactionCheck::TransactionDetailsExist($R_id, $S_id);

//if not there is existance of record of Sender and Receiver and if the record status is equal to received
if($Sender_transaction_record != null){


    if($Sender_transaction_record->status == "received"){
        // first try to using the parameter arragement $sender_id, $receiver_id
        try{
            TransactionComplete($S_id, $R_id);

            $TradeCoinTransObj = new TradeCointransfer($TCamount, $SenderInfo->user_Id(), $ReceiverInfo->user_Id());

            header("Location: status.php");

        }catch(Exception $e){
        // second try using the parameter arragement $receiver_id, $sender_id
            TransactionComplete($R_id, $S_id);

            header("Location: status.php");
        }

    }
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
    <link rel="stylesheet" href="nav.css">
    
    
    <title>Progress</title>
    <link rel="icon" type="image/x-icon" href="assets/PRIMARY_game-icons_cardboard-box-closed.svg">
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
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
                                <div class="h3 fw-semibold text-light m-0 user-select-none" style="cursor: pointer;" onclick="redirectToHome()">
                                    <img class="w-25" src="assets/WHITE_game-icons_cardboard-box-closed.svg" alt="logo"/>
                                    TradeMark
                                </div>
                            </div>
                            <!-- search bar outside menu -->
                            <form class="col-4 d-none d-sm-flex d-xxl-flex">
                                <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-warning" type="submit">
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
                                    <form class="container-fluid d-flex d-sm-none mb-3 mb-md-0">
                                        <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                                        <button id="toggleBtn" class="btn btn-warning d-flex" type="submit">
                                            <i id="menuIcon" class="uil uil-search"></i>
                                        </button>
                                    </form>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="newhome.php">Home</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="status.php">Status</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="status.php">History</a>
                                    </li>
                                    <!-- <li class="nav-item rounded">
                                        <a class="nav-link text-light navActive mx-xxl-2 px-3 my-1 my-xxl-0 border border-light rounded disabled" aria-current="page" href="history.php">History</a>
                                    </li> -->
                                    <!-- <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="#">Help</a>
                                    </li> -->
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="scratch/trademark/addBalance.php">TC Balance</a>
                                    </li>
                                    <!-- profile for sm screen -->
                                    <li class="nav-item d-xl-none rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="edit.php">Profile</a>
                                    </li>
                                    <!-- <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="createPost.html">Create Post</a>
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

                <!-- content -->
                <div class="col col-md-10" style="margin-top: 90px;">
                    <div class="container-fluid p-1" style="min-height: 85vh; max-height: 85vh;">
                        <div class="display-1 fw-bold d-flex justify-content-center text-center header1 mb-3"><?php if($TraderView){echo "Your Item To Ship";}else{echo "Your Item To Received";};?></div>

                         <!-- progress bar -->
                         <div class="progressBar d-flex bg-black rounded-pill border-top border-bottom border-1 border-black text-center position-relative m-0 mx-5 p-0" style="height: .5rem;" id="progressbar1">
                            <div class="progressFill rounded-pill" style="width: 100%; background: linear-gradient(117deg, #3D53C9 40%, #593DC9 70%);"></div>

                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint0" style="width: 2em; height: 2em; left: calc(0% - 1em)" id="point0">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point0Check"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">To Ship</p>
                            </div>
                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint25" style="width: 2em; height: 2em; left: calc(33% - 1em);" id="point33">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point33Check"></i>
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-minus" id="point33Wait"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">Out for Delivery</p>
                            </div>
                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint75" style="width: 2em; height: 2em; left: calc(67% - 1em);" id="point67">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point67Check"></i>
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-minus" id="point67Wait"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">Midpoint</p>
                            </div>
                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint100" style="width: 2em; height: 2em; left: calc(100% - 1em);" id="point100">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point100Check"></i>
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-minus" id="point100Wait"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">To Receive</p>
                            </div>
                        </div>
                        
                        <!-- <p class="row justify-content-center display-4 fw-semibold my-3 d-md-none">Current Progress</p> -->
                       
                        <!-- item card -->
                        <div class="row shadow justify-content-center align-items-center rounded bg-white" style="margin-top: 5em;">
                            <!-- pic -->
                            <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 m-3 d-inline-grid rounded overflow-auto" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                <img class="img-fluid rounded" style="cursor: pointer;" id="imgs" onclick="enlargeImg()" src="<?php if($SenderItem->tableOrientation == "post_img"){echo "image-files/" . $SenderItem->Display_Item_Thumbnail();}else{echo "offer-images-files/" . $SenderItem->Display_Item_Thumbnail();};?>" alt="Item Image" >
                            </div>
                            <!-- details -->
                            <div class="col col-sm-12 col-xl py-2 d-grid">
                                <h1 class="display-6 fw-semibold mb-3"><?php if($SenderItem->tableOrientation == "post_img"){echo $SenderItem->itemName; }else{echo $SenderItem->ItemName;}; ?></h1>
                                <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                    <p class="col lead"><?php echo $ReceiverInfo->UserName; ?></p>
                                    <p class="col lead"><?php echo $ReceiverInfo->Mobile_number; ?></p>
                                    <p class="col lead"><?php echo $ReceiverInfo->Email; ?></p>
                                    <p class="col lead d-flex d-xxl-inline justify-content-end"><?php if($Receiver_transaction_record != null){echo  $Receiver_transaction_record->id; }?></p>
                                </div>
                                <div class="row justify-content-evenly align-items-center m-0s">
                                    <p class="col lead">Origin Place: <?php echo $SenderInfo->Address . " " .$SenderInfo->City; ?></p>
                            
                                    <p class="col lead d-flex d-xxl-inline justify-content-end">Destination Place:  <?php echo $ReceiverInfo->Address . " " . $ReceiverInfo->City; ?></p>
                                </div>
                                <div class="row fs-light mb-2">
                                    <div class="col-6 justify-content-center">
                                        <div class="d-flex justify-content-center">Method:</div>
                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;"><?php if($SenderItem->tableOrientation == "post_img"){echo $SenderItem->payment_method;}else{echo $SenderItem->Method;}; ?></b>
                                    </div>
                                    <div class="col-6 justify-content-center">
                                        <div class="d-flex justify-content-center">Price:</div>
                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-break text-center" style="background: #7c62e42f;"><?php if($SenderItem->tableOrientation == "post_img"){echo $SenderItem->price;}else{echo $SenderItem->Price;};?></b>
                                    </div>
                                </div>
                                <div class="row m-0 mt-2 mb-3">

                                   <?php

                                        if($Sender_transaction_record == null){
                                        ?>
                                        
                                            <form  class="btn btn-outline-warning text-black border border-dark py-3 fs-5" method="post" action="php/ShipNowAction.php">
                                            
                                                <input type="hidden" name="sender_id" value="<?php if($SenderItem->tableOrientation == "post_img"){echo $SenderItem->get_post_id();}else{echo $SenderItem->get_offer_id();} ?>">
                                                <input type="hidden" name="receiver_id" value="<?php if($ReceiverItem->tableOrientation == "post_img"){echo $ReceiverItem->get_post_id();}else{echo $ReceiverItem->get_offer_id();} ?>">
                                                <input type="hidden" name="sender_location" value="<?php echo $SenderInfo->City; ?>">
                                                <input type="hidden" name="receiver_location" value="<?php echo $ReceiverInfo->City; ?>">
                                                <button class="btn text-black" type="submit" name="ship_now">Ship Now</button>
                                            </form>

                                        <?php
                                        }
                                    ?>

                                        <?php 
                                            if($Sender_transaction_record != null){
                                                echo $Sender_transaction_record->status;
                                                echo "<br>";
                                                echo $Sender_transaction_record->id;
                                            }
                                        ?>
                                        

                                </div>
                            </div>
                        </div>

                        <div class="display-1 fw-bold d-flex justify-content-center text-center header1 my-3">Trader Partner Item</div>

                        <!-- progress bar -->
                        <div class="progressBar d-flex bg-black rounded-pill border-top border-bottom border-1 border-black text-center position-relative m-0 mx-5 p-0" style="height: .5rem;" id="progressbar2">
                            <div class="progressFill rounded-pill" style="width: 100%; background: linear-gradient(117deg, #3D53C9 40%, #593DC9 70%);"></div>

                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint0" style="width: 2em; height: 2em; left: calc(0% - 1em)" id="point0">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point0Check2"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">To Ship</p>
                            </div>
                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint25" style="width: 2em; height: 2em; left: calc(33% - 1em);" id="point33">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point33Check2"></i>
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-minus" id="point33Wait2"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">Out for Delivery</p>
                            </div>
                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint75" style="width: 2em; height: 2em; left: calc(67% - 1em);" id="point67">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point67Check2"></i>
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-minus" id="point67Wait2"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">Midpoint</p>
                            </div>
                            <div class="position-absolute top-50 translate-middle-y text-center text-white bg-dark border border-2 border-black rounded-circle m-0 p-2 progressPoint100" style="width: 2em; height: 2em; left: calc(100% - 1em);" id="point100">
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-check" id="point100Check2"></i>
                                <i class="top-50 translate-middle m-0 p-0 position-absolute fa-solid fa-minus" id="point100Wait2"></i>
                                <p class="top-100 translate-middle-x m-2 p-0 position-absolute text-black fw-semibold ">To Receive</p>
                            </div>
                        </div>

                        <!--                        
                        <div class="row shadow justify-content-center align-items-center rounded bg-white" style="margin-top: 5rem;">
                           
                            <div class="col col-sm-12 col-xl py-2 pt-4 d-grid text-center">
                                
                                <h1 class="display-6 fw-semibold mb-3"></h1>
                                <div class="row mb-2 m-0 align-items-center">
                                    <p class="col lead text-start">CityCityCity CityCityCityCityCityCity</p>
                                    <p class="col lead text-end">#10199999</p>
                                </div>
                                <div class="row m-0 align-items-center">
                                    <p class="col lead text-start">Address Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, quam?</p>
                                    <p class="col lead text-end">01/01/2024</p>
                                </div>
                            </div>
                        </div> -->

                        <div class="row shadow justify-content-center align-items-center rounded bg-white" style="margin-top: 5em;">
                            <!-- pic -->
                            <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 m-3 d-inline-grid rounded overflow-auto" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                <img class="img-fluid rounded" style="cursor: pointer;" id="imgs" onclick="enlargeImg()" src="<?php if($ReceiverItem->tableOrientation == "post_img"){echo "image-files/" . $ReceiverItem->Display_Item_Thumbnail();}else{echo "offer-images-files/" . $ReceiverItem->Display_Item_Thumbnail();};?>" alt="Item Image" >
                            </div>
                            <!-- details -->
                            <div class="col col-sm-12 col-xl py-2 d-grid">
                                <h1 class="display-6 fw-semibold mb-3"><?php if($ReceiverItem->tableOrientation == "post_img"){echo $ReceiverItem->itemName; }else{echo $ReceiverItem->ItemName;}; ?></h1>
                                <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                    <p class="col lead"><?php echo $SenderInfo->UserName;?></p>
                                    <p class="col lead"><?php echo $SenderInfo->Mobile_number;?></p>
                                    <p class="col lead"><?php echo $SenderInfo->Email;?></p>
                                    <p class="col lead d-flex d-xxl-inline justify-content-end"><?php if($Sender_transaction_record != null){echo $Sender_transaction_record->id;}?></p>
                                </div>
                                <div class="row justify-content-evenly align-items-center m-0s">
                                    <p class="col lead">Origin Place: <?php echo $ReceiverInfo->Address . " " . $ReceiverInfo->City?></p>
                                    <p class="col lead d-flex d-xxl-inline justify-content-end">Destination Place: <?php echo $SenderInfo->Address . " " . $SenderInfo->City; ?></p>
                                </div>
                                <div class="row fs-light mb-2">
                                    <div class="col-6 justify-content-center">
                                        <div class="d-flex justify-content-center">Method:</div>
                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;"><?php if($ReceiverItem->tableOrientation == "post_img"){echo $ReceiverItem->payment_method;}else{echo $ReceiverItem->Method;};?></b>
                                    </div>
                                    <div class="col-6 justify-content-center">
                                        <div class="d-flex justify-content-center">Price:</div>
                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-break text-center" style="background: #7c62e42f;"><?php if($ReceiverItem->tableOrientation == "post_img"){echo $ReceiverItem->price;}else{echo $ReceiverItem->Price;};?></b>
                                    </div>
                                </div>
                                <!-- <div class="row m-0 mt-2 mb-3">
                                    <button class="btn btn-outline-warning text-black border border-dark py-3 fs-5">Ship Now</button>
                                </div> -->

                                
                                <?php
                                    if($Receiver_transaction_record != null and $Receiver_transaction_record->status == "to received"){
                                    ?>
                                        <form class="btn btn-outline-success text-black border border-dark py-3 fs-5" method="post" action="php/received_button_action.php">
                                            <input type="hidden" name="receiver_id" value="<?php echo $R_id;?>">
                                            <input type="hidden" name="sender_id" value="<?php echo $S_id;?>">
                                            <button class="btn" name="received_button">Received</button>
                                        </form>
                                    <?php
                                    }
                                    ?>

                                    <?php 
                                        if($Receiver_transaction_record != null){
                                            echo $Receiver_transaction_record->status; 
                                            echo "<br>";
                                            echo $Receiver_transaction_record->id;
                                        }
                                    ?>
                            </div>
                        </div>

                        <?php
                            if($Sender_transaction_record != null and TimeCalcu::time_percentage($Sender_transaction_record->shipping_time, MyDateTime::TimeNow(), $Sender_transaction_record->arrival_time) >= 1){
                                if($Sender_transaction_record->status != "to received" and $Sender_transaction_record->status != "received"){
                                TransactionCheck::ToReceivedStatus($S_id, $R_id);
                                }
                            }

                            if($Receiver_transaction_record != null and TimeCalcu::time_percentage($Receiver_transaction_record->shipping_time, MyDateTime::TimeNow(), $Receiver_transaction_record->arrival_time) >= 1){
                                
                                if($Receiver_transaction_record->status != "to received" and $Receiver_transaction_record->status != "received"){
                                TransactionCheck::ToReceivedStatus($R_id, $S_id);
                                }
                            }
                        
                        ?>

                        
                        
                    </div>

                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="imgEnlarge.js"></script>

    <!-- fontawsome -->
    <script src="https://kit.fontawesome.com/817c4fe6aa.js" crossorigin="anonymous"></script>
    
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
            window.location.href = 'newhome.php';
        }
    </script>

    <!-- progress bar -->
    <script>
        function updateProgressBar1(progressBar, barValue) {
            console.log("Updating progress bar:", barValue);
            barValue = Math.round(barValue);
            progressBar.querySelector(".progressFill").style.width = `${barValue}%`;

            const point33Check = document.querySelector("#point33Check");
            const point33Wait = document.querySelector("#point33Wait");
            const point67Check = document.querySelector("#point67Check");
            const point67Wait = document.querySelector("#point67Wait");
            const point100Check = document.querySelector("#point100Check");
            const point100Wait = document.querySelector("#point100Wait");

            if (barValue >= 33) {
                point33Check.classList.add("d-inline-block");
                point33Check.classList.remove("d-none");
                point33Wait.classList.add("d-none");
            } else {
                point33Check.classList.remove("d-inline-block");
                point33Check.classList.add("d-none");
                point33Wait.classList.remove("d-none");
            }

            if (barValue >= 67) {
                point67Check.classList.add("d-inline-block");
                point67Check.classList.remove("d-none");
                point67Wait.classList.add("d-none");
            } else {
                point67Check.classList.remove("d-inline-block");
                point67Check.classList.add("d-none");
                point67Wait.classList.remove("d-none");
            }

            if (barValue === 100) {
                point100Check.classList.add("d-inline-block");
                point100Check.classList.remove("d-none");
                point100Wait.classList.add("d-none");
            } else {
                point100Check.classList.remove("d-inline-block");
                point100Check.classList.add("d-none");
                point100Wait.classList.remove("d-none");
            }
        }

        function updateProgressBar2(progressBar2, barValue2) {
            console.log("Updating progress bar 2:", barValue2);
            barValue2 = Math.round(barValue2);
            progressBar2.querySelector(".progressFill").style.width = `${barValue2}%`;

            const point33Check2 = document.querySelector("#point33Check2");
            const point33Wait2 = document.querySelector("#point33Wait2");
            const point67Check2 = document.querySelector("#point67Check2");
            const point67Wait2 = document.querySelector("#point67Wait2");
            const point100Check2 = document.querySelector("#point100Check2");
            const point100Wait2 = document.querySelector("#point100Wait2");

            if (barValue2 >= 33) {
                point33Check2.classList.add("d-inline-block");
                point33Check2.classList.remove("d-none");
                point33Wait2.classList.add("d-none");
            } else {
                point33Check2.classList.remove("d-inline-block");
                point33Check2.classList.add("d-none");
                point33Wait2.classList.remove("d-none");
            }

            if (barValue2 >= 67) {
                point67Check2.classList.add("d-inline-block");
                point67Check2.classList.remove("d-none");
                point67Wait2.classList.add("d-none");
            } else {
                point67Check2.classList.remove("d-inline-block");
                point67Check2.classList.add("d-none");
                point67Wait2.classList.remove("d-none");
            }

            if (barValue2 === 100) {
                point100Check2.classList.add("d-inline-block");
                point100Check2.classList.remove("d-none");
                point100Wait2.classList.add("d-none");
            } else {
                point100Check2.classList.remove("d-inline-block");
                point100Check2.classList.add("d-none");
                point100Wait2.classList.remove("d-none");
            }
        }

        // Example 20% yung progress bar 1
        const progressBar1 = document.querySelector("#progressbar1");
        updateProgressBar1(progressBar1, <?php if($Sender_transaction_record != null){ echo $percentage = 100 * TimeCalcu::time_percentage($Sender_transaction_record->shipping_time, MyDateTime::TimeNow(), $Sender_transaction_record->arrival_time);};?>);
        
        // Example 70% yung progress bar 1
        const progressBar2 = document.querySelector("#progressbar2");
        updateProgressBar2(progressBar2,   <?php if($Receiver_transaction_record != null){echo $percentage = 100 * TimeCalcu::time_percentage($Receiver_transaction_record->shipping_time, MyDateTime::TimeNow(), $Receiver_transaction_record->arrival_time);}; ?>);
    </script>

</body>
</html>