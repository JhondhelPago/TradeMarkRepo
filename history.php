<?php
require "php/EssentialClasses.php";
session_start();

$ThisUser_id = $_SESSION['user_id'];
$ThisUser_Email = $_SESSION['valid'];

$MyPostHistoryServer = new SERVER("projectdb", "history_post_img");
$MyPostHistoryServer->Server_Conn();

$MyPostHistoryServer_sql = "SELECT * FROM " . $MyPostHistoryServer->get_table() . " WHERE `User_id` = " . $ThisUser_id;

$PostHistory_result = $MyPostHistoryServer->get_ServerConnection()->query($MyPostHistoryServer_sql);

$PostHistoryObject = PostObjectTools::PostRows_to_PostObjectArray($PostHistory_result);






$MyOfferHistoryServer = new SERVER("projectdb", "history_offer_pool");
$MyOfferHistoryServer->Server_Conn();

$MyOfferHistoryServer_sql = "SELECT * FROM " . $MyOfferHistoryServer->get_table() . " WHERE `Email` = " . StringManipulate::wrap_string_qoutation($ThisUser_Email);

$OfferHistory_result = $MyOfferHistoryServer->get_ServerConnection()->query($MyOfferHistoryServer_sql);

$OfferHistoryObject = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($OfferHistory_result);

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

    <title>History</title>
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
                                    <li class="nav-item rounded">
                                        <a class="nav-link text-light navActive ms-xxl-2 px-3 my-1 my-xxl-0 border border-light rounded disabled" aria-current="page" href="#">History</a>
                                    </li>
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

                <!-- hero section -->
                <div class="col col-md-10" style="margin-top: 90px;">
                    <div class="container-fluid p-1 " style="min-height: 85vh; max-height: 85vh;">
                        <div class="display-1 fw-bold d-flex justify-content-center header1">HISTORY</div>
                        <!-- switch btn -->
                        <!-- <div class="row justify-content-center mt-3 mb-4">
                            <div class="col-9 col-md-8 col-xxl-4 btn-group border border-dark p-0" role="group" aria-label="Switch list button">
                                <input type="radio" class="btn-check" name="btnradio" id="buyerBtn" autocomplete="off" checked>
                                <label class="btn btn-outline-warning text-dark border-0 rounded-end" for="buyerBtn">Buyer</label>
                            
                                <input type="radio" class="btn-check" name="btnradio" id="sellerBtn" autocomplete="off" >
                                <label class="btn btn-outline-warning text-dark border-0 rounded-start" for="sellerBtn">Seller</label>
                            </div>
                        </div> -->

                        <!-- history list -->
                        <div class="row gap-3 justify-content-center m-0 overflow-auto p-3" id="buyerList">

                            <!-- item 1 with price -->
                            <h2>Offer History</h2>

                            <?php 

                                if($PostHistoryObject != null){
                                    foreach($PostHistoryObject as $PostObject){
                                    $UserInfoObject = new UserInfoRetriever($PostObject->get_email())


                                ?>
                                


                                    <div class="row shadow justify-content-center align-items-center rounded" style="background: white;">
                                        <!-- pic -->
                                        <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 ms-3 ms-lg-1 m-3 d-inline-grid rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                            <img class="img-fluid rounded" src="<?php echo "image-files/" . $PostObject->Display_Item_Thumbnail(); ?>" alt="Product Image" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                        </div>
                                        <!-- details -->
                                        <div class="col col-sm-12 col-xl py-2 d-grid">
                                            <h1 class="display-6 fw-semibold mb-3"><?php echo $PostObject->itemName; ?></h1>
                                            <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                <p class="col lead"><?php echo $UserInfoObject->userInforamation->UserName;?></p>
                                                <p class="col lead d-flex d-xxl-inline justify-content-end">#10199999</p>
                                            </div>
                                            <div class="row justify-content-evenly align-items-center m-0s">
                                                <p class="col lead"><?php echo $UserInfoObject->userInforamation->Address; ?></p>
                                                <p class="col lead d-flex d-xxl-inline justify-content-end">01/01/2024</p>
                                            </div>
                                            <div class="row fs-light mb-2">
                                                <div class="col justify-content-center">
                                                    <div class="d-flex justify-content-center">Method:</div>
                                                    <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;"><?php echo $PostObject->payment_method; ?></b>
                                                </div>
                                                <div class="col justify-content-center">
                                                    <div class="d-flex justify-content-center">Price:</div>
                                                    <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-break text-center" style="background: #7c62e42f;">₱<?php if($PostObject->payment_method == "trade coin" or $PostObject->payment_method == "top-up trade"){echo $PostObject->price;}; ?></b>
                                                </div>
                                            </div>
                                            <p class="row fs-light justify-content-center align-items-center mx-0">
                                                Status:
                                                <b class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #62e4945e;">Completed</b>
                                            </p>
                                        </div>
                                    </div>

                                <?php
                                    }
                                }
                                ?>

                            <!-- item 2 without price -->
                            <h2>Post History</h2>
                                <?php
                                    if($OfferHistoryObject != null){

                                        foreach($OfferHistoryObject as $OfferObject){
                                        $UserInfoObject = new UserInfoRetriever($OfferObject->Email);
                                        
                                ?>

                                        <div class="row shadow justify-content-center align-items-center rounded" style="background: white;">
                                            <!-- pic -->
                                            <div class="col-12 col-xl-5 justify-content-center align-items-center p-0 ms-3 ms-lg-1 m-3 d-inline-grid rounded" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                <?php if($OfferObject->Method != "trade coin"){ ?>
                                                    <img class="img-fluid rounded" src="<?php echo "offer-images-files/" . $OfferObject->Display_Item_Thumbnail(); ?>" alt="Product Image" style="min-height: 10vh; max-height: 400px; min-width: 10vh; max-width: 400px;">
                                                <?php } ?>
                                            </div>
                                            <!-- details -->
                                            <div class="col col-sm-12 col-xl py-2 d-grid">
                                                <h1 class="display-6 fw-semibold mb-3"><?php if($OfferObject->Method != "trade coin"){echo $OfferObject->ItemName; };?> </h1>
                                                <div class="row justify-content-evenly align-items-center mb-2 m-0s">
                                                    <p class="col lead"><?php echo $OfferObject->Email; ?>;</p>
                                                    <p class="col lead d-flex d-xxl-inline justify-content-end">#10199999</p>
                                                </div>
                                                <div class="row justify-content-evenly align-items-center m-0s">
                                                    <p class="col lead"><?php echo $UserInfoObject->userInforamation->Address; ?></p>
                                                    <p class="col lead d-flex d-xxl-inline justify-content-end">01/01/2024</p>
                                                </div>
                                                <div class="row fs-light mb-2">
                                                    <div class="col justify-content-center">
                                                        <div class="d-flex justify-content-center">Method:</div>
                                                        <b class="fw-semibold rounded px-3 py-1 d-flex justify-content-center text-center" style="background: #8393ec2f;"><?php echo $OfferObject->Method; ?></b>
                                                    </div>
                                                </div>
                                                <p class="row fs-light justify-content-center align-items-center mx-0">
                                                    Status:
                                                    <b class="col-12 fs-4 fw-semibold rounded px-3 py-1 d-flex justify-content-center" style="background: #62e4945e;">Completed</b>
                                                </p>
                                            </div>
                                        </div>

                                    <?php
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
</body>
</html>