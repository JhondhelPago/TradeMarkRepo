<?php 
   session_start();
  
   include("php/config.php");
   if (!isset($_SESSION['id'])) {
       header("location:index.php");
       exit();
   }
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Pragma: no-cache");

   // Assuming $conn is your database connection object
   $id = $_SESSION['id'];

   $query = $conn->query("SELECT id, Username, Email, Password, Age, NameName, Gender, Address, City
                          FROM users
                          WHERE id = '$id'") or die(mysqli_error($conn));

   $fetch = $query->fetch_array();
   // Now you can access user information from the 'users' table
   $email = $fetch["Email"];
   $username = $fetch['Username'];
   $age = $fetch['Age'];
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
            <a> <button class="btn" onclick="window.location.href='addBalance.php?user_id=<?php echo $fetch['id'];?>'">Check Balance</button></a>

    
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $username ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>And you are <b><?php echo $age ?> years old</b>.</p> 
            </div>
          </div>
    </main>
</body>
</html>
