<?php 
    include_once("header.php");
    include_once("navUser.php");
?>

<br>
        <h3>Se procede a realizar la compra: <h3><br>
        <h3>Pelicula: <?php echo $show->getMovie()->getName(); ?></h3>
        <h3>Fecha: <?php echo $show->getDateTime()->format('Y-m-d'); ?></h3>
        <h3>Hora: <?php echo $show->getDateTime()->format('H:i'); ?></h3>
        <h3>Valor: $<?php echo $value; if($discount==true){ echo " Promocion martes y miercoles, Descuento 25% Aplicado.";} ?></h3>
        <h3>Butacas: <?php echo implode("-",$seats) ?></h3>
        
        <br>
        <h3>Cantidad de entradas: <?php echo count($seats);  ?></h3>
        <h3>Valor Final: $<?php echo $value*count($seats);?></h3>
        <h3>Si Desea Continuar Introduzca su tarjeta de credito:  </h3><br>

        <form action="<?php echo FRONT_ROOT."Purchase/CreatePurchase" ?>" method="post">

            <input type="hidden" value="<?php echo $show->getId(); ?>" name="showId" >
            <input type="hidden" value="<?php echo $cine->getValue(); ?>" name="value">

            <input class="number" type="text" ng-model="ncard" name="creditCard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
            
           
            
            <select name="type">
            <option value="mastercard">MasterCard</option> 
            <option value="visa">Visa</option> 
            </select>


            <?php foreach($seats as $seat){ ?>
                <input type="hidden" value="<?php echo $seat ?>" name="seats[]" > 
            <?php  } ?>

            


            
            
            <button class="optButton optButton-block" type="submit"  > Confirmar</button>
        </form>

<br>


<?php include_once("footer.php") ?>