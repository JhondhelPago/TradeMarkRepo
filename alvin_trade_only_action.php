<?php

require "php/EssentialClasses.php";

session_start();

//this variable holds the value fro the session super global, the value is the id of selected post from the home.php
$selectedPostIdFromHome = $_SESSION['selectedPostId_InHome'];


//this area is for fetching the post selecetd

$MyServer = new SERVER("projectdb", "post_img");
$MyServer->Server_Conn();
$sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `id` = " . $selectedPostIdFromHome;

$result = $MyServer->get_ServerConnection()->query($sql);

$DetailPostArray = PostObjectTools::PostRows_to_PostObjectArray($result);

$itemInformation = $DetailPostArray[0];


$MyServer1 = new SERVER("projectdb", "users_information");
$MyServer1->Server_Conn();
$sql1 = "SELECT * FROM " . $MyServer1->get_table() . " WHERE `Email` = " . StringManipulate::wrap_string_qoutation($itemInformation->get_email());

$result1 = $MyServer1->get_ServerConnection()->query($sql1);

$DetailTraderArray = PostObjectTools::UserInfoRows_to_UserInfoObjectArray($result1);

$userInformation = $DetailTraderArray[0];

 

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
    </style>
    <title>Welcome to TradeMark</title>
    <link rel="icon" type="image/x-icon" href="assets/PRIMARY_game-icons_cardboard-box-closed.svg">
</head>
<body>
    <section>
        <div class="container-fluid" >
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
                                    <li class="nav-item">
                                        <a class="nav-link text-light" aria-current="page" href="home.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-light" aria-current="page" href="#">Browse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-light" aria-current="page" href="#">Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-light" aria-current="page" href="#">Help</a>
                                    </li>
                                    <!-- profile for sm screen -->
                                    <li class="nav-item d-xxl-none">
                                        <a class="nav-link text-light" aria-current="page" href="#">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">
                                            <div class="btn btn-warning">Create Post</div>
                                        </a>
                                    </li>
                                    <!-- profile for xxl screen -->
                                    <li class="nav-item d-none d-xxl-inline">                                        
                                        <a class="nav-link" aria-current="page" href="edit.php">
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

                                for($i = 0; $i < count($itemInformation->imageArray); $i++){
                                    ?>
                                    <img class="img-fluid rounded" src="<?php echo "image-files/" . $itemInformation->imageArray[$i]; ?>" alt="Product Image">
                                
                                <?php
                                }
                            
                            ?> 


                            <!-- <img class="img-fluid rounded" src="assets/sample-img.png" alt="Product Image">
                            <img class="img-fluid rounded" src="assets/sample-img.png" alt="Product Image">
                            <img class="img-fluid rounded" src="assets/sample-img.png" alt="Product Image">
                            <img class="img-fluid rounded" src="assets/sample-img.png" alt="Product Image"> -->
                        </div>

                        <!-- details -->
                        <div class="col-9 shadow-lg overflow-auto ms-2 me-1 pt-3 px-3 rounded" style="background-color: white; min-height: 85vh; max-height: 85vh;">

                            <!-- product name -->
                            <h1 class="display-5 fw-semibold text-center rounded py-2"><?php echo $itemInformation->itemName; ?></h1>
 
                            <!-- method -->
                            <h5 class="text-center pb-3 mx-3 fw-light"><?php  ?></h5>

                            <!-- tags -->
                            <div class="row gap-3 mx-3">
                                <div class="col-sm-12 col-md d-flex align-items-center justify-content-center rounded pt-2 p-1 m-0" style="background-color: #8393ec2f;">
                                    <h6 class="lh-base fw-light text-center">Seller 
                                        (<?php echo $userInformation->Rating; ?>)
                                    </h6>
                                </div>
                                <div class="col-sm-12 col-md d-flex align-items-center justify-content-center rounded pt-2 p-1 m-0" style="background-color: #7c62e42f;">
                                    <h6 class="lh-base fw-light text-center">Location : <?php echo $userInformation->Address . ", " . $userInformation->City; ?></h6>
                                </div>
                                <div class="col-sm-12 col-md d-flex align-items-center justify-content-center rounded pt-2 p-1 m-0" style="background-color: #ac55df2f;">
                                    <h6 class="lh-base fw-light text-center"><?php echo $itemInformation->category; ?></h6>
                                </div>
                            </div>

                            <h6 class="fw-light p-3 pt-4 pb-0 mb-3">Description:</h6>
                            <p class="p-3 py-2 mx-2 mt-2 overflow-auto rounded lead" style="max-height: 300px;"><?php echo $itemInformation->description; ?></p>

                            <!-- form for tradecoin only -->
                            <!-- <div class="container d-flex justify-content-center">
                                <input class="btn btn-lg btn-warning w-100" type="submit" value="I'm Interested in this item.">
                            </div> -->

                            <!-- form for trade only (comment)
                            <div class="row shadow-lg rounded p-0 pb-2 m-2 my-4 overflow-auto">
                                <h1 class="fs-5 text-center fw-light rounded p-4" style="background: #ffe083b2;" >Interested? Submit Your Offer.</h1>
                                <div class="container d-flex gap-2 mt-3">
                                    <form class="container" action="">

                                        add img btn (comment)
                                        <label class="form-label fw-light" for="add_img">Add Image</label>
                                        <input class="form-control border border-dark text-dark w-100" style="" id="add_img" value="Add Image" type="file" multiple></input>

                                        select category (comment)
                                        <select class="form-select border border-dark mt-3" name="choose_category" id="">
                                            <option selected hidden>Choose Category</option>
                                            <option value="">Electronic Accessories</option>
                                            <option value="">Sports & Lifestyle</option>
                                            <option value="">Home Applicances</option>
                                            <option value="">Automotive</option>
                                            <option value="">Men's & Women's Fashion</option>
                                            <option value="">Toys & Collectibles</option>
                                        </select>

                                        desc (comment)
                                        <div class="form-floating my-3">
                                            <textarea class="form-control border border-dark rounded lead" style="height: 200px;" placeholder="Put a description on your item/s." id="desc"></textarea>
                                            <label for="desc">Description</label>
                                        </div>

                                        <div class="container d-flex justify-content-center my-4">
                                            <input class="btn btn-lg btn-warning w-100" type="submit" value="Send Offer">
                                        </div>
                                    </form>

                                    display img (comment)
                                    <div class="container d-grid overflow-auto p-2 gap-2" style="max-height: 500px;">
                                        <img class="img-fluid rounded" src="assets/hat1.png" alt="Product Image">
                                        <img class="img-fluid rounded" src="assets/hat2.jpg" alt="Product Image">
                                        <img class="img-fluid rounded" src="assets/hat2.jpg" alt="Product Image">
                                        <img class="img-fluid rounded" src="assets/wideimgsample.png" alt="Product Image">
                                    </div>
                                </div>
                            </div> -->

                            <!-- form for trade with top-up only -->
                            <div class="row shadow-lg rounded p-0 pb-2 m-2 my-4 overflow-auto">
                                <h1 class="fs-5 text-center fw-light rounded p-4" style="background: #ffe083b2;" >Interested? Submit Your <b>Trade Offer</b>.</h1>
                                <div class="container d-flex gap-2 mt-3">
                                    <form class="container" action="">

                                        <!-- add img btn (comment) -->
                                        <label class="form-label fw-light" for="add_img">Add Image</label>
                                        <input class="form-control border border-dark text-dark w-100" style="" id="add_img" value="Add Image" type="file" multiple></input>

                                        <!-- select category (comment) -->
                                        <select class="form-select border border-dark mt-3" name="choose_category" id="">
                                            <option selected hidden>Choose Category</option>
                                            <option value="">Electronic Accessories</option>
                                            <option value="">Sports & Lifestyle</option>
                                            <option value="">Home Applicances</option>
                                            <option value="">Automotive</option>
                                            <option value="">Men's & Women's Fashion</option>
                                            <option value="">Toys & Collectibles</option>
                                        </select>

                                        <!-- top up amount -->
                                        <div class="form-floating my-3">
                                            <input class="form-control border border-dark rounded lead" placeholder="How much would you like to add?" id="top_up_amt" type="number"></input>
                                            <label for="top_up_amt">Top-up Amount</label>
                                        </div>

                                        <!-- desc (comment) -->
                                        <div class="form-floating my-3">
                                            <textarea class="form-control border border-dark rounded lead" style="height: 200px;" placeholder="Put a description on your item/s." id="desc"></textarea>
                                            <label for="desc">Description</label>
                                        </div>

                                        <div class="container d-flex justify-content-center my-4">
                                            <input class="btn btn-lg btn-warning w-100" type="submit" value="Send Offer">
                                        </div>
                                    </form>

                                    <!-- display img -->
                                    <div class="container d-grid overflow-auto p-2 gap-2" style="max-height: 500px; min-width: 100px;">
                                        <img class="img-fluid rounded" src="assets/sample-img.png" alt="Product Image">
                                        <img class="img-fluid rounded" src="assets/hat1.png" alt="Product Image">
                                    </div>
                                </div>
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