<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <style>
        * {
            font-family: "Poppins", sans-serif;
        }
    </style>
    <title>Welcome to TradeMark</title>
    <link rel="icon" type="image/x-icon" href="assets/PRIMARY_game-icons_cardboard-box-closed.svg">
</head>
<body>
    <section>
        <div class="container-fluid" >
            <div class="row justify-content-center align-items-center">

                <!-- navbar -->
                <div class="col col-md-10 position-absolute top-0 justify-content-between">
                    <div class="navbar">
                        <div class="navbar-brand">
                            <div class="h3">
                                <img class="w-25" src="assets/game-icons_cardboard-box-closed.svg" alt="logo"/>
                                TradeMark
                            </div>
                        </div>
                    </div>
                </div>

                <!-- bg boxes -->
                <div class="row h-100 w-100 position-fixed top-0 start-0 overflow-hidden" style="z-index: -1;">
                    <div class="row h-100" style="">
                        <div class="h-100 w-100 top-0 translate-middle" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                        <div class="position-absolute w-75 h-100 bottom-0 end-0" style=" border-radius: 10px; background-color: #d3d7eb; filter: blur(100px);"></div>
                        <div class="h-25 w-50 position-absolute bottom-0 end-0 translate-middle-y" style=" border-radius: 10px; background-color: #b9b1df; filter: blur(150px);"></div>
                    </div>
                </div>

                <!-- empty space -->
                <div class="col-1" style="height: 100vh;">
                </div>

                <!-- hero section -->
                <div class="col col-md-10" >
                    <div class="row justify-content-center align-items-center" >

                        <!-- hero img for sm -->
                        <div class="col-6 d-inline d-lg-none justify-content-center align-items-center">
                            <img class="img-fluid" src="assets\exchange.png" alt="exchange">
                        </div>

                        <!-- hero text -->
                        <div class="col-12 col-md-8  text-center text-lg-start" >
                            <!-- <h1 class="fw-semibold" style="font-size: clamp(40px, 4vw, 60px);">Join a Trusted<br>Trading Community</h1> -->
                            <!-- style=" background: rgba(255, 255, 255, 0.19); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); backdrop-filter: blur(6.2px); -webkit-backdrop-filter: blur(6.2px);  border-radius: 10px;" -->
                            <div class="div" style="">
                                <h1 class="fw-bold " style="font-size: clamp(30px, 4vw, 80px);">Join a Trusted<br>Trading Community</h1>
                                <p class="fw-regular mb-5" style="font-size: clamp(12px, 2vw, 20px);">Effortless Trading at Your Fingertips.</p>
                            </div>

                            <!-- background-color: #FFBC3C; -->

                            
                            <button class="col-8 col-md-4 col-xxl-2 btn m-1 btn-warning fw-regular" id="login_button">Login</button>
                            <button class="col-8 col-md-4 col-xxl-2 btn m-1 btn-outline-warning border-dark text-dark fw-regular" id="login_button">Sign-Up</button>
                        </div>

                        <!-- hero img -->
                        <div class="col-5 col-md-4 col-xl-4 d-none d-lg-inline">
                            <img class="img-fluid" style="" src="assets\exchange.png" alt="exchange">
                        </div>
                    </div>
                </div>
                
                <!-- empty space -->
                <div class="col-1" style="height: 100vh;">
                </div>

                <!-- form -->
                <div class="position-absolute end-0" style="width: 12vw; height: 100vh; z-index: -1; background: linear-gradient(153deg, #3D53C9 50.01%, #593DC9 100.41%);">
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.getElementById("login_button").addEventListener("click", function() {
        window.location.href = "login_form.php"; // Redirect to home.php
        });
    </script>
</body>
</html>