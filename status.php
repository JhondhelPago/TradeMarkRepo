<?php
require "php/EssentialClasses.php";
session_start();
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['valid'];


$ActiveOffer = new ActiveOffer($user_email);
$TradeCoinOffers = array();
$TopUpOffers = array();
$TradeOnlyOffers =  array();

if($ActiveOffer->userActiveOfferArray != null){
    for($i = 0; $i < count($ActiveOffer->userActiveOfferArray); $i++){

        if($ActiveOffer->userActiveOfferArray[$i]->Method == "trade coin"){

            $TradeCoinOffers[] = new StatusOffer($ActiveOffer->userActiveOfferArray[$i]);

        }elseif($ActiveOffer->userActiveOfferArray[$i]->Method == "top-up trade"){

            $TopUpOffers[] = new StatusOffer($ActiveOffer->userActiveOfferArray[$i]);

        }elseif($ActiveOffer->userActiveOfferArray[$i]->Method == "trade only"){

            $TradeOnlyOffers[] = new StatusOffer($ActiveOffer->userActiveOfferArray[$i]);

        }

    }

}



$ActivePost = new ActivePost($user_id);


$TradeCoinPosts = array();
$TopUpTradePosts = array();
$TradeOnlyPosts = array();


if($ActivePost->userActivePostArray != null){
    for($i = 0; $i < count($ActivePost->userActivePostArray); $i++){

        if($ActivePost->userActivePostArray[$i]->payment_method == "trade coin"){

            $TradeCoinPosts[] = new StatusTradeCoin($ActivePost->userActivePostArray[$i]);

        }elseif($ActivePost->userActivePostArray[$i]->payment_method == "top-up trade"){

            $TopUpTradePosts[] = new StatusTopUpTrade($ActivePost->userActivePostArray[$i]);

        }elseif($ActivePost->userActivePostArray[$i]->payment_method == "trade only"){

            $TradeOnlyPosts[] = new StatusTradeOnly($ActivePost->userActivePostArray[$i]);


        }

    }
}













//make a logic to place the offer_pool object to its corresponding post_img object

//procedure for trade coin post_img

// $ListOfTradeCoinOffer = new StatusTradeCoinArray();

// foreach($ActivePost->get_TradeCoinArrayIndexes() as $Tradecoin_key){

//     $offer_pool_ids = $ActivePost->userActivePostArray[$Tradecoin_key]->proposals_ids_array;

//     if($offer_pool_ids != "None"){
        
//         $offer_pool_ids = StringManipulate::unwrap_square_bracket($offer_pool_ids);

//         $offer_pool_ids = StringManipulate::wrap_OpenClose_paranthesis($offer_pool_ids);
        
//         $TradeCoinServer = new SERVER("projectdb", "offer_pool");
//         $TradeCoinServer->Server_Conn();
//         $TradeCoin_sql = "SELECT * FROM "  . $TradeCoinServer->get_table() . " WHERE `id` IN " . $offer_pool_ids;

//         $TradeCoin_result = $TradeCoinServer->get_ServerConnection()->query($TradeCoin_sql);

//         $TradeCoinOffers = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($TradeCoin_result);

//         foreach($TradeCoinOffers as $Offer){
//             $tradecoin_offer = new TradeCoinOffer($Tradecoin_key, $Offer);
//             $ListOfTradeCoinOffer->add_Offer($tradecoin_offer);

//         }


//     }
    

// }












//procedure for top-up trade post_img

// $ListOfTopUpTradeOffer = new StatusTradeCoinArray();

// foreach($ActivePost->get_TopUpArrayIndexes() as $TopUpTrade_key){

//     $offer_pool_ids = $ActivePost->userActivePostArray[$TopUpTrade_key]->proposals_ids_array;

//     if($offer_pool_ids != "None"){

//         $offer_pool_ids = StringManipulate::unwrap_square_bracket($offer_pool_ids);

//         $offer_pool_ids = StringManipulate::wrap_OpenClose_paranthesis($offer_pool_ids);

//         $TopUpTradeServer = new SERVER("projectdb", "offer_pool");
//         $TopUpTradeServer->Server_Conn();
//         $TopUpTrade_sql = "SELECT * FROM " . $TopUpTradeServer->get_table() . " WHERE `id` IN " . $offer_pool_ids;

//         $TopUpTrade_result = $TopUpTradeServer->get_ServerConnection()->query($TopUpTrade_sql);

//         $TopUpTradeOffers = PostObjectTools::PostWithOfferRows_to_PostWithOfferObjectArray($TopUpTrade_result);

//         foreach($TopUpTradeOffers as $Offer){
//             $top_up_trade_offer = new TopUpOffer($TopUpTrade_key, $Offer);
//             $ListOfTopUpTradeOffer->add_Offer($top_up_trade_offer);
//         }

//     }


// }

    










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
    
    <style>
        :root {
            --primary: rgba(61, 83, 201, 1);
            --secondary: rgba(89, 61, 201, 1);
            --highlight: rgba(255, 188, 60, 1);
            --white: rgba(255, 255, 255, 1);
            --black: rgba(0, 0, 0, 1);
            --gray: rgba(239, 241, 244, 1);
        }
        * {
            font-family: "Poppins", sans-serif;
        }
        .navbar-collapse{
            background: transparent;
        }
        @media (max-width: 1399px){
            .navbar-collapse{
                background: rgba(0, 0, 0, 0.459);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(6.2px);
            -webkit-backdrop-filter: blur(6.2px);
            border-radius: 10px;;
            }
        }
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: transparent; 
        }
        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #888; 
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555; 
        }
        .navHover{
            transition: all 0.1s ease-in-out;
        }
        .navHover:hover{
            padding: 0px 10px 0px 10px;
            background: rgba(255, 193, 7, 0);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(6.1px);
            -webkit-backdrop-filter: blur(6.1px);
            border: 1px solid rgba(255, 193, 7, 1);
        }
        .navActive{
            cursor: default;
        }
        /* .profile-pic-btn{
            transition: all 0.1s ease-in-out;
            border-radius: 50%;
        }
        .profile-pic-btn:hover{
            padding: 1px;
            border: 1px solid var(--black);
        } */
        .header1{
            color: transparent;
            -webkit-text-stroke: 1px black;
        }
    </style>
    <title>Status</title>
    <link rel="icon" type="image/x-icon" href="assets/PRIMARY_game-icons_cardboard-box-closed.svg">
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center ">
                <!-- navbar bg -->
                <div class="col-12 position-absolute top-0 justify-content-center" style="z-index: 3; background: linear-gradient(117deg, #3D53C9 40%, #593DC9 70%);">
                    <div class="navbar">
                        <div class="navbar-brand">
                            <div class="h3 fw-semibold text-light" style="margin: 0; opacity: 0;">
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
                                <div class="h3 fw-semibold text-light m-0">
                                    <img class="w-25" src="assets/WHITE_game-icons_cardboard-box-closed.svg" alt="logo"/>
                                    TradeMark
                                </div>
                            </div>
                            <!-- search bar outside menu -->
                            <form class="col-4 d-none d-sm-flex d-xl-flex">
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
                                    <form class="container-fluid d-flex d-sm-none mb-2">
                                        <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                                        <button id="toggleBtn" class="btn btn-warning d-flex" type="submit">
                                            <i id="menuIcon" class="uil uil-search"></i>
                                        </button>
                                    </form>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="newhome.php">Home</a>
                                    </li>
                                    <!-- <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="#">Browse</a>
                                    </li> -->
                                    <li class="nav-item rounded">
                                        <a class="nav-link text-light navActive mx-xxl-2 px-3 my-1 my-xxl-0 border border-light rounded disabled" aria-current="page" href="#">Status</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="history.php">History</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="">TC Balance</a>
                                    </li>
                                    <!-- profile for sm screen -->
                                    <li class="nav-item d-xxl-none rounded navHover">
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
                        <div class="row h-100" >
                            <div class="h-100 w-100 top-0 translate-middle" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                            <div class="position-absolute w-75 h-100 bottom-0 end-0" style=" border-radius: 10px; background-color: #d3d7eb; filter: blur(100px);"></div>
                            <div class="h-25 w-50 position-absolute bottom-0 end-0 translate-middle-y" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                        </div>
                    </div>
                </div>

                <!-- hero section -->
                <div class="col col-md-10" style="margin-top: 90px;">
                    <div class="container-fluid p-1 " style="min-height: 85vh; max-height: 85vh;">
                        <div class="display-1 fw-bold d-flex justify-content-center header1 mb-3">Status</div>
                        <!-- switch btn -->
                        <div class="row justify-content-center mb-4">
                            <div class="col-9 col-md-8 col-xxl-4 btn-group border border-dark p-0" role="group" aria-label="Switch list button">
                                <input type="radio" class="btn-check" name="btnradio" id="buyerBtn" autocomplete="off" checked>
                                <label class="btn btn-outline-warning text-dark border-0 rounded-end" for="buyerBtn">Your Offers</label>
                            
                                <input type="radio" class="btn-check" name="btnradio" id="sellerBtn" autocomplete="off" >
                                <label class="btn btn-outline-warning text-dark border-0 rounded-start" for="sellerBtn">Your Posts</label>
                            </div>
                        </div>

                        <!-- Buyer list -->
                        <div class="row gap-3 justify-content-center m-0 overflow-auto p-3" id="buyerList">


                                <?php
                                    foreach($TradeCoinOffers as $UserOffer){
                                    ?>
                                    

                                        <!-- item for tradcoin only -->
                                        <div class="row shadow justify-content-center align-items-center rounded bg-light">
                                            <!-- pic -->
                                            <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 ms-3 ms-lg-1 m-3 d-inline-grid rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                <img class="img-fluid rounded" src="<?php echo "image-files/" . $UserOffer->PostObject->Display_Item_Thumbnail(); ?>" alt="Product Image" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;" >
                                            </div>
                                            <!-- details -->
                                            <div class="col col-sm-12 col-xl py-2 d-grid">
                                                <h1 class="display-6 fw-semibold mb-3"><?php  echo $UserOffer->PostObject->itemName; ?></h1>
                                                <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                    <p class="col lead"><?php echo $UserOffer->PostObject->get_email(); ?></p>
                                                    <p class="col lead d-flex d-xxl-inline justify-content-end"><?php echo $UserOffer->OfferObject->Date;?></p>

                                                    <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/post_viewer_action.php">
                                                        <input type="hidden" name="post_id" value="<?php echo $UserOffer->PostObject->get_post_id(); ?>">
                                                        <button class="col btn text-dark" type="submit" name="submit" >View This Post Details</button>
                                                    </form> 


                                                             
                                                </div>
                                                <div class="row justify-content-evenly align-items-center m-0s">
                                                    <p class="col lead"><?php echo $UserOffer->UserInfoObject->Mobile_number; ?></p>
                                                    <p class="col lead d-flex d-xxl-inline justify-content-end"></p>
                                                </div>
                                                <div class="row fs-light mb-2">
                                                    <div class="col-6 justify-content-center">
                                                        <div class="d-flex justify-content-center">Method:</div>
                                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;">TradeCoin Only</b>
                                                    </div>
                                                    <div class="col-6 justify-content-center">
                                                        <div class="d-flex justify-content-center">Price:</div>
                                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-break text-center" style="background: #7c62e42f;">₱<?php echo $UserOffer->PostObject->price; ?></b>
                                                    </div>
                                                </div>
                                                
                                                    
                                                       
                                                
                                                <p class="row fs-light justify-content-center align-items-center mx-0">
                                                    Status:
                                                    <!-- change color kung qeued, accepted, o declined -->
                                                    <!-- 
                                                        qeued: #bdbcbc2f
                                                        accepted: #62e4945e
                                                        decilned: #e462625e
                                                    -->

                                                    <?php

                                                        if($UserOffer->OfferObject->Status == "ACCEPTED"){
                                                            echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #62e4945e;\">ACCEPTED</b>";

                                                            ?>
                                                                <div class="row m-1 mt-2 mb-3">

                                                            
                                                                    <form method="post" action="php/Transaction_Form_Action.php">
                                                                        <input  type="hidden" name="PostObjectID" value="<?php echo $UserOffer->PostObject->get_post_id(); ?>">
                                                                        <input  type="hidden" name="OfferObjectID" value="<?php echo $UserOffer->OfferObject->get_offer_id(); ?>">
                                                                        <input type="hidden" name="delivery_method" value="<?php echo $UserOffer->PostObject->exchange_method; ?>">
                                                                        <input  type="hidden" name="MethodTC" value="trade coin">
                                                                        <button class="btn btn-success py-3 fs-5" style="width: 100%; margin-bottom: 10px;" type="submit" name="transaction_button">Transaction Details</button>
                                                                    
                                                                    </form>
            
                                                                </div>

                                                            <?php
                                                                    

                                                        }elseif($UserOffer->OfferObject->Status == "QEUED"){
                                                            echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #bdbcbc2f;\">QEUED</b>";
                                                        }elseif($UserOffer->OfferObject->Status == "DECLINED"){
                                                            echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #e462625e;\">DECLINED</b>";
                                                        }
                                                    
                                                    
                                                    
                                                    ?>

                                                    
                                                </p>


                                               
                                                <div class="row m-0 mt-2 mb-3">
                                                        
                                                    <button class="btn btn-danger py-3 fs-5">Remove</button>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                    <?php
                                        if($TopUpOffers != null){
                                            foreach($TopUpOffers as $UserOffer){
                                        ?>
                                        

                                                <!-- item for trade with top up -->
                                                <div class="row shadow justify-content-center align-items-center rounded bg-light">
                                                    <!-- pic -->
                                                    <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 ms-3 ms-lg-1 m-3 d-inline-grid rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                        <img class="img-fluid rounded" src="<?php echo "offer-images-files/" . $UserOffer->OfferObject->Display_Item_Thumbnail(); ?>" alt="Product Image" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                        
                                                    </div>
                                                    
                                                    <!-- details -->
                                                    <div class="col col-sm-12 col-xl py-2 d-grid">
                                                        
                                                        <h1 class="display-6 fw-semibold mb-3"><?php echo $UserOffer->OfferObject->ItemName; ?></h1>
                                                       
                                                        <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                            <p class="col lead"><?php echo $UserOffer->PostObject->get_email(); ?></p>
                                                            <p class="col lead d-flex d-xxl-inline justify-content-end">Top up Amount: ₱<?php echo $UserOffer->PostObject->price; ?></p>
                                                        </div>
                                                        <div class="row justify-content-evenly align-items-center m-0s">
                                                            <p class="col lead"><?php echo $UserOffer->UserInfoObject->Address . " - " . $UserOffer->UserInfoObject->City; ?></p>
                                                            <p class="col lead d-flex d-xxl-inline justify-content-end">Date of Proposal: <br> <?php echo $UserOffer->OfferObject->Date; ?></p>
                                                            <br>
                                                            <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/post_viewer_action.php">
                                                                <input type="hidden" name="post_id" value="<?php echo $UserOffer->PostObject->get_post_id(); ?>">
                                                                <button class="col btn text-dark" type="submit" name="submit" >View This Post Details</button>
                                                             </form> 


                                                             <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/plain_viewer_action.php" >
                                                                            <input type="hidden" name="offer_id" value="<?php echo $UserOffer->OfferObject->get_offer_id(); ?>">
                                                                            <button class="col btn text-dark" type="submit" name="viewer">View Your Offer</button>
                                                            </form>
                                                        </div>
                                                        <div class="row fs-light mb-2">
                                                            <div class="col justify-content-center">
                                                                <div class="d-flex justify-content-center">Method:</div>
                                                                <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;">Trade with Top Up</b>
                                                            </div>
                                                        </div>
                                                        <p class="row fs-light justify-content-center align-items-center mx-0">
                                                            Status:
                                                            <!-- change color depende kung qeued, accepted, o declined -->
                                                            <!-- 
                                                                qeued: #bdbcbc2f
                                                                accepted: #62e4945e
                                                                decilned: #e462625e
                                                            -->
                                                            <!-- <b class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #62e4945e;">ACCEPTED</b>
                                                            <b class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #e462625e;">DECLINED</b>
                                                            <b class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #bdbcbc2f;">QEUED</b> -->

                                                            <?php

                                                                if($UserOffer->OfferObject->Status == "ACCEPTED"){
                                                                    
                                                                    echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #62e4945e;\">ACCEPTED</b>";
                                                                    ?>
                                                                    
                                                                        <div class="row m-1 mt-2 mb-3">

                                                                    
                                                                                <form method="post" action="php/Transaction_Form_Action.php">
                                                                                    <input  type="hidden" name="PostObjectID" value="<?php echo $UserOffer->PostObject->get_post_id(); ?>">
                                                                                    <input  type="hidden" name="OfferObjectID" value="<?php echo $UserOffer->OfferObject->get_offer_id(); ?>">
                                                                                    <input type="hidden" name="delivery_method" value="<?php echo $UserOffer->PostObject->exchange_method; ?>">

                                                                                    <button class="btn btn-success py-3 fs-5" style="width: 100%; margin-bottom: 10px;" type="submit" name="transaction_button">Transaction Details</button>

                                                                                </form>

                                                                        </div>

                                                                    <?php
                                                                    }elseif($UserOffer->OfferObject->Status == "QEUED"){
                                                                        echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #bdbcbc2f;\">QEUED</b>";
                                                                    }elseif($UserOffer->OfferObject->Status == "DECLINED"){
                                                                    
                                                                    echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #e462625e;\">DECLINED</b>";
                                                                    ?>

                                                                        <div class="row m-0 mt-2 mb-3">
                                                                            <button class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #bdbcbc2f;">Clear</button>
                                                                        </div>
                                                                    
                                                                    <?php
                                                                }



                                                            ?>
                                                        </p>
                                                        
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }
                                        ?>



                            <!-- item for trade with top up once accepted -->
                            <!-- <div class="row shadow justify-content-center align-items-center rounded bg-light">
                                
                                <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 ms-3 ms-lg-1 m-3 d-inline-grid rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                    <img class="img-fluid rounded" src="assets/hat2.jpg" alt="Product Image" >
                                </div>
                                
                                <div class="col col-sm-12 col-xl py-2 d-grid">
                                    <h1 class="display-6 fw-semibold mb-3">Product Name Product Name Product Name</h1>
                                    <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                        <p class="col lead">Seller Name</p>
                                        <p class="col lead d-flex d-xxl-inline justify-content-end">#10199999</p>
                                    </div>
                                    <div class="row justify-content-evenly align-items-center m-0s">
                                        <p class="col lead">Location</p>
                                        <p class="col lead d-flex d-xxl-inline justify-content-end">01/01/2024</p>
                                    </div>
                                    <div class="row fs-light mb-2">
                                        <div class="col justify-content-center">
                                            <div class="d-flex justify-content-center">Method:</div>
                                            <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;">Trade with Top Up</b>
                                        </div>
                                    </div>
                                    <p class="row fs-light justify-content-center align-items-center mx-0">
                                        Status: -->
                                        <!-- change color depende kung qeued, accepted, o declined -->
                                        <!-- 
                                            qeued: #bdbcbc2f
                                            accepted: #62e4945e
                                            decilned: #e462625e
                                        -->
                                        <!-- <b class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #e4d54e2f;">Meet Up</b>
                                    </p>
                                    <div class="row m-0 mt-2 mb-3">
                                        <button class="btn btn-warning py-3 fs-5">Transaction Complete</button>
                                    </div>
                                </div>
                            </div> -->


                            
                        <?php
                            foreach($TradeOnlyOffers as $UserOffer){
                            ?>


                                <!-- item for trade only -->
                                <div class="row shadow justify-content-center align-items-center rounded bg-light">
                                    <!-- pic -->
                                    <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 ms-3 ms-lg-1 m-3 d-inline-grid rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                        <img class="img-fluid rounded" src="<?php echo "offer-images-files/" . $UserOffer->OfferObject->Display_Item_Thumbnail(); ?>" alt="Product Image" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                        </div>
                                        <!-- details -->
                                        <div class="col col-sm-12 col-xl py-2 d-grid">
                                            <h1 class="display-6 fw-semibold mb-3"><?php echo $UserOffer->OfferObject->ItemName; ?></h1>
                                            <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                <p class="col lead">  <?php echo $UserOffer->PostObject->get_email(); ?></p>
                                                <p class="col lead d-flex d-xxl-inline justify-content-end">#10199999</p>
                                            </div>
                                            <div class="row justify-content-evenly align-items-center m-0s">
                                                <p class="col lead"><?php echo $UserOffer->UserInfoObject->Address; ?></p>
                                                <p class="col lead d-flex d-xxl-inline justify-content-end">Proposal Date: <br> <?php echo $UserOffer->OfferObject->Date; ?></p>


                                                <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/post_viewer_action.php">
                                                                <input type="hidden" name="post_id" value="<?php echo $UserOffer->PostObject->get_post_id(); ?>">
                                                                <button class="col btn text-dark" type="submit" name="submit" >View This Post Details</button>
                                                             </form> 


                                                             <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/viewer_action.php" >
                                                                            <input type="hidden" name="offer_id" value="<?php echo $UserOffer->OfferObject->get_offer_id(); ?>">
                                                                            <button class="col btn text-dark" type="submit" name="viewer">View Your Offer To this Post</button>
                                                            </form>

                                            </div>
                                            <div class="row fs-light mb-2">
                                                <div class="col justify-content-center">
                                                    <div class="d-flex justify-content-center">Method:</div>
                                                    <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;">Trade Only</b>
                                                </div>
                                            </div>
                                            <p class="row fs-light justify-content-center align-items-center mx-0">
                                                Status:
                                                <!-- change color depende kung qeued, accepted, o declined -->
                                                <!-- 
                                                    qeued: #bdbcbc2f
                                                    accepted: #62e4945e
                                                    decilned: #e462625e
                                                -->
                                                <?php

                                                                if($UserOffer->OfferObject->Status == "ACCEPTED"){
                                                                    
                                                                    echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #62e4945e;\">ACCEPTED</b>";
                                                                    ?>
                                                                 
                                                                        <div class="row m-1 mt-2 mb-3">

                                                                            <form method="post" action="php/Transaction_Form_Action.php">
                                                                                <input  type="hidden" name="PostObjectID" value="<?php echo $UserOffer->PostObject->get_post_id(); ?>">
                                                                                <input  type="hidden" name="OfferObjectID" value="<?php echo $UserOffer->OfferObject->get_offer_id(); ?>">
                                                                                <input type="hidden" name="delivery_method" value="<?php echo $UserOffer->PostObject->exchange_method; ?>">

                                                                                <button class="btn btn-success py-3 fs-5" style="width: 100%; margin-bottom: 10px;" type="submit" name="transaction_button">Transaction Details</button>
                                                                            
                                                                            </form>
          
                                                                        </div>

                                                                    <?php
                                                                    }elseif($UserOffer->OfferObject->Status == "QEUED"){
                                                                        echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #bdbcbc2f;\">QEUED</b>";
                                                                    }elseif($UserOffer->OfferObject->Status == "DECLINED"){
                                                                    
                                                                    echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #e462625e;\">DECLINED</b>";
                                                                    ?>

                                                                        <div class="row m-0 mt-2 mb-3">
                                                                            <button class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #bdbcbc2f;">Clear</button>
                                                                        </div>
                                                                    
                                                                    <?php
                                                                }
                                                                ?>

                                                
                                                
                                            </p>
                                            <div class="row m-0 mt-2 mb-3 gap-2">
                                                <button class="col-7 btn btn-secondary border border-dark disabled py-3 fs-5">Proceed to Next Step</button>
                                                <button class="col btn btn-outline-warning text-dark border border-dark py-3 fs-5">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                 
                            
                            <?php
                            }
                            ?>

                        </div> 



                         <!-- Seller list -->
                        <div class="row gap-3 justify-content-center m-0 overflow-auto p-3" id="sellerList">

                                            <?php
                              
                                                foreach($TradeCoinPosts as $PostAndOffer) {
                                                ?>
                                                
                                        
                                                    <!-- item for tradcoin only -->
                                                    <div class="row shadow justify-content-center align-items-center rounded bg-light">
                                                        <div class="col-12 col-sm">
                                                            <!-- pic -->
                                                            <div class="col-12 justify-content-center align-items-center p-0 mx-auto my-3 d-flex rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 300px;">
                                                                <img class="img-fluid rounded" src="<?php echo "image-files/" . $PostAndOffer->PostObject->Display_Item_Thumbnail(); ?>" alt="Product Image" >
                                                            </div>
                                                            <!-- item details -->
                                                            <div class="col col-sm-12 col-xl py-2 d-grid">
                                                                <h1 class="fs-4 fw-semibold mb-3"><?php echo $PostAndOffer->PostObject->itemName; ?></h1>
                                                                <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                                    <p class="col lead"><?php ?></p>
                                                                    <p class="col lead d-flex d-sm-inline d-xl-flex justify-content-end"><?php echo $PostAndOffer->PostObject->date; ?></p>
                                                                </div>
                                                                <div class="row justify-content-evenly align-items-center m-0s">
                                                                    <p class="col lead"><?php ?></p>
                                                                </div>
                                                                <div class="row fs-light mb-2">
                                                                    <div class="col-12 col-xl-6 justify-content-center">
                                                                        <div class="d-flex justify-content-center">Method:</div>
                                                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;">TradeCoin Only</b>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 justify-content-center">
                                                                        <div class="d-flex justify-content-center">Price:</div>
                                                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center text-break" style="background: #7c62e42f;">₱<?php echo $PostAndOffer->PostObject->price;  ?></b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- offers list -->


                                                        <div class="row col-8 gap-3 d-grid overflow-auto m-0 my-2 p-3 rounded" style="max-height: 650px">
                                                            Offers List

                                                                <?php
                                                                    if($PostAndOffer->OfferObjects != null){
                                                                        foreach($PostAndOffer->OfferObjects as $Offer){

                                                                            $Cheker = new BalanceChecker($Offer->Email, $PostAndOffer->PostObject->price);

                                                                            if($Cheker->get_balance_validation()){

                                                                        
                                                                    ?>
                                                                    
                                                            
                                                                            <div class="row justify-content-center align-items-center m-0 p-0 rounded shadow-sm text-center" style="background: linear-gradient(117deg, #3d52c927 40%, #593dc927 70%);">
                                                                                <div class="col-12 col-md fs-4 fw-semibold"><?php echo $Offer->Email?></div>
                                                                                <div class="col-12 col-md fs-5"><?php echo $Offer->Date; ?></div>

                                                                                 
                                                                                    <?php

                                                                                        if($Offer->Status == "ACCEPTED"){

                                                                                            echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #62e4945e;\">ACCEPTED</b>";
                                                                                        }elseif($Offer->Status == "QEUED"){
                                                                                            echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #bdbcbc2f;\">QEUED</b>";
                                                                                        }
                                                                                        elseif($Offer->Status == "DECLINED"){
                                                                                            echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #e462625e;\">DECLINED</b>";
                                                                                        }


                                                                                    ?>
                                                                                

                                                                                <div class="row col">
                                                                                
                                                                                    <?php
                                                                                        if($Offer->Status != "ACCEPTED"){
                                                                                        ?>

                                                                                            <form class="container d-flex justify-content-center mt-1 gap-1" method="post" action="php/OfferAcceptDecline_Action.php">
                                                                                            <input type="hidden" name="offer_id" value="<?php echo $Offer->get_offer_id(); ?>">
                                                                                            <input type="hidden" name="selectedpost_id" value="<?php echo $Offer->selectedpost_id; ?>">
                                                                                            <button class="col btn btn-outline-warning text-dark border border-dark rounded m-2" type="submit" name= "accept_submit">Accept</button>
                                                                                            <button class="col btn btn-outline-danger text-dark border border-dark rounded m-2" type="submit" name= "decline_submit">Decline</button>
                                                                                            
                                                                                            </form>

                                                                                        <?php
                                                                                        }else{
                                                                                            ?>
                                                                                            
                                                                                            <form class="col btn btn-outline-success text-dark border border-dark rounded m-2" method="post" action="php/Transaction_Form_Action.php" >
                                                                                                <input  type="hidden" name="PostObjectID" value="<?php echo $PostAndOffer->PostObject->get_post_id(); ?>">
                                                                                                <input  type="hidden" name="OfferObjectID" value="<?php echo $Offer->get_offer_id(); ?>">
                                                                                                <input  type="hidden" name="delivery_method" value="<?php echo $PostAndOffer->PostObject->exchange_method; ?>">
                                                                                                <input  type="hidden" name="MethodTC" value="trade coin">
                                                                                                <button class="col btn text-dark" type="submit" name="transaction_button">Transaction Details</button>
                                                                                        </form>

                                                                                        <?php
                                                                                        }

                                                                                        ?>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                    
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                               
                                                                

                                                            <!-- <div class="row justify-content-center align-items-center m-0 p-0 rounded shadow-sm text-center" style="background: linear-gradient(117deg, #3d52c927 40%, #593dc927 70%);">
                                                                <div class="col-12 col-md fs-4 fw-semibold">Buyer 1 Lorem</div>
                                                                <div class="col-12 col-md fs-5">01/01/2024</div>
                                                                <div class="row col">
                                                                    <button class="col btn btn-outline-warning text-dark border border-dark rounded m-2">Accept</button>
                                                                    <button class="col btn btn-outline-danger text-dark border border-dark rounded m-2">Decline</button>
                                                                </div>
                                                            </div> -->

                                                    

       
                                                        </div>
                                                    </div>
                                                <?php
                                                }     
                                                                
                                                ?> 
                                    

                                
                                
                                    
                            <?php
                                foreach($TradeOnlyPosts as $PostAndOffer){
                                ?>

                                        <!-- item for trade only -->
                                        <div class="row shadow justify-content-center align-items-center rounded bg-light">
                                            <div class="col-12 col-sm">
                                                <!-- pic -->
                                                <div class="col-12 justify-content-center align-items-center p-0 mx-auto my-3 d-flex rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                    <img class="img-fluid rounded" src="<?php echo "image-files/". $PostAndOffer->PostObject->Display_Item_Thumbnail(); ?>" alt="Product Image" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                </div>
                                                <!-- item details -->
                                                <div class="col col-sm-12 col-xl py-2 d-grid">
                                                    <h1 class="fs-4 fw-semibold mb-3"><?php echo $PostAndOffer->PostObject->itemName; ?></h1>
                                                    <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                        <p class="col lead">#10199999</p>
                                                        <p class="col lead d-flex d-sm-inline d-xl-flex justify-content-end"><?php echo $PostAndOffer->PostObject->date; ?></p>
                                                        
                                                    </div>
                                                    <div class="row justify-content-evenly align-items-center m-0s">
                                                        <p class="col lead">Location</p>
                                                    </div>
                                                    <div class="col justify-content-center">
                                                            <div class="d-flex justify-content-center">Method:</div>
                                                            <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;">Trade Only</b>
                                                    </div>
                                                    <div class="row fs-light mb-2">
                                                        
                                                        
                                                        <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/post_viewer_action.php">
                                                            <input type="hidden" name="post_id" value="<?php echo $PostAndOffer->PostObject->get_post_id(); ?>">
                                                            <button class="col btn text-dark" type="submit" name="submit" >View This Post Details</button>
                                                        </form> 

                                                        <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/post_viewer_action.php">
                                                            <input type="hidden" name="post_id" value="<?php echo $PostAndOffer->PostObject->get_post_id(); ?>">
                                                            <button class="col btn text-dark" type="submit" name="submit" >Ship Now</button>
                                                        </form> 
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- offers list -->
                                                <div class="row col-8 gap-3 d-grid overflow-auto m-0 my-2 p-3 rounded" style="max-height: 650px">
                                                Offers List
                                                <br>
                                            <?php
                                                
                                                if($PostAndOffer->OfferObjects != null){
                                                    foreach($PostAndOffer->OfferObjects as $Offer){
                                                ?>

                                                    
                                                        
                                                        <div class="row justify-content-center align-items-center m-0 p-0 rounded shadow-sm" style="background: linear-gradient(117deg, #3d52c927 40%, #593dc927 70%);">
                                                            <img class="col img-fluid rounded p-0 m-2" src="<?php echo "offer-images-files/" . $Offer->Display_Item_Thumbnail(); ?>" alt="Trade Offer Image" style="max-width: 200px;">
                                                            <div class="row col-12 col-lg text-center">
                                                                <div class="col-12 fs-4 fw-semibold"><?php echo $Offer->Email; ?></div>
                                                                <div class="col fs-5"><?php echo $Offer->Date; ?></div>
                                                                
                                                                <?php

                                                                    if($Offer->Status == "ACCEPTED"){

                                                                        echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #62e4945e;\">ACCEPTED</b>";
                                                                    }elseif($Offer->Status == "QEUED"){
                                                                        echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #bdbcbc2f;\">QEUED</b>";
                                                                    }
                                                                    elseif($Offer->Status == "DECLINED"){
                                                                        echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #e462625e;\">DECLINED</b>";
                                                                    }


                                                                ?>
                                                            </div>

                                                                <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/viewer_action.php">
                                                                            <input type="hidden" name="offer_id" value="<?php echo $Offer->get_offer_id(); ?>">
                                                                            <button class="col btn text-dark" type="submit" name="viewer">View Offer</button>
                                                                </form>

                                                                <br>

                                                                <?php
                                                                    
                                                                    if($Offer->Status == "ACCEPTED"){
                                                                    ?>
                                                                    

                                                                        <form class="col btn btn-outline-success text-dark border border-dark rounded m-2" method="post" action="php/Transaction_Form_Action.php" >
                                                                                <input  type="hidden" name="PostObjectID" value="<?php echo $PostAndOffer->PostObject->get_post_id(); ?>">
                                                                                <input  type="hidden" name="OfferObjectID" value="<?php echo $Offer->get_offer_id(); ?>">
                                                                                <input type="hidden" name="delivery_method" value="<?php echo $PostAndOffer->PostObject->exchange_method; ?>">
                                                                                <button class="col btn text-dark" type="submit" name="transaction_button">Transaction Details</button>
                                                                        </form>
                                                                    <?php
                                                                    }
                                                                ?>
                                                                
                                                            </div>
                                                            
                                                            
                                                        
                                                    
                                                <?php
                                                    }
                                                }else{
                                                    echo  "No Offer Yet";
                                                }
                                                ?>
                                                
                                                </div>
                                               
                                        </div>

                                <?php
                                }
                                ?>




                                    
                                                

                       


                            <?php


                                foreach($TopUpTradePosts as $PostAndOffer){
                                ?>
       

                                            <!-- item for trade with topup -->
                                            <div class="row shadow justify-content-center align-items-center rounded bg-light">
                                                <div class="col-12 col-sm">
                                                    <!-- pic -->
                                                    <div class="col-12 justify-content-center align-items-center p-0 mx-auto my-3 d-flex rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                        <img class="img-fluid rounded" src="<?php echo "image-files/" . $PostAndOffer->PostObject->Display_Item_Thumbnail(); ?>" alt="Product Image" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                    </div>
                                                    <!-- item details -->
                                                    <div class="col col-sm-12 col-xl py-2 d-grid">
                                                        <h1 class="fs-4 fw-semibold mb-3"><?php echo $PostAndOffer->PostObject->itemName; ?></h1>
                                                        <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                            <p class="col lead">Place price:₱<?php echo $PostAndOffer->PostObject->price?></p>
                                                            <p class="col lead d-flex d-sm-inline d-xl-flex justify-content-end"><?php echo $PostAndOffer->PostObject->date; ?></p>
                                                        </div>
                                                            <div class="row justify-content-evenly align-items-center m-0s">
                                                                <p class="col lead"></p>
                                                            </div>
                                                            <div class="col justify-content-center">
                                                                <div class="d-flex justify-content-center">Method:</div>
                                                                <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;">Trade with Top Up</b>
                                                        
                                                            </div>
                                                        <div class="row fs-light mb-2">

                                                            
                                                            <br>
                                                            <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/post_viewer_action.php">
                                                                <input type="hidden" name="post_id" value="<?php echo $PostAndOffer->PostObject->get_post_id(); ?>">
                                                                <button class="col btn text-dark" type="submit" name="submit" >View This Post Details</button>
                                                            </form>


                                                            <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/post_viewer_action.php">
                                                                <input type="hidden" name="post_id" value="<?php echo $PostAndOffer->PostObject->get_post_id(); ?>">
                                                                <button class="col btn text-dark" type="submit" name="submit" >Cancel Post</button>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- offers list -->
                                                <div class="row col-8 gap-3 d-grid overflow-auto m-0 my-2 p-3 rounded" style="max-height: 650px">
                                                    Offers List

                                                    <?php

                                                        if($PostAndOffer->OfferObjects != null){
                                                            foreach($PostAndOffer->OfferObjects as $Offer){
                                                        ?>

                                                            
                                                                <div class="row justify-content-center align-items-center m-0 p-0 rounded shadow-sm" style="background: linear-gradient(117deg, #3d52c927 40%, #593dc927 70%);">
                                                                    <img class="col-6 img-fluid rounded p-0 m-2" src="<?php echo "offer-images-files/" . $Offer->Display_Item_Thumbnail(); ?>" alt="Trade Offer Image" style="max-width: 200px;">
                                                                    <div class="row col-12 col-xxl-6 text-center align-items-center gap-3">
                                                                        <div class="col">
                                                                            <div class="col fs-4 fw-semibold"><?php echo $Offer->Email; ?></div>
                                                                            <div class="col fs-5"><?php echo $Offer->Date; ?></div>
                                                                            <br>

                                                                            <p class="m-0 p-0">Top Up Amount:</p>
                                                                            <b class="fs-4 fw-semibold text-break">₱<?php echo $Offer->Price; ?></b>
                                                                            <br>

                                                                            <?php

                                                                                if($Offer->Status == "ACCEPTED"){
                                                                                
                                                                                    echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #62e4945e;\">ACCEPTED</b>";
                                                                                }elseif($Offer->Status == "QEUED"){
                                                                                    echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #bdbcbc2f;\">QEUED</b>";
                                                                                }
                                                                                elseif($Offer->Status == "DECLINED"){
                                                                                    echo "<b class=\"col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center\" style=\"background: #e462625e;\">DECLINED</b>";
                                                                                }
                                                                            
                                                                            
                                                                            ?>

                                                                        </div><br>
                                                                        
                                                                    </div>
                                                                        <form class="col btn btn-outline-warning text-dark border border-dark rounded m-2" method="post" action="php/viewer_action.php" >
                                                                            <input type="hidden" name="offer_id" value="<?php echo $Offer->get_offer_id(); ?>">
                                                                            <button class="col btn text-dark" type="submit" name="viewer">View Offer</button>
                                                                        </form>

                                                                        <br>
                                                                        
                                                                        <?php
                                                                            
                                                                            if($Offer->Status == "ACCEPTED"){
                                                                            ?>
                                                                            

                                                                                <form class="col btn btn-outline-success text-dark border border-dark rounded m-2" method="post" action="php/Transaction_Form_Action.php" >
                                                                                    <input  type="hidden" name="PostObjectID" value="<?php echo $PostAndOffer->PostObject->get_post_id(); ?>">
                                                                                    <input  type="hidden" name="OfferObjectID" value="<?php echo $Offer->get_offer_id(); ?>">
                                                                                    <input type="hidden" name="delivery_method" value="<?php echo $PostAndOffer->PostObject->exchange_method; ?>">
                                                                                    <button class="col btn text-dark" type="submit" name="transaction_button">Transaction Details</button>
                                                                                </form>
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
                                }
                                ?>




                        </div>

                    </div>

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

    <!-- for status switch -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buyerBtn = document.getElementById('buyerBtn');
            const sellerBtn = document.getElementById('sellerBtn');
            const buyerList = document.getElementById('buyerList');
            const sellerList = document.getElementById('sellerList');
    
            buyerList.style.display = buyerBtn.checked ? 'flex' : 'none';
            sellerList.style.display = sellerBtn.checked ? 'flex' : 'none';
    
            buyerBtn.addEventListener('change', function () {
                buyerList.style.display = buyerBtn.checked ? 'flex' : 'none';
                sellerList.style.display = sellerBtn.checked ? 'none' : 'none';
            });
    
            sellerBtn.addEventListener('change', function () {
                buyerList.style.display = sellerBtn.checked ? 'none' : 'none';
                sellerList.style.display = sellerBtn.checked ? 'flex' : 'none';
            });
        });
    </script>
</body>
</html>