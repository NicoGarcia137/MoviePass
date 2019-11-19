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