<?php 
    include_once("header.php");
    include_once("navUser.php");
    $baseurl="https://image.tmdb.org/t/p/w500";
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Funciones<span>Disponibles</span></h2>
        <p><?php echo $Movie->getName()?></p>
    </div>
</div>

    <?php 
        foreach($cinesAndShows as $Cine)
        {
        ?>
            <div class="box">
                <div class="border-right">
                    <div class="border-left">
                        <div class="inner">

                            <h2>Cine <span><?php echo $Cine->getName(); ?></span></h2><br>

                            <?php 
                                foreach($Cine->getRooms() as $room){
                            ?>
                            
                            <h3> Sala <span> <?php echo $room->getId(); ?> </span></h3>
                            
                            <span><h4> Horarios </h4></span>|
                            
                            <?php 
                                foreach($room->GetShows() as $show){
                            ?>

                            <span><?php echo $show->getDateTime() ?> | </span>

                        
                            <?php     
                                    }
                            ?> 

                            <br><br><br>

                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div> <br>
        <?php
        }
        ?>
            

<br>




<?php include_once("footer.php") ?>