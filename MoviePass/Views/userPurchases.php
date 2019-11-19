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
</br></br>
<form action="<?php echo FRONT_ROOT."Purchase/ShowUserPurchases" ?>" method="post">
        <button class="optButton optButton-block" type="submit" name="orderBy" value="date">Ordernar Por Fecha</button>
</br>
        <button class="optButton optButton-block" type="submit" name="orderBy" value="movie">Ordernar Por Peliculas</button>
</form>

<?php 

foreach($purchases as $purchase){
     
?>

<div class="box" >
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="fleft">
                    <div class="address">
                        <div class="fleft" >
                   
                            <h3>Compra</h3>
                            <span>Cine: </span> <?php echo $purchase->getCine()->getName(); ?>
                            <br>
                            <span>Valor total: </span> <?php echo "$ " . $purchase->getTotalValue(); ?> 
                            <br>
                            <span>Fecha: </span> <?php echo $purchase->getDateTime(); ?>
                            <br>
                            <span>Comprador: </span> <?php echo $purchase->getUser()->getEmail(); ?>
                            <br><br>

                        </div> <!-- /fleft -->
                    </div> <!-- /address -->
                </div>

                <button type="button" class="ticketCollapsible" > <span>Tickets</span> </button>

                <div class="ticketBox">
                    <br><hr><br> <!-- Barra superior -->
<?php
    foreach($purchase->getTickets() as $ticket){
?>                 
                    <h5><span> Sala: </span> <?php echo $purchase->getCine()->getRooms()[0]->getName(); ?> </h5>
                    <h5><span> Pelicula: </span> <?php echo $ticket->getShow()->getMovie()->getName(); ?> </h5>
                    <h5><span> Fecha: </span> <?php echo $ticket->getShow()->getDateTime()->format('Y-m-d'); ?> </h5>
                    <h5><span> Hora: </span> <?php echo $ticket->getShow()->getDateTime()->format('H:i'); ?> </h5>
                    <h5><span> Asiento: </span> <?php echo $ticket->getSeat(); ?> </h5>
                    <h5><span> Valor: $</span> <?php echo $ticket->getValue(); ?> </h5>

                    <br><hr><br> <!-- Barra inferior -->          
<?php
    }
?>
                </div> <!-- /ticketBox -->
            </div> <!-- /inner -->
        </div> <!-- /border-left -->
    </div> <!-- /border-right -->
</div> <!-- /box -->

    <br>

<?php
}
?>

<script>
    var coll = document.getElementsByClassName("ticketCollapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        } 
    });
    }
</script>

<?php 
include_once("footer.php");
?>

