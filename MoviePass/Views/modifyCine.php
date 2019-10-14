<?php 
include_once("header.php");
include_once("navUser.php");
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Modificar<span>Cine</span></h2>
        <p>Modificacion de los campos del cine seleccionado.</p>
    </div>
</div>
    
    <div class="box">
        <div class="border-right">
            <div class="border-left">
                <div class="inner">

                    <div class="address">
                        <div class="fleft">
                            
                            <span>Nombre:</span> <?php  ?> <br>
                            <span>Direccion:</span> <?php  ?> <br>
                            <span>Capacidad:</span> <?php  ?> <br>
                            <span>Tarifa:</span> <?php  ?>

                            <br><br> FALTA AGREGAR LAS PELICULAS DE CADA CINE ( OPCIONAL )

                            <form action="<?php echo FRONT_ROOT."Cine/ModifyCine" ?>" method="post">

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Nombre</label>
                                    <input class="log-input" type="text" name="name" id="">
                                </div>
                        

                                <input type=submit class="button button-block" value="Elminar">

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
    


      

<?php
 include('footer.php') 
?>