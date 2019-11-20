<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


// Instantiation and passing `true` enables exceptions

$user = $_SESSION['loggedUser'];
$email = $user->getEmail();

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                 // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'moviepass.lab4@gmail.com';                     // SMTP username
    $mail->Password   = 'altotpamigo';                               // SMTP password
    $mail->SMTPSecure =  'tls'; //PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('moviepass.lab4@gmail.com', 'Movie Pass Support');      // Mail del que envia el msj
    $mail->addAddress($email);     // Mail del que recibe el msj

    // Attachments
    //$mail->addAttachment('QR/img/'.$idTicket.'.png');         // Add attachments


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Gracias por realizar su compra en MoviePass';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';


    $mail->send();
    // echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>