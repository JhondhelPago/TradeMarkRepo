<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}


// Check for success parameter
$success = isset($_GET['success']) ? $_GET['success'] : null;

// Fetch and display the remaining balance if the verification was successful
$remainingBalance = null;

    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT balance FROM account_balance WHERE id = ?");
    $stmt->execute([$userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $remainingBalance = $row['balance'];
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
            <a href="addBalance.php"> <button class="btn">Check Balance</button></a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
        <div class="container">
            <div class="box form-box">
                <header>Remaining Balance: <?php echo $remainingBalance; ?></header>
                <form action="otp.php" method="post">
                    <div class="field input">
                        <label for="amount">Input Amount</label>
                        <input type="text" name="amount" required>
                    </div>
                    <button type="submit" class="btn" name="submit">Add Amount and Verify</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
