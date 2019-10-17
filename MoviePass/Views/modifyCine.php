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
                                <label class="log-label" for="name">Id</label>
                                <input class="log-input" type="text" name="id"  value="<?php echo $cine->getId(); ?>" required readonly>
                            </div>

                            <div class="field-wrap">
                                <label class="log-label" for="name">Nombre</label>
                                <input class="log-input" type="text" name="name"  value="<?php echo $cine->getName(); ?>"required>
                            </div>

                            <div class="field-wrap">
                                <label class="log-label" for="name">Direccion</label>
                                <input class="log-input" type="text" name="address" value="<?php echo $cine->getAddress(); ?>"required>
                            </div>

                            <div class="field-wrap">
                                <label class="log-label" for="name">Capacidad</label>
                                <input class="log-input" type="number" name="capacity" value="<?php echo $cine->getCapacity(); ?>"required>
                            </div>

                            <div class="field-wrap">
                                <label class="log-label" for="name">Tarifa</label>
                                <input class="log-input" type="number" name="value" value="<?php echo $cine->getValue(); ?>"required>
                            </div>


                            <div class="field-wrap">

                            </div>

                            <input type=submit class="button button-block" value="Modificar">

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

        <!-- ESTO IRIA EN UN FOREACH DE SALAS -->
<br>
<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="address">

                    <div class="fleft">
                        <h3>Sala 1</h3>
                    </div>

                    <div class="fright">
                        <form action="<?php echo FRONT_ROOT."Cine/ShowModifySalaView" ?>">
                            
                            <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $cine->getId() ?>" >Modificar</button>
                    
                        </form>
                    </div>

                    <?php include("movieCarousel.php"); ?>

                </div>
            </div>
        </div>
    </div>
</div> 
    
        <!-------------------------------------->

        <!-- ESTO IRIA EN UN FOREACH DE SALAS -->
<br>
<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="address">
                    
                    <div class="fleft">
                        <h3>Sala 2</h3>
                    </div>

                    <div class="fright">
                        <form action="<?php echo FRONT_ROOT."Cine/ShowModifyView" ?>">
                            
                            <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $cine->getId() ?>" >Modificar</button>
                    
                        </form>
                    </div>

                    <?php include("movieCarousel.php"); ?>

                </div>
            </div>
        </div>
    </div>
</div> 
    
        <!-------------------------------------->

      

<?php
 include('footer.php') 
?>