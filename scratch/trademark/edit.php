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
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"> TRADEMARK</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href=addBalance.php> <button class="btn">Check Balance</button></a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];
                $NameName = $_POST['NameName'];
                $Gender = $_POST['Gender'];
                $Address = $_POST['Address'];
                $City = $_POST['City'];
                $MobileNum = $_POST['MobileNum'];
                


                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE users SET Username='$username', Email='$email', Age='$age', Password='$password', NameName='$NameName', Gender='$Gender', Address='$Address', City='$City', MobileNum='$MobileNum'  WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='home.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_Pass = $result['Password'];
                    $res_NameName = $result['NameName'];
                    $res_Gender = $result['Gender'];
                    $res_Address = $result['Address'];
                    $res_City = $result['City'];
                    $res_Mnum = $result['MobileNum'];
                }

            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>
                
                
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $res_Pass; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="NameName" name="NameName" id="NameName" value="<?php echo $res_NameName; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="gender">Gender</label>
                    <select name="Gender" id="Gender" value="<?php echo $res_Gender; ?>" autocomplete="off" required>
                    <option >--- SELECT ---</option>   
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>
                </div>
                <div class="field input">
                    <label for="address">Address</label>
                    <input type="text" name="Address" id="Address" value="<?php echo $res_Address; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="city">City</label>
                    <input type="text" name="City" id="City" value="<?php echo $res_City; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="MobileNum">Mobile Number</label>
                    <input type="number" name="MobileNum" id="MobileNum" value="<?php echo $res_Mnum; ?>" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>