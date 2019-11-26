<?php 

// include QR_BarCode class 
include_once("QR_BarCode.php"); 

// QR_BarCode object 
$qr = new QR_BarCode(); 

// create text QR code 
$qr->text($ticket->getId()); 


// display QR code image
// save QR code image
$qr->qrCode(250,__DIR__.'/img/'. $ticket->getId().'.png');


?>

