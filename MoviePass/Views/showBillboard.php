<?php 
    include_once("header.php");
    include_once("navUser.php");
    $baseurl="https://image.tmdb.org/t/p/w500";

?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Cartelera</h2>
        <p>Seleccione la pelicula que desea ver</p>
    </div>
</div>


</br></br>
Filtrar Por Fecha
<form action="<?php echo FRONT_ROOT."Billboard/GetAllMoviesInshowsByDateTime" ?>" method="post">
            <select name="date" required>
                <?php $date=new DateTime(); for($x=0;$x<7;$x++){ ?> 
                    <option value="<?php echo $date->format('Y-m-d');?>"><?php echo $this->translator($date);  ?></option> 
              <?php $date->modify('+1 day');   }  ?>   
            </select>        

        <input type=submit class="optButton optButton-block">
</form>
</br>

Filtrar Por Genero
<form action="<?php echo FRONT_ROOT."Billboard/GetAllMoviesInshowsByGenre" ?>" method="post">
<?php   foreach($genres as $genre){ ?>
            <?php echo $genre->getDescription() ?> <input  type="checkbox" name="genres[]" value="<?php echo $genre->getId() ?>">
 <?php     } ?>
 <input type=submit class="optButton optButton-block">
</form>



<?php 
    foreach($Billboard as $movie)
    {
?>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <div class="address">

                    <div class="fleft">
                        <img class="movieImg" src="<?php echo $baseurl . $movie->getImage() ?>" alt="">
                    </div>

                    <div class="movieText">

                        <span>Nombre:</span> <?php echo $movie->getName(); ?> <br>
                        <span>Duracion:</span> <?php echo $movie->getDuration(); ?> <br>
                        <span>Lenguage:</span> <?php echo $movie->getLanguage(); ?> <br>
                        <span>Genero:</span>   
                        <?php 
                            foreach($movie->getGenres() as $genre)
                            {
                                echo " -".$genre->getDescription();
                            }   
                        ?>
                    </div>

                    <div class="fright">
                        <form action="<?php echo FRONT_ROOT."Cine/ShowCinesAndShowsByMovie" ?>" method="post">
                            
                            <button class="optButton optButton-block" type="submit" name="MovieId" value="<?php echo $movie->getId() ?>"  >Seleccionar</button>

                        </form>
                    </div>
                </div>

                <!-- Crear un formulario similar al del boton, pero con el value de MovieId en null para el 'eliminar' -->

                

            </div>
        </div>
    </div>
</div>
<br>

<?php  
          
    }
?>



<?php include_once("footer.php") ?>