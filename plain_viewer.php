<?php
require "php/EssentialClasses.php";
require "php/SecondaryClasses.php";

session_start();

$Offer_id = $_SESSION['idForViewer'];

$MyServer = new SERVER("projectdb", "offer_pool");
$MyServer->Server_Conn();
$MyServer_sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `id` = " . $Offer_id;

$result = $MyServer->get_ServerConnection()->query($MyServer_sql);

$OfferObject = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($result)[0];

//UserInformation Objecct that contains the data of this Offer

$ThisOfferUserInfo = new UserInfoRetriever($OfferObject->Email);


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
    </style>
    <title>View Offer</title>
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
                            <div class="col-2 collapse navbar-collapse p-2" id="navbarSupportedContent" style="">
                                <ul class="navbar-nav mx-auto my-2 my-lg-0 align-items-center justify-content-end w-100">
                                    <!-- search bar inside menu -->
                                    <form class="container-fluid d-flex d-sm-none ">
                                        <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                                        <button id="toggleBtn" class="btn btn-warning d-flex" type="submit">
                                            <i id="menuIcon" class="uil uil-search"></i>
                                        </button>
                                    </form>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="newhome.php">Home</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="#">Browse</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="status.php">Status</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="#">Help</a>
                                    </li>
                                    <!-- profile for sm screen -->
                                    <li class="nav-item d-xxl-none rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="#">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">
                                            <div class="btn btn-warning">Create Post</div>
                                        </a>
                                    </li>
                                    <!-- profile for xxl screen -->
                                    <li class="nav-item d-none d-xxl-inline">                                        
                                        <a class="nav-link" aria-current="page" href="#">
                                            <div class="profile-pic-btn">
                                                <div class="overlap-group">
                                                    <img class="frame bg-warning rounded-circle p-1" src="assets/profileSvg.svg" />
                                                </div>
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
                        <div class="row h-100" style="">
                            <div class="h-100 w-100 top-0 translate-middle" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                            <div class="position-absolute w-75 h-100 bottom-0 end-0" style=" border-radius: 10px; background-color: #d3d7eb; filter: blur(100px);"></div>
                            <div class="h-25 w-50 position-absolute bottom-0 end-0 translate-middle-y" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                        </div>
                    </div>
                </div>

                <!-- hero section -->
                <div class="col col-md-10 " style="margin-top: 90px;">
                    <div class="row justify-content-center align-items-center p-1" >

                        <!-- item pictures -->
                        <div class="pic_zoom col p-1 pe-2 gap-2 d-inline-grid overflow-auto rounded" style="max-height: 85vh; max-width: 400px;">

                            <?php
                                foreach($OfferObject->images as $imagefilename){
                                ?>
                                    <img class="img-fluid rounded" src="<?php echo "offer-images-files/" . $imagefilename; ?>" alt="Product Image">

                                <?php
                                }

                            ?>

                        </div>

                        <!-- details -->
                        <div class="col-9 overflow-auto p-0 px-2 m-0 rounded" style="min-height: 85vh; max-height: 85vh;">

                            <div class="container-fluid py-3 mt-1 rounded" style="background-color: white;">
                                <!-- product name -->
                                <h1 class="display-5 fw-semibold text-center rounded py-2"><?php echo $OfferObject->ItemName; ?></h1>

                                <!-- method -->
                                <h5 class="text-center pb-3 mx-3 fw-semibold" style="font-size: 1.75rem;"><?php if($OfferObject->Method == "top-up trade"){echo  "₱". $OfferObject->Price; }?></h5>

                                <!-- tags -->
                                <div class="row gap-3 mx-3">
                                    <div class="col-sm-12 col-md d-flex align-items-center justify-content-center rounded pt-2 p-1 m-0" style="background-color: #8393ec2f;">
                                        <h6 class="lh-base fw-light text-center">Condition: 
                                            (<?php echo $OfferObject->item_Condition; ?>)
                                        </h6>
                                    </div>
                                    <div class="col-sm-12 col-md d-flex align-items-center justify-content-center rounded pt-2 p-1 m-0" style="background-color: #7c62e42f;">
                                        <h6 class="lh-base fw-light text-center"><?php if($OfferObject->Method == "top-up trade"){echo "Top Up Amount";}else{echo "Trade Only";}; ?></h6>
                                    </div>
                                    <div class="col-sm-12 col-md d-flex align-items-center justify-content-center rounded pt-2 p-1 m-0" style="background-color: #ac55df2f;">
                                        <h6 class="lh-base fw-light text-center"><?php echo $OfferObject->Category; ?></h6>
                                    </div>
                                </div>

                                <h6 class="fw-light p-3 pt-4 pb-0 mb-3">Description:</h6>
                                <p class="p-3 py-2 mx-2 mt-2 overflow-auto rounded lead" style="max-height: 300px;"><?php echo $OfferObject->Description; ?></p>

                                <div id="this_offer_userinfo" style="margin-left:2%; display:flex">
                                    
                                    <div style="width: 50%;">
                                    <h3 id="userInfo_username">Trader Username: <?php echo  $ThisOfferUserInfo->userInforamation->get_UserName();  ?></h3><br>
                                    <h3>Trader Badge(<?php echo $ThisOfferUserInfo->userInforamation->Rating;?>)
                                        <?php StarBadge::ReturnBadge((float)$ThisOfferUserInfo->userInforamation->Rating) ;?>
                                    </h3>

                                    <h3>Address: <?php echo $ThisOfferUserInfo->userInforamation->Address;?></h3>
                                    <h3>City: <?php echo $ThisOfferUserInfo->userInforamation->City; ?></h3>
                                
                                    </div>

                                    <div style="">
                                        <h3>Contact Information</h3><br>
                                        <h3>Email:<em> <?php echo $ThisOfferUserInfo->userInforamation->Email; ?> </em></h3>
                                        <h3>Mobile Number:<em> <?php echo $ThisOfferUserInfo->userInforamation->Mobile_number; ?> </em> </h3>
                                    </div>
                                </div>
                                
                                <!-- <div class="container d-flex justify-content-center mt-5 gap-3" >
                                    <input class="btn btn-lg btn-warning w-100" type="submit" value="Accept">
                                    <input class="btn btn-lg btn-danger w-100" type="submit" value="Decline">
                                </div> -->

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
</body>
</html>