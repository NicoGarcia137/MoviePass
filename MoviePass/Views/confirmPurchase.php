<?php 
    include_once("header.php");
    include_once("navUser.php");
    $baseurl="https://image.tmdb.org/t/p/w500";
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Finalizar<span>compra</span></h2>
        <p>Complete la forma de pago y termine la compra.</p>
    </div>
</div>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="address" >
                    <div class="form" >

                        <div class="fleft">
                            <img class="movieImg" src="<?php echo $baseurl . $show->getMovie()->getImage() ?>" alt="">
                        </div>

                        <div class="movieText">
                            <br>
                            <span>Pelicula: </span><?php echo $show->getMovie()->getName(); ?><br>
                            <span>Fecha:</span> <?php echo $show->getDateTime()->format('Y-m-d'); ?><br>
                            <span>Hora:</span> <?php echo $show->getDateTime()->format('H:i'); ?><br>
                            <span>Cantidad de entradas: </span><?php echo count($seats);  ?><br>
                            <span>Butacas:</span> <?php echo implode("-",$seats) ?><br>
                            <span>Valor Final: </span>$<?php echo $value*count($seats);?> <br>
                            <span>Valor:</span> $<?php echo $value; if($discount==true){
                                 ?><br> <h6>Promocion de martes y miercoles disponible. <br>25% de descuento aplicado.</h6>
                                 <?php
                                 } ?>
                        </div>
                    </div>
                        
                    <form class="form" action="<?php echo FRONT_ROOT."Purchase/CreatePurchase" ?>" method="post">
                    <div class="inner"><br><br><h4>Introduzca su tarjeta de credito  </h4></div>

                        <input type="hidden" value="<?php echo $show->getId(); ?>" name="showId" >
                        <input type="hidden" value="<?php echo $cine->getValue(); ?>" name="value">

                        <div class="fleft" >
                            <label class="log-label" for="creditCard">Numero</label>
                            <input class="log-input" class="number" type="text" ng-model="ncard" required name="creditCard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            
                        </div>
                        <div class="fright">
                            <label class="checkeableRad">
                                
                                <input type="radio" name="type" value="visa" required>
                                <img src="<?php echo FRONT_ROOT?>Views/images/visa.jpg"></input>
                            </label>
                            <label class="checkeableRad">
                                <input type="radio" name="type" value="mastercard">
                                <img src="<?php echo FRONT_ROOT?>Views/images/mastercard.jpg"></input>
                            </label>
                            
                            <br><br>
                            <div class=""><button class="optButton optButton-block" type="submit"  > Confirmar</button></div>
                        </div>

                        <?php foreach($seats as $seat){ ?>
                            <input type="hidden" value="<?php echo $seat ?>" name="seats[]" > 
                        <?php  } ?>
                        
                        
                       
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div> 
        


<?php include_once("footer.php") ?>