<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         
         include("php/config.php");
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

         //verifying the unique email

         $verify_query = mysqli_query($conn,"SELECT Email FROM users WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($conn,"INSERT INTO users(Username,Email,Age,Password,NameName,Gender,Address,City,MobileNum) VALUES('$username','$email','$age','$password','$NameName','$Gender','$Address','$City','$MobileNum')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
         

         }

         }else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="NameName" name="NameName" id="NameName" autocomplete="off" required>
                </div>
                <div class="field gender">
                <label for="Gender">Gender</label>
                <select name="Gender" id="Gender" required>
                <option >--- SELECT ---</option>   
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                </select>
                </div>
                <div class="field input">
                    <label for="address">Address</label>
                    <input type="text" name="Address" id="Address" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="city">City</label>
                    <input type="text" name="City" id="City" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="MobileNum">Mobile Number</label>
                    <input type="text" name="MobileNum" id="MobileNum"  required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>

                </div>

                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>