<!-- phpmailer code here -->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if (isset($_POST['submit-contact-form'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication

        //Credentials
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username = 'daakticket05@gmail.com';                     //SMTP username
        $mail->Password = 'uitwbfxnprpgimjd';                               //SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('daakticket05@gmail.com', $name);
        $mail->addAddress('daakticket05@gmail.com', $name);
        //Add a recipient

        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Enquiry - DaakTicket contact form';
        $mail->Body = '<h3>Hello, You got a new Enquiry</h3>
                            <p>Name: ' . $name . '</p>
                             <p>Email: ' . $email . '</p>
                              <p>Subject: ' . $subject . '</p>
                               <p>Message: ' . $message . '</p>
                        ';


        if ($mail->send()) {

            echo 'Your message has been sent successfully. We will get back to you soon.';
            header('Location:contact.php');
            exit(0);
        } else {

            echo 'Message could not be sent';
            header('Location:contact.php');
            exit(0);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location:contact.php');
    exit(0);
}
?>