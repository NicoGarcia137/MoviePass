<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


// Instantiation and passing `true` enables exceptions

$user = $_SESSION['loggedUser'];
$email = $user->getEmail();
$tickets = $purchase->getTickets();


$mail = new PHPMailer(true);


try {
    $msg = "";
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

    foreach ($tickets as $ticket){

        include("QR/generateQR.php");

        $msg.="<h5><span> Sala: </span>" . $purchase->getCine()->getRooms()[0]->getName(). "</h5>
        <h5><span> Pelicula: </span> " . $ticket->getShow()->getMovie()->getName() ." </h5>
        <h5><span> Fecha: </span> " . $ticket->getShow()->getDateTime()->format('Y-m-d'). " </h5>
        <h5><span> Hora: </span> " . $ticket->getShow()->getDateTime()->format('H:i'). " </h5>
        <h5><span> Asiento: </span> ".  $ticket->getSeat() ." </h5>
        <h5><span> Valor: $</span> ".  $ticket->getValue() ." </h5> <br><br>";
  
        $mail->addAttachment("C:\wamp64\www\TP-MoviePass\MoviePass\QR\img\ ".$ticket->getSeat().".png", "Butaca ".$ticket->getSeat());

    }

    // Attachments
    // Add attachments


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Gracias por realizar su compra en MoviePass';
    $mail->Body    = '<br>Datos de su compra: <br><br><br>'.$msg;


    $mail->send();
    // echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>