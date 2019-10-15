<?php 
    include_once("header.php");
    include_once("navAdmin.php")
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Agregar<span>Nuevo cine</span></h2>
        <p>Creacion de un nuevo cine.</p>
    </div>
</div> 

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <div class="form">

                    <form action="<?php echo FRONT_ROOT."Cine/Add" ?>" method="post">

                        <div class="field-wrap">
                            <label class="log-label" for="name">Nombre</label>
                            <input class="log-input" type="text" name="name" required>
                        </div>
                        
                        <div class="field-wrap">
                            <label class="log-label" for="adress">Direccion</label>
                            <input class="log-input" type="text" name="adress"required>
                        </div>

                        <div class="field-wrap">
                            <label class="log-label" for="capacity">Capacidad</label>
                            <input class="log-input" type="number" name="capacity"required>
                        </div>

                        <div class="field-wrap">
                            <label class="log-label" for="value">Tarifa</label>
                            <input class="log-input" type="number" name="value"required>
                        </div>

                        <br><br>

                        <input type=submit class="button button-block" value="añadir">

                    </form>

                </div>

            </div>
        </div>
    </div>
</div> 



<?php include_once("footer.php") ?>