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
                                    $shows=$room->getShows();
                                    $y=count($shows);
                                    $x=0;
                                    while($x<$y){
                                        $dateTime=$shows[$x]->getDateTime()->format('Y-m-d');
                                        ?>
                                        <h2>Fecha <span><?php echo $shows[$x]->getDateTime()->format('Y-m-d'); ?></span></h2><br>

                                        <?php while($x<$y&&$shows[$x]->getDateTime()->format('Y-m-d')==$dateTime){ ?>

                                            <form action="<?php echo FRONT_ROOT."Purchase/ShowPurchaseView" ?>" method="post">
                                            <input type="hidden" value="<?php echo $shows[$x]->getId(); ?>" name="showId" >
                                            <button class="optButton optButton-block" type="submit"  ><?php echo $shows[$x]->getDateTime()->format('H:i')?></button>
                                            </form>

                            <?php 
                                        $x++;
                                        }
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