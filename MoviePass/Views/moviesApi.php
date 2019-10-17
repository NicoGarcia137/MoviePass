<?php 
include_once("header.php");
include_once("navAdmin.php");

$baseurl="https://image.tmdb.org/t/p/w500";
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Peliculas<span>Disponibles</span></h2>
        <p>Listado de peliculas disponibles para su utilización.</p>
    </div>
</div>

<?php 
    foreach($movies as $movie)
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
                                foreach($movie->getGenre() as $genre)
                                {
                                    echo " -".$genre->getDescripcion();
                                }   
                               
                            ?>

                        </div>

                        

                    </div>

                </div>
            </div>
        </div>
    </div> 
    <br>
<?php  
          
    }
    var_dump($movies);
?>


      

<?php
 include('footer.php') 
?>