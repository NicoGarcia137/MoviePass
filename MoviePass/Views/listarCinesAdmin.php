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

                    <button type="button" class="modifyCollapsible" > <span><?php echo $cine->getName() ?></span> </button>

                    <div class="modifyBox" >

                        <div class="address">

                            <div class="fleft">
                                <br>
                                <div class="cineText">
                                    <span>Nombre:</span> <?php echo $cine->getName() ?> <br>
                                    <span>Direccion:</span> <?php echo $cine->getAddress() ?> <br>
                                    <span>Capacidad:</span> <?php echo $cine->getCapacity() ?> <br>
                                    <span>Tarifa:</span> <?php echo "$" . $cine->getValue() ?>
                                    
                                </div>
                                <br><br>
                                <h3><span>Peliculas</span>disponibles</h3> 
                                

                            </div>

                            <div class="fright">

                                <br><br>
                                
                                <form action="<?php echo FRONT_ROOT."Cine/ShowModifyView" ?>">
                            
                                    <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $cine->getId() ?>" >Administrar</button>
                            
                                </form>

                                <br>
                            
                                <form action="<?php echo FRONT_ROOT."Cine/RemoveCine" ?>">
                            
                                    <button class="optButton optButton-block" type="submit" name="id" value="<?php echo $cine->getId() ?>" >Eliminar</button>
                            
                                </form>

                            </div>

                            <?php 
                            $carousel=[];
                            foreach($cine->getRooms() as $room){
                                foreach($room->getShows() as $show){
                                    if($show->getMovie()!=null){
                                        array_push($carousel,$show->getMovie());
                                    }
                                }
                            }
                            
                            include("movieCarousel.php"); ?>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <br>
        
<?php    }  ?>

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