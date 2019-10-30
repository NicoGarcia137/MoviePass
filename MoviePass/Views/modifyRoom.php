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

            <h3>Sala <?php echo $room->getId() ?></h3>

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

                                <form action="<?php echo FRONT_ROOT."Show/ShowModifyView"?>" method="post">
                                <input type="submit" name="show" value="<?php echo $show->getId();?>" ><img src="<?php if($show->getMovie() != null)
                                                                                                                        {echo $show->getMovie()->getImage();
                                                                                                                        }else{  
                                                                                                                            echo "https://media.licdn.com/dms/image/C560BAQHvjs3O4Utmdw/company-logo_200_200/0?e=2159024400&v=beta&t=qdZJ4JLDc4N_esDRR0m2L6_qz27N2KKhi9yP5-LtAFA";
                                                                                                                            }  ?>" alt="">

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
                            if($show->getDateTime()==="15:00"){ ?>
                        <td>
                            <div class="imgBox">
                            <form action="<?php echo FRONT_ROOT."Show/ShowModifyView"?>" method="post">
                                <input type="submit" name="show" value="<?php echo $show->getId();?>" ><img src="<?php if($show->getMovie() != null)
                                                                                                                        {echo $show->getMovie()->getImage();
                                                                                                                        }else{  
                                                                                                                            echo "https://media.licdn.com/dms/image/C560BAQHvjs3O4Utmdw/company-logo_200_200/0?e=2159024400&v=beta&t=qdZJ4JLDc4N_esDRR0m2L6_qz27N2KKhi9yP5-LtAFA";
                                                                                                                            }  ?>" alt="">

                                </form>
                            </div>  
                            <div class="details">
                                <h3><?php if($show->getMovie() != null)
                                            {echo $show->getMovie()->getName();
                                            }else{  
                                                echo "No Asignado";
                                                }  ?></h3>
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
                            <form action="<?php echo FRONT_ROOT."Show/ShowModifyView"?>" method="post">
                                <input type="submit" name="show" value="<?php echo $show->getId();?>" ><img src="<?php if($show->getMovie() != null)
                                                                                                                        {echo $show->getMovie()->getImage();
                                                                                                                        }else{  
                                                                                                                            echo "https://media.licdn.com/dms/image/C560BAQHvjs3O4Utmdw/company-logo_200_200/0?e=2159024400&v=beta&t=qdZJ4JLDc4N_esDRR0m2L6_qz27N2KKhi9yP5-LtAFA";
                                                                                                                            }  ?>" alt="">

                                </form>
                            </div>  
                            <div class="details">
                                <h3><?php if($show->getMovie() != null)
                                            {echo $show->getMovie()->getName();
                                            }else{  
                                                echo "No Asignado";
                                                }  ?></h3>
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