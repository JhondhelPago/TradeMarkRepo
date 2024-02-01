<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Adjust the path to autoload.php based on your installation
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jhondhelpago2307@gmail.com'; // Your Gmail address
    $mail->Password = 'Jinjapaplesoffy2024';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('jhondhelpago2307@gmail.com', 'Jhondhel Pago');
    $mail->addAddress('pago.j.bscs@gmail.com', 'spotifpags');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Testing';
    $mail->Body = 'sample email testing.';

    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>