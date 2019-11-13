<?php 
include_once("header.php");
include_once("navAdmin.php");
$baseurl="https://image.tmdb.org/t/p/w500";
$emptyImg="https://media.licdn.com/dms/image/C560BAQHvjs3O4Utmdw/company-logo_200_200/0?e=2159024400&v=beta&t=qdZJ4JLDc4N_esDRR0m2L6_qz27N2KKhi9yP5-LtAFA";
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Modificar<span>Sala</span></h2>
        <p>Modificacion de las funciones de la sala seleccionada.</p>
    </div>
</div>


<br>
    <h3>Sala : <span><?php echo $room->getName() ?></span></h3>

    <table class="calendarTable">
        <thead>
            <tr>
                <th></th>
                <th scope="col" abbr="Starter">Lunes</th>
                <th scope="col" abbr="Medium">Martes</th>
                <th scope="col" abbr="Business">Miercoles</th>
                <th scope="col" abbr="Deluxe">Jueves</th>
                <th scope="col" abbr="Deluxe">Viernes</th>
                <th scope="col" abbr="Deluxe">Sabado</th>
                <th scope="col" abbr="Deluxe">Domingo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">10:00</th>
                <?php foreach($room->getShows() as $show){ 
                    $date=$show->getDateTime();
                    if($date->format('H:i')==="10:00"){
                         ?>
                <td>
                    <div class="imgBox">
                        

                    <form action="<?php echo FRONT_ROOT."Show/ModifyShow" ?>" method="post">
                            
                            <input type="hidden" value="<?php echo $show->getId(); ?>" name="Id" >
                            <input type="hidden" name="MovieId" value="<?php echo null ?>">
                            <input type="hidden" value="100" name="Tickets">
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
                    <?php }} ?>
            </tr>
            <tr>
                <th scope="row">15:00</th>
                <?php foreach($room->getShows() as $show){ 
                    $date=$show->getDateTime();
                    if($date->format('H:i')==="15:00"){ 
                        ?>
                <td>
                <div class="imgBox">

                    <form action="<?php echo FRONT_ROOT."Show/ModifyShow" ?>" method="post">
                            
                            <input type="hidden" value="<?php echo $show->getId(); ?>" name="Id" >
                            <input type="hidden" name="MovieId" value="<?php echo null ?>">
                            <input type="hidden" value="100" name="Tickets">
                            <button class="optButton optButton-block" type="submit"  >X</button>

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
                <?php }} ?>              
            </tr>
            <tr>
                <th scope="row">20:00</th>
                <?php foreach($room->getShows() as $show){ 
                    $date=$show->getDateTime();
                    if($date->format('H:i')==="20:00"){ ?>
                <td>
                <div class="imgBox">

                    <form action="<?php echo FRONT_ROOT."Show/ModifyShow" ?>" method="post">
                            
                            <input type="hidden" value="<?php echo $show->getId(); ?>" name="Id" >
                            <input type="hidden" name="MovieId" value="<?php echo null ?>">
                            <input type="hidden" value="100" name="Tickets">
                            <button class="optButton optButton-block" type="submit"  >X</button>

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
                <?php }} ?>             
            </tr>
            
        </tbody>
    </table>
    


<?php
 include('footer.php') 
?>