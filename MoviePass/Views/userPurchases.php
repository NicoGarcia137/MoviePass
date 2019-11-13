<?php 
include_once("header.php");
include_once("navUser.php");
?>

<?php 
var_dump($purchases);
foreach($purchases as $purchase){
    echo $purchase->getUser()->getEmail();
    foreach($purchase->getTickets() as $ticket){
        echo $ticket->getId();
    }}?>
    



<?php 
include_once("footer.php");
?>