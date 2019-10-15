<?php 
include_once("header.php");
include_once("navAdmin.php");
?>
      
<div id="signupSlogan">
    <div class="inside">
        <h2>Cines<span>Disponibles</span></h2>
        <p>Listado de cines disponibles para su utilización.</p>
    </div>
</div>


<?php 

    foreach ($cines as $cine)
    {
?>
    
    <div class="box">
        <div class="border-right">
            <div class="border-left">
                <div class="inner">

                    <div class="address">

                        <div class="fleft">
                            
                            <span>Id:</span> <?php echo $cine->getId() ?> <br>
                            <span>Nombre:</span> <?php echo $cine->getName() ?> <br>
                            <span>Direccion:</span> <?php echo $cine->getAddress() ?> <br>
                            <span>Capacidad:</span> <?php echo $cine->getCapacity() ?> <br>
                            <span>Tarifa:</span> <?php echo "$" . $cine->getValue() ?>

                            <br><br> FALTA AGREGAR LAS PELICULAS DE CADA CINE ( OPCIONAL )
                            
                        </div>

                        <div class="fright">
                            
                            <form action="<?php echo FRONT_ROOT."Cine/ShowModifyView" ?>">
                        
                                <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $cine->getId() ?>" >Modificar</button>
                        
                            </form>

                            <br>
                            
                            <form action="<?php echo FRONT_ROOT."Cine/RemoveCine" ?>">
                        
                                <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $cine->getId() ?>" >Eliminar</button>
                        
                            </form>

                        </div>
                        
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