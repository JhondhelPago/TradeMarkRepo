<?php 
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
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
    
    <title>Profile</title>
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
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="history.php">History</a>
                                    </li>
                                    <li class="nav-item rounded navHover">
                                        <a class="nav-link text-light" aria-current="page" href="">TC Balance</a>
                                    </li>
                                    <!-- profile for sm screen -->
                                    <li class="nav-item d-xxl-none rounded">
                                        <a class="nav-link text-light navActive mx-1 px-3 my-1 my-xxl-0 border border-light rounded disabled" aria-current="page" href="#">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="new_createPost.php">
                                            <div class="btn btn-warning scaleHover">Create Post</div>
                                        </a>
                                    </li>
                                    <!-- profile for xxl screen -->
                                    <li class="nav-item d-none d-xxl-inline">                                        
                                        <a class="nav-link disabled" aria-current="page" href="#">
                                            <div class="profile-pic-btn border border-1 border-light rounded-circle" style="scale: 1.05;">
                                                <img class="frame rounded-circle p-1" src="assets/WHITEprofileSvg.svg" />
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
                    <div class="row display-1 fw-bold text-center justify-content-center header1 mb-3">MY PROFILE</div>

                    <div class="row p-1 m-0 my-2 gap-4">
                        <!-- update profile -->
                        <div class="row col-12 col-lg shadow justify-content-center align-items-start rounded p-4 px-2 m-0" style="background: white;">
                            <?php 
                                if(isset($_POST['submit'])){
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $age = $_POST['age'];
                                    $gender = $_POST['gender'];
                                    $city = $_POST['city'];
                                    $address = $_POST['address'];
                                    $mobile_num = $_POST['mobile_num'];

                                    $id = $_SESSION['id'];

                                    $edit_query = mysqli_query($con,"UPDATE users_information SET _Name='$username', Password='$password', Age='$age', Gender='$gender', City='$city', _Address='$address', Mobile_number='$mobile_num' WHERE Id=$id ") or die("error occurred");

                                    if($edit_query){
                                        echo "<div class='message'>
                                        <p>Profile Updated!</p>
                                    </div> <br>";
                                echo "<a href='home.php'><button class='btn'>Go Home</button>";
                        
                                    }
                                }else{

                                    $id = $_SESSION['id'];
                                    $query = mysqli_query($con,"SELECT*FROM users_information WHERE Id=$id ");

                                    while($result = mysqli_fetch_assoc($query)){
                                        $res_Uname = $result['_Name'];
                                        $res_Age = $result['Age'];
                                        $res_password = $result['Password'];
                                        $res_Gender = $result['Gender'];
                                        $res_City = $result['City'];
                                        $res_Mobile_number = $result['Mobile_number'];
                                        $res_Address = $result['_Address'];
                                        
                                    }

                                ?>
                                <form class="row justify-content-center text-center gap-2" action="" method="post">
                                    <h1 class="fw-bold">Edit Profile</h1>
                                    <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                        <input class="form-control col-12 rounded" type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                                        <label for="username">Username</label>
                                    </div>

                                    <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                        <input class="form-control col-12 rounded" type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                                        <label for="age">Age</label>
                                    </div>

                                    <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                        <select class="form-select col-12 rounded" type="text" name="gender" id="gender" autocomplete="off" required>
                                            <option value="<?php echo $res_Gender ?>" selected><?php if($res_Gender == "M"){echo "Male";}else{echo "Female";}?></option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <label for="gender">Gender</label>
                                    </div>

                                    <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                        <input class="form-control col-12 rounded" type="text" name="address" id="address" value="<?php echo $res_Address; ?>" autocomplete="off" required>
                                        <label for="address">Address</label>
                                    </div>

                                    <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                        <select class="form-select col-12 rounded" type="text" name="city" id="city" autocomplete="off" required>
                                            <option value="<?php echo $res_City ?>" selected><?php echo $res_City ?></option>
                                            <option value="Caloocan City">Caloocan City</option>
                                            <option value="Las Piñas City">Las Piñas City</option>
                                            <option value="Makati City">Makati City</option>
                                            <option value="Malabon City">Malabon City</option>
                                            <option value="Mandaluyong City">Mandaluyong City</option>
                                            <option value="Manila City">Manila City</option>
                                            <option value="Marikina City">Marikina City</option>
                                            <option value="Muntinlupa City">Muntinlupa City</option>
                                            <option value="Navotas City">Navotas City</option>
                                            <option value="Parañaque City">Parañaque City</option>
                                            <option value="Pasay City">Pasay City</option>
                                            <option value="Pasig City">Pasig City</option>
                                            <option value="Quezon City">Quezon City</option>
                                            <option value="San Juan City">San Juan City</option>
                                            <option value="Taguig City">Taguig City</option>
                                            <option value="Valenzuela City">Valenzuela City</option>
                                        </select>
                                        <label for="city">City</label>
                                    </div>

                                    <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                        <input class="form-control col-12 rounded" type="text" name="mobile_num" id="mobile_num" value="<?php echo $res_Mobile_number; ?>" autocomplete="off" required>
                                        <label for="mobile_num">Mobile Number</label>
                                    </div>

                                    <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                        <input class="form-control col-12 rounded" type="text" name="password" id="password" value="<?php echo $res_password; ?>" autocomplete="off" required>
                                        <label for="password">Password</label>
                                    </div>

                                    <div class="row m-0 p-0">
                                        <input class="btn btn-warning px-5 my-3" type="submit" name="submit" value="Confirm Changes" required>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                        <!-- top up -->
                        <!-- <div class="row col-12 col-lg shadow justify-content-center align-items-start rounded p-4 px-2 m-0" style="background: white;">
                            <form class="row justify-content-center text-center gap-2" action="">
                                <h1 class="fw-bold">TradeCoin Top Up</h1>

                                <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center gap-2">
                                    <small class="col p-0 m-0">Current TradeCoin Balance</small>
                                    <div class="col-12 d-flex align-items-center justify-content-center rounded p-0 m-0 mb-2" style="background-color: #8393ec2f;">
                                        <h3 class="h3 fw-semibold text-center text-break p-3 m-0">99999999999999976967967967967999999999</h6>
                                    </div>
                                </div>

                                <div class="container form-floating m-0 p-0 text-center justify-conent-center align-items-center rounded gap-2">
                                    <input class="form-control col-12 rounded" type="number" name="topup" id="topup" placeholder="Top Up Amount" autocomplete="off" required>
                                    <label for="topup">Top Up Amount</label>
                                </div>

                                <div class="row m-0 p-0">
                                    <input class="btn btn-warning px-5 my-3" type="submit" name="submit" value="Add to Balance" required>
                                </div>
                            </form>
                        </div> -->
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
            window.location.href = 'newhome.php';
        }
    </script>
</body>
</html>