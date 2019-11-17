<?php 
include_once("header.php");
include_once("navUser.php"); 
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Seleccionar<span>Butacas</span></h2>
        <p>Selecciona los lugares que deseas reservar.</p>
    </div>
</div> 

<?php 
    $rooms=$cine->getRooms();
    $room=array_shift($rooms);
    $shows=$room->getShows();
    $show=array_shift($shows); 
?>
<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

<form action="<?php echo FRONT_ROOT."Purchase/CreatePurchase" ?>" method="post">

    <input type="hidden" value="<?php echo $show->getId(); ?>" name="showId" >
    <input type="hidden" value="<?php echo $cine->getValue(); ?>" name="value">

    <div>
        <table class="seatsTable">
            <tbody>

                <?php

                $cantButacas = $room->getCapacity();
                $limit = 13;
                $cantFilas = $room->getCapacity()/$limit;
                $x = 0;
                $y = 0;
                $seat = 0;

                // echo "Capacidad:". $room->getCapacity(); 
                // echo "<br>";
                // echo "cantFilas: ". $cantFilas;

                while($x <= $limit && $seat < $cantButacas && $y <= $cantFilas){

                    if($x == $limit){

                        $x = 0;
                        echo "<tr></tr>";
                        
                        $y++;
                    }

                    if($x == 2 || $x == 11 ){

                    ?> 
                        <td> <img class="stairs" src="<?php echo FRONT_ROOT?>Views/images/stairsHD.png"> </td>

                        <td> 
                            <label class="checkeable" >

                            <?php if(!in_array($seat,$OccupiedSeats)){ 
                                         if(isset($_SESSION['failPurchase']) && $_SESSION['failPurchase'][0]->getId()==$show->getId() && in_array($seat,$_SESSION['failPurchase'][2])){ ?>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat ?>" checked required> 
                                    <?php }else{ ?>  
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat ?>"required> 
                                    <?php } ?>
                                    <img class="seat" src="<?php echo FRONT_ROOT?>Views/images/butaca-cerrada.png" alt="">
                                <?php }else{ ?>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat ?>" disabled required> 
                                    <img class="seat" src="<?php echo FRONT_ROOT?>Views/images/butaca-abierta-lock.png" alt="">
                                <?php } ?>

                            </label>
                        </td> 
                        
                        <?php
        
                    }else{
        
                        ?> 
                        
                        <td> 
                            <label class="checkeable" >

                            <?php if(!in_array($seat,$OccupiedSeats)){  
                                         if(isset($_SESSION['failPurchase']) && $_SESSION['failPurchase'][0]->getId()==$show->getId() && in_array($seat,$_SESSION['failPurchase'][2])){ ?>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat ?>" checked required> 
                                    <?php }else{ ?>  
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat ?>" required> 
                                    <?php } ?>
                                    <img class="seat" src="<?php echo FRONT_ROOT?>Views/images/butaca-cerrada.png" alt="">
                                <?php }else{ ?>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat ?>" disabled required> 
                                    <img class="seat" src="<?php echo FRONT_ROOT?>Views/images/butaca-abierta-lock.png" alt="">
                                <?php } ?>

                            </label>
                        </td> 
                        
                        <?php
                    }
                    $x++;
                    $seat++;
                }

                ?>

            </tbody>
        </table>
    </div>

    <br><br>

    <div class="field-wrap">
        <button class="optButton optButton-block" type="submit"  >Seleccionar</button>
    </div>
    </div>
        </div>
    </div>
</div> 

</form>
