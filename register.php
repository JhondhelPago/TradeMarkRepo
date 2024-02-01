<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
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

    <title>Sign-Up</title>
    <link rel="icon" type="image/x-icon" href="assets/PRIMARY_game-icons_cardboard-box-closed.svg">
</head>
<body>
    <section>
        <div class="container-fluid m-0 p-0" >
            <div class="row justify-content-center align-items-center m-0 p-0">

                <!-- navbar -->
                <div class="col col-md-10 top-0 position-absolute justify-content-between" style="z-index: 4;">
                    <!-- black logo -->
                    <div class="navbar d-none d-md-flex">
                        <div class="navbar-brand text-center">
                            <div class="h3 fw-semibold user-select-none" style="margin: 0; cursor: pointer;" onclick="redirectToLanding()">
                                <img class="w-25" src="assets/game-icons_cardboard-box-closed.svg" alt="logo"/>
                                TradeMark
                            </div>
                        </div>
                    </div>
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

                <!-- left empty space -->
                <div class="col-1" style="height: 100vh; opacity: 30%;"></div>

                <!-- hero -->
                <div class="row col-5 d-none d-md-inline justify-content-center align-items-center m-0 p-0 mt-5 pe-2">
                    <!-- hero img for sm -->
                    <div class="row">
                        <div class="col-8 d-inline d-xxl-none">
                            <img class="img-fluid" style="max-height: 90vh;" src="assets\exchange.png" alt="exchange">
                        </div>
                    </div>

                    <!-- hero text -->
                    <div class="col-12 mt-4 text-start">
                        <!-- <h1 class="fw-semibold" style="font-size: clamp(40px, 4vw, 60px);">Join a Trusted<br>Trading Community</h1> -->
                        <!-- style=" background: rgba(255, 255, 255, 0.19); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); backdrop-filter: blur(6.2px); -webkit-backdrop-filter: blur(6.2px);  border-radius: 10px;" -->
                        <h1 class="fw-bold" style="font-size: clamp(30px, 3vw, 80px);">Join a Trusted<br>Trading Community</h1>
                        <p class="fw-regular" style="font-size: clamp(12px, 2vw, 20px);">Effortless Trading at Your Fingertips.</p>
                    </div>

                    <!-- hero img center -->
                    <div class="col-3 position-absolute d-none d-xxl-inline start-50 top-50 translate-middle" style="z-index: 3;">
                        <img class="img-fluid" style="max-height: 90vh;" src="assets\exchange.png" alt="exchange">
                    </div>
                </div>

                <div class="row col-5"></div>

                <!-- right empty space -->
                <div class="col-1 d-none d-md-inline" style="height: 100vh; opacity: 30%; z-index: 5;"></div>
                
            </div>
            <!-- end of body -->
            
            <!-- form -->
            <div class="col-12 col-md-6 h-100 position-absolute top-0 end-0 overflow-auto" style="z-index: 1; background: linear-gradient(157deg, #3D53C9 0%, #593DC9 27.82%); -webkit-box-shadow: inset 0px 0px 30px 0px rgba(0,0,0,0.75); -moz-box-shadow: inset 0px 0px 30px 0px rgba(0,0,0,0.75); box-shadow: inset 0px 0px 30px 0px rgba(0,0,0,0.75); transition: all 1s ease-in-out;" id="formContainer">
                <div class="row col justify-content-center align-items-center m-0 p-0 rounded">

                    <!-- navbar -->
                    <div class="col col-md-10 top-0 position-absolute justify-content-center p-0 m-0 d-flex d-md-none" style="z-index: 4;">
                        <!-- white logo -->
                        <div class="navbar justify-content-center" >
                            <div class="navbar-brand text-center justify-content-center">
                                <div class="h3 m-0 p-0 fw-semibold text-light user-select-none" style="cursor: pointer;" onclick="redirectToLanding()">
                                    <img class="w-25" src="assets/WHITE_game-icons_cardboard-box-closed.svg" alt="logo"/>
                                    TradeMark
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- switch form btn -->
                    <div class="row justify-content-center my-5 pt-5">
                        <div class="col-9 col-md-8 col-xxl-4 btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="login_btn" autocomplete="off">
                            <label class="btn btn-outline-warning" for="login_btn" onclick="redirectToIndex()">Login</label>
                        
                            <input type="radio" class="btn-check" name="btnradio" id="signup_btn" autocomplete="off" checked>
                            <label class="btn btn-outline-warning" for="signup_btn">Sign Up</label>
                        </div>
                    </div>

                    <!-- signup form container -->
                            <form class="row justify-content-center align-items-center mb-5 px-4" id="signupForm" method="post" action="php/register_form_action.php">
                                <div class="col-10 col-md-9 col-xxl-7 shadow-lg py-5 position-relative" style="border-radius: 1.875rem; z-index: 2; background-color: white;">
                                    <h2 class="px-3 text-center">Create your<br>account.</h2>

                                    <!-- signup form -->
                                    <div class="row mt-5 px-5 text-center">
                                        
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" id="username" name="username" required>
                                        </div>
                                        <div class="row m-0 p-0">
                                            <div class="col-12 col-sm input-group mb-3">
                                                <input type="number" class="form-control" placeholder="Age" aria-label="Age" id="age" name="age" required>
                                            </div>
                                            <div class="col-12 col-sm input-group mb-3">
                                                <select class="form-select" type="text" id="gender" name="gender" required>
                                                    <option selected hidden>Gender</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Address" aria-label="Address" id="address" name="address" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-select" type="text" id="city" name="city" required>
                                                <option selected hidden>City</option>
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
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Mobile Number" aria-label="Mobile Number" id="mobile_num" name="mobile_num" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Email" aria-label="Email" id="email" name="email" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" id="password" name="password" required>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" id="confirm_password" name="confirm_password" required>
                                        </div>
                                        <!-- <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" id="" required>
                                        </div> -->
                                        
                                        <hr class="mt-3">
                                        <p class="my-3">OR</p>
                                        
                                        <div class="mb-3">
                                            <img class="col-2 h-75" src="assets/googleSvg.svg" alt="google">
                                            <img class="col-2 h-75" src="assets/facebookSvg.svg" alt="facebook">
                                        </div>
                                        <hr>
                                        
                                        <!-- <div class="mb-3 mt-3 text-start">
                                            <input type="checkbox" name="rememberMe" id="rememberMe">
                                            <label for="rememberMe">Remember me</label>
                                        </div> -->

                                        <div class="justify-content-center my-3">
                                            <input class="col-12 btn btn-warning justify-items-center" type="submit" name="submit" value="Sign-Up" required>
                                        </div>
                                        
                                        <p class="my-3">Already a member?
                                            <a href="login_form.php">Login</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="row fs-6 text-center justify-content-center text-light fw-light m-0 mt-5 p-0 px-2">
                                By proceeding to sign up, I acknowledge that I have read and consented to TradeMark's Terms of Use and Privacy Policy, which sets out how TradeMark collects, uses and discloses my personal data, and the rights that I have under applicable law.
                                </div>
                            </form>
                        

                    <!-- login form container -->
                    <!-- <form class="row justify-content-center align-items-center mb-5 px-4" id="loginForm" style="display: none;">
                        <div class="col-10 col-md-9 col-xxl-7 shadow-lg py-5 position-relative" style="border-radius: 1.875rem; z-index: 2; background-color: white;">
                            <h2 class="px-3 text-center">Login to your account.</h2>

                            login form (comment)
                            <div class="row mt-5 px-5 text-center">
                                <div class="input-group my-3">
                                    <input type="text" class="form-control" placeholder="Email or Mobile Number" aria-label="Email">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password">
                                </div>
                                
                                <a class="text-start mb-4" href="">Forgot Password?</a>

                                <hr>
                                <p class="my-3">OR</p>
                                
                                <div class="mb-3">
                                    <img class="col-2 h-75" src="assets/googleSvg.svg" alt="google">
                                    <img class="col-2 h-75" src="assets/facebookSvg.svg" alt="facebook">
                                </div>
                                <hr>
                                
                                <div class="mb-3 mt-3 text-start">
                                    <input type="checkbox" name="rememberMe" id="rememberMe">
                                    <label for="rememberMe">Remember me</label>
                                </div>

                                <div class="justify-content-center mb-3">
                                    <input class="col-12 btn btn-warning justify-items-center" type="submit" value="Login">
                                </div>
                                
                                <a class="my-3" href="">Don't have an account?</a>
                            </div>
                        </div>
                    </form> -->

                </div>
            </div>
            
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- switch form -->
    <script>
        function redirectToIndex() {
            window.location.href = 'login_form.php';
        }
    </script>
    <!-- logo -->
    <script>
        function redirectToLanding() {
            window.location.href = 'register.php';
        }
    </script>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            
            const loginSwitch = document.getElementById('login_btn');
            const signupSwitch = document.getElementById('signup_btn');
            const formContainer = document.getElementById('formContainer');
    
            function setFormBackground(isSignup) {
                const gradient = isSignup
                    ? 'linear-gradient(157deg, #3D53C9 0%, #593DC9 27.82%)'
                    : 'linear-gradient(153deg, #3D53C9 50.01%, #593DC9 100.41%)';
    
                formContainer.style.background = gradient;
            }
    
            setFormBackground(signupSwitch.checked);
    
            loginSwitch.addEventListener('change', function () {
                loginForm.style.display = 'flex';
                signupForm.style.display = 'none';
                setFormBackground(false);
            });
    
            signupSwitch.addEventListener('change', function () {
                loginForm.style.display = 'none';
                signupForm.style.display = 'flex';
                setFormBackground(true);
            });
        });
    </script> -->
    <?php
       if(isset($_SESSION['register_valid']) && $_SESSION['register_valid'] == false){
            echo  "<script>alert(\"confirm password did not match to password.\")</script>";
       }
       unset($_SESSION['register_valid']);
    ?>

    

</body>
</html>