<?php 
include_once("header.php");
include_once("navUser.php");
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Cines<span>Disponibles</span></h2>
        <p>Listado de cines disponibles para su utilización.</p>
    </div>
</div>


<!-- 

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">



            </div>
        </div>
    </div>
</div> 

-->


<?php 

    foreach ($cines as $cine)
    {
?>
    
    <div class="box">
        <div class="border-right">
            <div class="border-left">
                <div class="inner">
                    
                <h3><span><?php echo $cine->getName() ?></span></h3>
                
                    <div class="address">

                        <div class="fleft">
                
                            <span>Direccion:</span> <?php echo $cine->getAddress() ?> <br>
                            <span>Capacidad:</span> <?php echo $cine->getCapacity() ?> <br>
                            <span>Tarifa:</span> <?php echo "$" . $cine->getValue() ?> <br><br>
                            <h3><span>Cartelera</span></h3>

                        </div>

                        <?php include("movieCarousel.php");?>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
        
<?php    }  ?>


      

<?php
 include('footer.php') 
?>