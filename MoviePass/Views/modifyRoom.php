<?php 
include_once("header.php");
include_once("navAdmin.php");

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

            <h3>Sala <h3><?php echo $room->getId() ?></h3></h3>

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
                            if($show->getDateTime()==="10:00"){ ?>
                        <td>
                            <div class="imgBox">
                                <img src="<?php echo $show->getMovie()->getImage(); ?>" alt="">
                            </div>  
                            <div class="details">
                                <h3><?php echo $show->getMovie()->getName(); ?></h3>
                            </div>
                        </td>
                            <?php }} ?>
                    </tr>
                    <tr>
                        <th scope="row">15:00</th>
                        <?php foreach($room->getShows() as $show){ 
                            if($show->getDateTime()==="15:00"){ ?>
                        <td>
                            <div class="imgBox">
                                <img src="<?php echo $show->getMovie()->getImage(); ?>" alt="">
                            </div>  
                            <div class="details">
                                <h3><?php echo $show->getMovie()->getName(); ?></h3>
                            </div>
                        </td>    
                        <?php }} ?>                 
                    </tr>
                    <tr>
                        <th scope="row">20:00</th>
                        <?php foreach($room->getShows() as $show){ 
                            if($show->getDateTime()==="20:00"){ ?>
                        <td>
                            <div class="imgBox">
                                <img src="<?php echo $show->getMovie()->getImage(); ?>" alt="">
                            </div>  
                            <div class="details">
                                <h3><?php echo $show->getMovie()->getName(); ?></h3>
                            </div>
                        </td>     
                        <?php }} ?>                
                    </tr>
                    
                </tbody>
            </table>
            
            </div>
        </div>
    </div>
</div> 

<?php
 include('footer.php') 
?>