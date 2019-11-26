<?php 
include_once("header.php");
include_once("navAdmin.php");
$baseurl="https://image.tmdb.org/t/p/w500";
$emptyImg="https://media.licdn.com/dms/image/C560BAQHvjs3O4Utmdw/company-logo_200_200/0?e=2159024400&v=beta&t=qdZJ4JLDc4N_esDRR0m2L6_qz27N2KKhi9yP5-LtAFA";
$dates=[];
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Modificar<span>Sala</span></h2>
        <p>Modificacion de las funciones de la sala seleccionada.</p>
    </div>
</div>


<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

        

                <button type="button" class="modifyCollapsible" > <span>Sala info</span> </button>

                <div class="modifyBox" >

                    <div class="address">
                        <div class="form">
                            <form action="<?php echo FRONT_ROOT."Room/ModifyRoom" ?>" method="post">
                                    
                                <input class="log-input" type="hidden" name="id"  value="<?php echo $room->getId(); ?>" required readonly>
                                <div class="field-wrap">
                                    <label class="log-label" for="name">Nombre</label>
                                    <input class="log-input" type="text" name="name"  value="<?php echo $room->getName(); ?>"required>
                                </div>
                                <div class="field-wrap">
                                    <label class="log-label" for="name">Direccion</label>
                                    <input class="log-input" type="text" name="capacity" value="<?php echo $room->getCapacity(); ?>"required>
                                </div>
                                <div class="field-wrap">
                                    <input type=submit class="button button-block" value="Modificar">
                                </div>
                                
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



</br></br>
    
<table class="calendarTable">
    <thead>
        <tr>
            <th></th>
            <?php 
            
            $date=new DateTime(); 
            for($x=0;$x<7;$x++){ ?>

                <th scope="col" abbr="Starter"><?php echo Translator::Translate($date); ?></th>

            <?php 
                $date->modify('+1 day');  
            } ?>
        </tr>
    </thead>
    <tbody>
        
    <?php 
        foreach($room->getShows() as $show){
            $x=false; 
            $date=$show->getDateTime();     
            
            if(!in_array($date->format('H:i'),$dates)){
                $x=true;
                array_push($dates,$date->format('H:i')); ?>
                <tr>
                <th scope="row"><?php echo $date->format('H:i'); ?></th>
                        
            <?php 
            }
            ?>

            <td>  

            <?php   
            
            foreach($dates as $dateValue){ 
                if($date->format('H:i')==$dateValue){ ?>
            
                    <div class="imgBox">
                
                        <form action="<?php echo FRONT_ROOT."Show/ModifyShow" ?>" method="post"> 
                            <input type="hidden" value="<?php echo $show->getId(); ?>" name="Id" >
                            <input type="hidden" name="MovieId" value="<?php echo null ?>">
                            <button class="optButton optButton-block" type="submit"  >X</button>
                            <br>
                        </form>

                        <form action="<?php echo FRONT_ROOT."Show/ShowModifyView"?>" method="post">
                        
                            <button type="submit" name="show" value="<?php echo $show->getId();?>">
                                <a href="">
                                    <img src="<?php if($show->getMovie() != null)
                                                    {
                                                        echo $baseurl . $show->getMovie()->getImage();
                                                    }else{  
                                                        echo $emptyImg;
                                                    }  ?>" alt="">
                                </a>
                            </button>

                        </form>

                    </div>

                    <div class="details">
                        <h3><?php if($show->getMovie() != null)
                                    {echo $show->getMovie()->getName();
                                    }else{  
                                        echo "No Asignado";
                                    } ?></h3>
                    </div>
            </td>
        
                <?php
                }
            }
        } ?>
    </tbody>
</table>

</br></br>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <button type="button" class="modifyCollapsible" > <span>Horarios</span> </button>

                <div class="modifyBox" >

                    <div class="address">
                        <div class="form">

                            <form action="<?php echo FRONT_ROOT."Show/AddShowTime" ?>" method="post">
                                                
                                <input class="log-input" type="hidden" name="roomId"  value="<?php echo $room->getId(); ?>" required readonly>
                                    
                                <label class="log-label" for="name">Hora de funcion</label>
                                <div class="field-wrap">
                                    <input type="time" name="time" step="60" required>
                                </div>

                                <div class="field-wrap">

                                    <input class="log-input" type="hidden" name="cineId"  value="<?php echo $room->getCine()->getId(); ?>" required readonly>

                                    <input type=submit class="button button-block" value="Agregar Horario">

                                </div>

                            </form>

                            </br></br></br></br> 

                            <?php foreach($dates as $date){  ?>

                                <form action="<?php echo FRONT_ROOT."Show/RemoveShowtime" ?>" method="post">
                                        <input type="hidden" value="<?php echo $date; ?>" name="time" >
                                        <input type="hidden" name="cineId" value="<?php echo $room->getCine()->getId(); ?>">
                                        <input type="hidden" name="roomId" value="<?php echo $room->getId(); ?>">
                                        <button class="optButton optButton-block" type="submit"  >Eliminar Horario / <?php echo $date; ?> / de todo el cine</button>
                                </form>
                                </br>

                            <?php }  ?>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



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