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
                                <form action="<?php echo FRONT_ROOT."Purchase/ShowPurchaseView" ?>" method="post">
                                <input value="<?php echo $show->getId(); ?>" name="showId" >
                                <button class="optButton optButton-block" type="submit"  ><?php echo $show->getDateTime()->format('H:i')?></button>

                                
                                </form>

                        
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