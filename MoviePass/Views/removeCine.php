<?php 
    include_once("header.php");
    include_once("navAdmin.php")
?>

<div class="form">

    <h1 class="log-h1" >Eliminar un nuevo cine</h1>

    <form action="<?php echo FRONT_ROOT."Cine/RemoveCine" ?>" method="post">

        <div class="field-wrap">
            <label class="log-label" for="name">Nombre</label>
            <input class="log-input" type="text" name="name" id="">
        </div>
        

        <input type=submit class="button button-block" value="Elminar">

    </form>

</div>
<?php include_once("footer.php") ?>