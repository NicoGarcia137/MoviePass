<?php 
include_once("header.php");
include_once("navUser.php");
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Compras<span>Realizadas</span></h2>
        <p>Historial de todas las compras realizadas.</p>
    </div>
</div>


<?php 
// var_dump($purchases);

foreach($purchases as $purchase){
     //var_dump($purchase);
?>

    <div class="box">
        <div class="border-right">
            <div class="border-left">
                <div class="inner">
                    <div class="address">
                        <div class="fleft" >
                   
                            <h3>Compra</h3>
                            <span>ID: </span> <?php echo $purchase->getId(); ?> 
                            <br>
                            <span>Valor total: </span> <?php echo "$ " . $purchase->getTotalValue(); ?> 
                            <br>
                            <span>Fecha: </span> <?php echo $purchase->getDateTime(); ?>
                            <br>
                            <span>Comprador: </span> <?php echo $purchase->getUser()->getEmail(); ?>
                            <br><br>
                            <h3>Tickets: </h3> 
                            
                        </div>
                    </div>     

                    <div class="ticketBox"><hr></div> <!-- Barra superior -->
<?php
    
    foreach($purchase->getTickets() as $ticket){
        //var_dump($ticket);
?> 
        <div class="ticketBox">
            <br>
            <h5><span> ID: </span> <?php echo $ticket->getId(); ?> </h5>
            <h5><span> Pelicula: </span> <?php echo $ticket->getShow(); ?> </h5>
            <h5><span> Asiento: </span> <?php echo $ticket->getSeat(); ?> </h5>
            <h5><span> Valor: $</span> <?php echo $ticket->getValue(); ?> </h5>
            <br>
            <hr> <!-- Barra inferior -->
        </div>
<?php
    }
?>
                </div>
            </div>
        </div>
    </div>

    <br>

<?php
}
?>



<?php 
include_once("footer.php");
?>