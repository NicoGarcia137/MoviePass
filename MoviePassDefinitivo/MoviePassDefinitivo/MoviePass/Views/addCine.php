<?php 
    include_once("header.php");
    include_once("navAdmin.php")
?>

<div class="form">

    <h1 class="log-h1" >Agregar un nuevo cine</h1>

    <form action="/" method="">

        <div class="field-wrap">
            <label class="log-label" for="name">Nombre</label>
            <input class="log-input" type="text" name="name" id="">
        </div>
        
        <div class="field-wrap">
            <label class="log-label" for="adress">Direccion</label>
            <input class="log-input" type="text" name="adress" id="">
        </div>

        <div class="field-wrap">
            <label class="log-label" for="capacity">Capacidad</label>
            <input class="log-input" type="text" name="capacity" id="">
        </div>

        <div class="field-wrap">
            <label class="log-label" for="value">Tarifa</label>
            <input class="log-input" type="text" name="value" id="">
        </div>

        <button class="button button-block">Añadir</button>

    </form>

</div>

<?php include_once("footer.php") ?>