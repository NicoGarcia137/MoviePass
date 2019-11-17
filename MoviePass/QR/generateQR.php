<?php 

// include QR_BarCode class 
include "QR_BarCode.php"; 

// QR_BarCode object 
$qr = new QR_BarCode(); 

// create text QR code 
$qr->text($idTicket); 

// display QR code image
// save QR code image
$qr->qrCode(350,__DIR__.'/img/'.$idTicket.'.png');

?>

