<?php 

// include QR_BarCode class 
include_once("QR_BarCode.php"); 

// QR_BarCode object 
$qr = new QR_BarCode(); 

// create text QR code 
$qr->text("Butaca " . $ticket->getSeat()); 

$qr->url('Butaca'. $ticket->getSeat());

// display QR code image
// save QR code image
$qr->qrCode(250,'C:\wamp64\www\TP-MoviePass\MoviePass\QR\img\ '.$ticket->getSeat().'.png');


?>

