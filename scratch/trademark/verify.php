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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Trademark</a> </p>
        </div>

        <div class="right-links">

            
            <a href=addBalance.php> <button class="btn">Check Balance</button></a>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

    <div class="container">
        <div class="box form-box">
    <header>Verify OTP</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="otp">Input OTP</label>
                    <input type="text" name="otp" required>
        <button type="submit" class="btn">Verify</button>
    </form>
                </div>
            </div>
        

</div>
</div>
    </main>
</body>
</html>