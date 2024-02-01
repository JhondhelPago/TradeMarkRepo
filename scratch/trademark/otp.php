<?php
session_start();

include("php/config.php");
require_once 'PHPMailer-master/src/Exception.php';
require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to generate a random OTP
function generateOTP() {
    return mt_rand(100000, 999999);
}

// Function to send OTP via email
function sendOTPEmail($toEmail, $otp, $mail) {
    try {
        // Set recipient email address
        $mail->addAddress($toEmail);

        // Set the subject of the email
        $mail->Subject = 'OTP Verification';

        // Set the body of the email
        $mail->Body = "Your OTP for verification is: $otp";

        // Use SMTP for sending emails
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'jhondhelpago2307@gmail.com';  // Replace with your SMTP username
        $mail->Password = 'xpbc upui uole geqs';  // Replace with your SMTP password
        $mail->SMTPSecure = 'tls';  // You can change this to 'ssl' if needed
        $mail->Port = 587;  // You can change this port based on your SMTP server configuration


        // ... (no changes in the remaining email sending code)

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Error sending email: ' . $e->getMessage());
        return false;
    } finally {
        echo '<pre>' . htmlspecialchars($mail->ErrorInfo) . '</pre>';
    }
}

// Start the session (only once)
// if (!isset($_SESSION['user_id'])) {
//     header("Location: .php");
//     exit();
// }

// Instantiate PHPMailer
$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_INT);

    if (ctype_digit($amount) && strlen($amount) === 4) {
        // Generate and store OTP if not already set
        if (!isset($_SESSION['otp'])) {
            $_SESSION['otp'] = generateOTP();
        }

        $otp = $_SESSION['otp'];

        // Fetch user email from the database based on session ID
        $userId = $_SESSION['id'];
        $stmt = $pdo->prepare("SELECT Email FROM users_information WHERE id = ?");
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $toEmail = $row['Email'];

            // Send OTP via email
            if (sendOTPEmail($toEmail, $otp, $mail)) {
                // OTP sent successfully
                $_SESSION['amount'] = $amount; // Store amount in session
                header("Location: otpVerification.php");
                exit();
            } else {
                // Error sending OTP
                echo 'Error sending OTP. Please try again.';
            }
        } else {
            // User not found in the database
            echo 'Error: User not found.';
        }
    } else {
        // Invalid amount
        echo 'Invalid amount. Please enter a 6-digit number.';
    }
}

?>
