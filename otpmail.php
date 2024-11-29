<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
function sendOTPEmail($to_email, $otp)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'daakticket05@gmail.com';                     //SMTP username
        $mail->Password = 'doeybjsruqeejdom';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'DaakTicket'); // Replace with sender details
        $mail->addAddress($to_email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Login';
        $mail->Body = "<p>Your OTP is: <strong>$otp</strong>. Use it to verify your email for Login. If you didn't request this, simply ignore this message. <br>
        Yours,<br>
        DaakTicket Team</p>";

        // Send the email
        if ($mail->send()) {
            return true; // OTP sent successfully
        } else {
            return false; // OTP sending failed
        }
    } catch (Exception $e) {
        // Log the error if email sending fails
        error_log("Error sending OTP email: " . $mail->ErrorInfo);
        return false; // Error occurred while sending the OTP
    }
}