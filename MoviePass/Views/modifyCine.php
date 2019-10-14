<?php 
include_once("header.php");
include_once("navAdmin.php");

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
                        
                        <div class="form">
                            <form action="<?php echo FRONT_ROOT."Cine/ModifyCine" ?>" method="post">

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Nombre</label>
                                    <input class="log-input" type="text" name="name"  value="nombre_cine">
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Direccion</label>
                                    <input class="log-input" type="text" name="address" value="address_cine">
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Capacidad</label>
                                    <input class="log-input" type="text" name="capacity" value="capacity_cine">
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Tarifa</label>
                                    <input class="log-input" type="text" name="value" value="value_cine">
                                </div>


                                <input type=submit class="button button-block" value="Modificar">

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