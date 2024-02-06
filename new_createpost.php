<?php
session_start();
$email = isset($_SESSION['valid']) ? $_SESSION['valid'] : 'No email foud';


?>

<?php 

require "php/config.php";
            
    $id = $_SESSION['id'];
    $query = mysqli_query($con,"SELECT*FROM users_information WHERE Id=$id");

    while($result = mysqli_fetch_assoc($query)){
        $res_Uname = $result['_Name'];
        $res_Email = $result['Email'];
        $res_Age = $result['Age'];
        $res_id = $result['Id'];
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
    <title>Create Post</title>
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
                    <nav class="navbar navbar-light navbar-expand-xl">
                        <div class="container-fluid justify-content-between p-0">
                            <div class="navbar-brand">
                                <div class="h3 fw-semibold text-light m-0 user-select-none" style="cursor: pointer;" onclick="redirectToHome()">
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
                                    <form class="container-fluid d-flex d-sm-none ">
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
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="status.php">Status</a>
                                    </li>
                                    <!-- <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="#">Help</a>
                                    </li> -->
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="history.php">History</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="">TC Balance</a>
                                    </li>
                                    <!-- profile for sm screen -->
                                    <li class="nav-item d-xl-none rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="edit.php">Profile</a>
                                    </li>
                                    <!-- <li class="nav-item rounded">
                                        <a class="nav-link text-light navActive ms-2 px-3 my-1 my-xl-0 border border-light rounded disabled" aria-current="page" href="#">Create Post</a>
                                    </li> -->
                                    <li class="nav-item rounded mt-1 mt-xl-0">
                                        <a class="nav-link disabled rounded border border-light p-0 mx-2" aria-current="page" href="#" style="cursor: default;">
                                            <div class="btn text-light navActive">Create Post</div>
                                        </a>
                                    </li>
                                    <!-- profile for xxl screen -->
                                    <li class="nav-item d-none d-xl-inline">                                        
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
                    <div class="row display-1 fw-bold text-center justify-content-center header1 mb-3">CREATE POST</div>
                    <div class="row justify-content-center align-items-center mb-4 px-3">
                        <div class="row col-10 col-sm-10 col-xxl-8 btn-group rounded border border-dark align-items-center p-0" role="group" aria-label="Switch list button">
                            <input class="btn-check" type="radio" name="btnradio" id="tradecoinBtn" autocomplete="off" checked>
                            <label class="col col-md-4 btn btn-outline-warning text-dark text-center border-0 rounded m-0" for="tradecoinBtn">TradeCoin</label>
                        
                            <input class="btn-check" type="radio" name="btnradio" id="tradeBtn" autocomplete="off">
                            <label class="col col-md-4 btn btn-outline-warning text-dark text-center border-0 rounded m-0" for="tradeBtn">Trade Only</label>

                            <input class="btn-check" type="radio" name="btnradio" id="tradeTopUpBtn" autocomplete="off">
                            <label class="col col-md-4 btn btn-outline-warning text-dark text-center border-0 rounded m-0" for="tradeTopUpBtn">Trade with Top Up</label>
                        </div>
                    </div>

                    <!-- tradecoin -->
                    <form class="row p-1 m-0 my-2 justify-content-center" id="tradecoinForm" enctype="multipart/form-data" method="post" action="php/CreatePostTradeCoin.php">
                        <div class="row col col-xxl shadow justify-content-center align-items-start rounded p-4 px-2 m-0" style="background: white;">
                            <div class="row justify-content-center gap-2">                
                                <h2 class="fw-light text-center">Post your item on <b class="fw-semibold">TradeMark</b></h2>
                                <h6 class="fw-light text-center">This form is for <b class="fw-semibold">TradeCoin</b> method only.</h6>
                                <div class="row col gap-2 p-0 m-0">
                                    <div class="row gap-2 m-0 p-0">
                                        <div class="row col-12 col-md p-0 m-0 gap-2">

                                            <!-- item name -->
                                            <div class="form-floating px-0">
                                                <input type="text" class="form-control rounded lead" name="itemName" id="itemName" placeholder="Item Name" required>
                                                <label for="itemName" class="">Item Name</label>
                                            </div>
                                            
                                            <!-- price -->
                                            <div class="form-floating px-0">
                                                <input type="number" name="price" id="price_label" class="form-control rounded lead" step="0.01" pattern="\d+(\.\d{2})?" placeholder="0.00" required>
                                                <label id="price_label">Price</label required>
                                            </div>
                                        </div>
                                        <div class="row col-12 col-md p-0 m-0 gap-2">

                                            <!-- location -->
                                            <div class="form-floating px-0">
                                                <!-- <select class="form-select" name="location" id="location" required>
                                                    <option value="" hidden selected>Choose City</option>
                                                    <option value="local">Local</option>
                                                    <option value="Manila">Manila</option>
                                                    <option value="Pasay">Pasay</option>
                                                    <option value="Makati">Makati</option>
                                                    <option value="Quezon City">Quezon City</option>
                                                    <option value="Marikina">Marikina</option>
                                                    <option value="Caloocan">Caloocan</option>
                                                </select>
                                                <label for="location">Location</label> -->
                                                <input class="form-control" type="file" name="uploadImg[]" id="uploadImg" accept=".jpg, .jpeg, .png" multiple required>
                                            </div> 
                                            
                                            <!-- category -->
                                            <div class="form-floating px-0">
                                                <select class="form-select" name="category" id="category" required>
                                                    <option value="" hidden selected>Choose Category</option>
                                                    <!-- <option value="electDev">Electronic Devices</option> -->
                                                    <option value="electronic accessories">Electronic Accessories</option>
                                                    <option value="home app">Home Appliances</option>
                                                    <!-- <option value="healt">Health & Beauty</option> -->
                                                    <!-- <option value="kids">Babies & Kids</option> -->
                                                    <!-- <option value="grocPets">Groceries & Pets</option> -->
                                                    <!-- <option value="homeLiving">Home & Living</option> -->
                                                    <option value="women fashion">Women's Fashion & Accessories</option>
                                                    <option value="men fashion">Men's Fashion & Accessories</option>
                                                    <option value="toys collection">Toys & Collectibles</option>
                                                    <option value="sports lifestyle">Sports & Lifestyle</option>
                                                    <option value="auto motive">Automotive & Motorcycles</option>
                                                </select>
                                                <label for="category">Category</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <!-- condition -->
                                    <div class="form-floating px-0">
                                        <select name="itemCondition" id="itemCondition" class="form-select" required>
                                            <option value="" hidden selected>Choose Item Condition</option>
                                            <option value="new">New</option>
                                            <option value="slight">Slightly Used</option>
                                            <option value="used">Used</option>
                                        </select>
                                        <label for="itemCondition">Condition</label>
                                    </div>

                                    <div class="form-floating px-0">
                                        <select name="exchange_method" id="exchange_method" class="form-select" required>
                                            <option value="" hidden selected>Choose Delivery Type</option>
                                            <option value="shipment">shipment</option>
                                            <option value="meetup">meetup</option>
                                            
                                        </select>
                                        <label for="exchange_method">Delivery</label>
                                    </div>


                                    <!-- desc -->
                                    <div class="form-floating px-0">
                                        <textarea name="itemDescrip" id="itemDetails" class="form-control rounded lead" cols="30" rows="10" placeholder="Item Dectription" style="height: 150px;"></textarea>
                                        <label for="itemDetails">Description</label>
                                    </div>
                                    
                                    <!-- img -->
                                    <!-- <input class="form-control" type="file" name="uploadImg[]" id="uploadImg" accept=".jpg, .jpeg, .png" multiple> -->
                
                                    <input class="btn btn-warning mt-4 mb-1 fs-6" type="submit" name="submit" value="Upload">
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- trade only -->
                    <form class="row p-1 m-0 my-2 justify-content-center" id="tradeForm" enctype="multipart/form-data" method="post" action="php/CreatePostTradeOnly.php">
                        <div class="row col col-xxl shadow justify-content-center align-items-start rounded p-4 px-2 m-0" style="background: white;">
                            <div class="row justify-content-center gap-2">                
                                <h2 class="fw-light text-center">Post your item on <b class="fw-semibold">TradeMark</b></h2>
                                <h6 class="fw-light text-center">This form is for <b class="fw-semibold">Trade</b> method only.</h6>
                                <div class="row col gap-2 p-0 m-0">
                                    <div class="row gap-2 m-0 p-0">


                                            <div class="form-floating px-0">
                                                <input type="text" class="form-control" name="itemName" id="itemName" placeholder="Item Name" required>
                                                <label for="itemName">Item Name</label>
                                            </div>


                                        <!-- <div class="row col-12 col-md p-0 m-0 gap-2"> -->

                                            <!-- item name -->
                                            <!-- <div class="form-floating px-0">
                                                <input type="text" class="form-control" name="itemName" id="itemName" placeholder="Item Name">
                                                <label for="itemName">Item Name</label>
                                            </div> -->

                                            <!-- location -->
                                            <!-- <div class="form-floating px-0">
                                                <select class="form-select" name="location" id="location" required>
                                                    <option value="" hidden selected>Choose City</option>
                                                    <option value="local">Local</option>
                                                    <option value="Manila">Manila</option>
                                                    <option value="Pasay">Pasay</option>
                                                    <option value="Makati">Makati</option>
                                                    <option value="Quezon City">Quezon City</option>
                                                    <option value="Marikina">Marikina</option>
                                                    <option value="Caloocan">Caloocan</option>
                                                </select>
                                                <label for="location">Location</label>
                                            </div> -->
                                        <!-- </div> -->
                                        <div class="row col-12 col-md p-0 m-0 gap-2">
                                            
                                            <!-- category -->
                                            <div class="form-floating px-0">
                                                <select class="form-select" name="category" id="category" required>
                                                    <option value="" hidden selected>Choose Category</option>
                                                    <!-- <option value="electDev">Electronic Devices</option> -->
                                                    <option value="electronic accessories">Electronic Accessories</option>
                                                    <option value="home app">Home Appliances</option>
                                                    <!-- <option value="healt">Health & Beauty</option> -->
                                                    <!-- <option value="kids">Babies & Kids</option> -->
                                                    <!-- <option value="grocPets">Groceries & Pets</option> -->
                                                    <!-- <option value="homeLiving">Home & Living</option> -->
                                                    <option value="women fashion">Women's Fashion & Accessories</option>
                                                    <option value="men fashion">Men's Fashion & Accessories</option>
                                                    <option value="toys collection">Toys & Collectibles</option>
                                                    <option value="sports lifestyle">Sports & Lifestyle</option>
                                                    <option value="auto motive">Automotive & Motorcycles</option>
                                                </select>
                                                <label for="category">Category</label>
                                            </div>

                                            <!-- condition -->
                                            <div class="form-floating px-0">
                                                <select name="itemCondition" id="itemCondition" class="form-select" required>
                                                    <option value="" hidden selected>Choose Item Condition</option>
                                                    <option value="new">New</option>
                                                    <option value="slight">Slightly Used</option>
                                                    <option value="used">Used</option>
                                                </select>
                                                <label for="itemCondition">Condition</label>
                                            </div>

                                            <div class="form-floating px-0">
                                                <select name="exchange_method" id="exchange_method" class="form-select" required>
                                                    <option value="" hidden selected>Choose Delivery Type</option>
                                                    <option value="shipment">shipment</option>
                                                    <option value="meetup">meetup</option>
                                                    
                                                </select>
                                                <label for="exchange_method">Delivery</label>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <!-- desc -->
                                    <div class="form-floating px-0">
                                        <textarea name="itemDescrip" id="itemDetails" class="form-control" cols="30" rows="10" placeholder="Item Dectription" style="height: 150px;"></textarea required>
                                        <label for="itemDetails">Description</label>
                                    </div>

                                    <!-- img -->
                                    <input class="form-control" type="file" name="uploadImg[]" id="uploadImg" accept=".jpg, .jpeg, .png" multiple required>

                                    <input class="btn btn-warning mt-4 mb-1 fs-6" type="submit" name="submit" value="Upload">
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- trade with top up -->
                    <form class="row p-1 m-0 my-2 justify-content-center" id="tradeTopUpForm" enctype="multipart/form-data" method="post" action="php/CreatePostTopUpTrade.php">
                        <div class="row col col-xxl shadow justify-content-center align-items-start rounded p-4 px-2 m-0" style="background: white;">
                            <div class="row justify-content-center gap-2">                
                                <h2 class="fw-light text-center">Post your item on <b class="fw-semibold">TradeMark</b></h2>
                                <h6 class="fw-light text-center">This form is for <b class="fw-semibold">Trade with Top Up</b> method only.</h6>
                                <div class="row col gap-2 p-0 m-0">
                                    <div class="row gap-2 m-0 p-0">
                                        <div class="row col-12 col-md p-0 m-0 gap-2">

                                            <!-- item name -->
                                            <div class="form-floating px-0">
                                                <input type="text" class="form-control rounded" name="itemName" id="itemName" placeholder="Item Name">
                                                <label for="itemName">Item Name</label>
                                            </div>
                                            
                                            <!-- price -->
                                            <div class="form-floating px-0">
                                                <input type="number" name="price" id="price_label" class="form-control rounded" step="0.01" pattern="\d+(\.\d{2})?" placeholder="0.00">
                                                <label id="price_label">Price</label required>
                                            </div>
                                        </div>
                                        <div class="row col-12 col-md p-0 m-0 gap-2">

                                            <!-- location -->
                                            <div class="form-floating px-0">
                                                <!-- <select class="form-select rounded" name="location" id="location" required>
                                                    <option value="" hidden selected>Choose City</option>
                                                    <option value="local">Local</option>
                                                    <option value="Manila">Manila</option>
                                                    <option value="Pasay">Pasay</option>
                                                    <option value="Makati">Makati</option>
                                                    <option value="Quezon City">Quezon City</option>
                                                    <option value="Marikina">Marikina</option>
                                                    <option value="Caloocan">Caloocan</option>
                                                </select>
                                                <label for="location">Location</label> -->
                                                <input class="form-control" type="file" name="uploadImg[]" id="uploadImg" accept=".jpg, .jpeg, .png" multiple required>
                                            </div> 

                                            
                                            
                                            <!-- category -->
                                            <div class="form-floating px-0">
                                                <select class="form-select rounded" name="category" id="category" required>
                                                    <option value="" hidden selected>Choose Category</option>
                                                    <!-- <option value="electDev">Electronic Devices</option> -->
                                                    <option value="electronic accessories">Electronic Accessories</option>
                                                    <option value="home app">Home Appliances</option>
                                                    <!-- <option value="healt">Health & Beauty</option> -->
                                                    <!-- <option value="kids">Babies & Kids</option> -->
                                                    <!-- <option value="grocPets">Groceries & Pets</option> -->
                                                    <!-- <option value="homeLiving">Home & Living</option> -->
                                                    <option value="women fashion">Women's Fashion & Accessories</option>
                                                    <option value="men fashion">Men's Fashion & Accessories</option>
                                                    <option value="toys collection">Toys & Collectibles</option>
                                                    <option value="sports lifestyle">Sports & Lifestyle</option>
                                                    <option value="auto motive">Automotive & Motorcycles</option>
                                                </select>
                                                <label for="category">Category</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- condition -->
                                    <div class="form-floating px-0">
                                        <select name="itemCondition" id="itemCondition" class="form-select rounded" required>
                                            <option value="" hidden selected>Choose Item Condition</option>
                                            <option value="new">New</option>
                                            <option value="slight">Slightly Used</option>
                                            <option value="used">Used</option>
                                        </select>
                                        <label for="itemCondition">Condition</label>
                                    </div>

                                    <div class="form-floating px-0">
                                        <select name="exchange_method" id="exchange_method" class="form-select" required>
                                            <option value="" hidden selected>Choose Delivery Type</option>
                                            <option value="shipment">shipment</option>
                                            <option value="meetup">meetup</option>
                                            
                                        </select>
                                        <label for="exchange_method">Delivery</label>
                                    </div>

                                    <!-- desc -->
                                    <div class="form-floating px-0">
                                        <textarea name="itemDescrip" id="itemDetails" class="form-control rounded" cols="30" rows="10" placeholder="Item Dectription" style="height: 150px;"></textarea>
                                        <label for="itemDetails">Description</label>
                                    </div>
                
                                    <!-- img -->
                                    
                
                                    <input class="btn btn-warning mt-4 mb-1 fs-6" type="submit" name="submit" value="Upload">
                
                                </div>
                            </div>
                        </div>
                    </form>
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

    <!-- for method switch -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tradecoinBtn = document.getElementById('tradecoinBtn');
            const tradeBtn = document.getElementById('tradeBtn');
            const tradeTopUpBtn = document.getElementById('tradeTopUpBtn');
            const tradecoinForm = document.getElementById('tradecoinForm');
            const tradeForm = document.getElementById('tradeForm');
            const tradeTopUpForm = document.getElementById('tradeTopUpForm');
    
            tradecoinForm.style.display = tradecoinBtn.checked ? 'flex' : 'none';
            tradeForm.style.display = tradeBtn.checked ? 'flex' : 'none';
            tradeTopUpForm.style.display = tradeTopUpBtn.checked ? 'flex' : 'none';
    
            tradecoinBtn.addEventListener('change', function () {
                tradecoinForm.style.display = tradecoinBtn.checked ? 'flex' : 'none';
                tradeForm.style.display = 'none';
                tradeTopUpForm.style.display = 'none';
            });
    
            tradeBtn.addEventListener('change', function () {
                tradecoinForm.style.display = 'none';
                tradeForm.style.display = tradeBtn.checked ? 'flex' : 'none';
                tradeTopUpForm.style.display = 'none';
            });

            tradeTopUpBtn.addEventListener('change', function () {
                tradecoinForm.style.display = 'none';
                tradeForm.style.display = 'none';
                tradeTopUpForm.style.display = tradeTopUpBtn.checked ? 'flex' : 'none';
            });
        });
    </script>
</body>
</html>