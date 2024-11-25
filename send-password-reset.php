<?php
session_start();
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email = $_POST['email'];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);
$sql = "UPDATE user SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();

if ($stmt->affected_rows > 0) {

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    //Credentials
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username = 'daakticket05@gmail.com';         //SMTP username
    $mail->Password = 'doeybjsruqeejdom';               //SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
    $mail->Port = 587;

    $mail->isHTML(true);
    $mail->setFrom("noreply@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Hi there,
    To reset your password, please click on the following link: 
    <a href='http://localhost/daakticket/reset_password.php?token=$token'>Reset Password</a>

    END;

    try {
        $mail->send();
        $_SESSION['message'] = "Message sent, please check your inbox.";
        $_SESSION['messageType'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = "Message could not be sent. Error: {$mail->ErrorInfo}";
        $_SESSION['messageType'] = "error";
    }
} else {
    $_SESSION['message'] = "No account found with this email.";
    $_SESSION['messageType'] = "error";
}
header('Location: forgot_password.php');
exit;
