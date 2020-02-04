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

                <button type="button" class="modifyCollapsible" > <span>Cine info</span> </button>

                <div class="modifyBox" >

                    <div class="address">

                        <div class="form">

                            <form action="<?php echo FRONT_ROOT."Cine/ModifyCine" ?>" method="post">
                            
                                <input class="log-input" type="hidden" name="id"  value="<?php echo $cine->getId(); ?>" required readonly>

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Nombre</label>
                                    <input class="log-input" type="text" name="name"  value="<?php echo $cine->getName(); ?>"required>
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Direccion</label>
                                    <input class="log-input" type="text" name="address" value="<?php echo $cine->getAddress(); ?>"required>
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" for="name">Tarifa</label>
                                    <input class="log-input" type="number" name="value" min="0" value="<?php echo $cine->getValue(); ?>"required>
                                </div>
                                <br>
                                <input type=submit class="button button-block" value="Modificar">
                                
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <button type="button" class="modifyCollapsible" > <span>Añadir sala</span> </button>

                <div class="modifyBox" >

                    <div class="address">

                        <div class="form">

                            <form action="<?php echo FRONT_ROOT."Room/AddRoom" ?>" method="post">
                                <div class="field-wrap">
                                    <label class="log-label" for="name">Capacidad</label>
                                    <input class="log-input" type="number" name="Capacity" min="0" value=""required>    
                                </div>
                                
                                <div class="field-wrap">
                                    <label class="log-label" for="name">Nombre</label>
                                    <input class="log-input" type="text" name="Name" value=""required>
                                </div>
                                <br>
                                <button class="button button-block" type="submit" name="CineId" value="<?php echo $cine->getId() ?>" >Agregar sala</button>
                            
                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

   
<?php 
$rooms= $cine->getRooms();
foreach($rooms as $room){


?>
<!-- ESTO IRIA EN UN FOREACH DE SALAS -->
<br>
<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <button type="button" class="modifyCollapsible" > <span><?php echo $room->getName() ?></span> </button>

                <div class="modifyBox" >

                    <div class="address">
                        <div class="fleft" >
                        <br>
                        <span>Capacidad: <?php echo $room->getCapacity() ?></span>
                        </div>

                
                        <!-- <div class="fleft">
                            <h3>Sala: <?php echo $room->getName() ?></h3>
                        </div> -->

                        <div class="fright">
                            <form action="<?php echo FRONT_ROOT."Room/ShowModifyRoomView" ?>">
                                
                                <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $room->getId() ?>" >Administrar</button>

                            </form>
                            <br>
                            <form action="<?php echo FRONT_ROOT."Room/RemoveRoom" ?>">
                                <input type="hidden" name="cineid" value="<?php echo $cine->getId(); ?>">
                                <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $room->getId() ?>" >Eliminar</button>

                            </form>
                        </div>

                        <?php 
                        $carousel=[];
                            foreach($room->getShows() as $show){
                                if($show->getMovie()!=null){
                                    array_push($carousel,$show->getMovie());
                                }
                            }
                        
                            if(!empty($carousel)){
                                include("movieCarousel.php");
                            }
                        ?>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> 

<?php 
    }
?>   
      

<script>
    var coll = document.getElementsByClassName("modifyCollapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        } 
    });
    }
</script>

      

<?php
 include('footer.php') 
?>