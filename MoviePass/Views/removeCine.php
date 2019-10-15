<?php 
    include_once("header.php");
    include_once("navAdmin.php")
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Eliminar<span>Cine</span></h2>
        <p>Remover un cine de los actualmente cargados.</p>
    </div>
</div> 


<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <div class="form">

                    <form action="<?php echo FRONT_ROOT."Cine/RemoveCine" ?>" method="post">

                        <div class="field-wrap">
                            <label class="log-label" for="name">Nombre</label>
                            <input class="log-input" type="text" name="name" required>
                        </div>
                        

                        <input type=submit class="button button-block" value="Elminar">

                    </form>

                </div>

            </div>
        </div>
    </div>
</div> 


<?php include_once("footer.php") ?>