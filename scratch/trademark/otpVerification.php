<?php
session_start();
require "../../php/EssentialClasses.php";
require "php/config.php";

// include("php/config.php");
// if (!isset($_SESSION['id']) || !isset($_SESSION['otp'])) {
//     header("Location: index.php");
//     exit();
// }

// Check for notification and display it
$notification = isset($_SESSION['notification']) ? $_SESSION['notification'] : null;
unset($_SESSION['notification']); // Clear the notification after displaying it



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
    $user_otp = $_POST['user_otp'];

    if ($user_otp == $_SESSION['otp']) {
        // OTP verification successful
        $amount = $_SESSION['amount'];

        // Insert the balance into the database (replace with your actual database code)
        $userId = $_SESSION['user_id'];

        $sql = "UPDATE account_balance SET balance = balance + ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$amount, $userId]);

        // $MyServerAcc = new SERVER("projectdb", "account_balance");
        // $MyServerAcc->Server_Conn();

        // $MyServerAcc_sql = "UPDATE " . $MyServerAcc->get_table() . " SET `balance` =  `balance` + ? WHERE id = ?";
        
        // $stmt = $MyServerAcc->get_ServerConnection()->prepare($sql);

        // $stmt->execute([$amount, $user_id]);


        // Clear sessions
        unset($_SESSION['otp']);
        unset($_SESSION['amount']);

        echo "OTP verified successfully. Amount added to the database.";
    } else {
        echo "Invalid OTP. Please try again.";
    }

    // Redirect back to addBalance.php with a success parameter
header("Location: addBalance.php?success=1");
exit();
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

    <?php if ($notification): ?>
                    <div class="notification"><?php echo $notification; ?></div>
                <?php endif; ?>

    <form action="otpVerification.php" method="post">
    <label for="user_otp">Enter OTP</label>
    <input type="text" name="user_otp" required>
    <button type="submit" name="verify">Verify OTP</button>
</form>
        
</div>
    </main>
</body>
</html>