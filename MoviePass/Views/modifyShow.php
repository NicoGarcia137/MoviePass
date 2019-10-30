<?php 
    include_once("header.php");
    include_once("navAdmin.php");
    $baseurl="https://image.tmdb.org/t/p/w500";
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Show<span>Modify</span></h2>
        <p>Modificacion de la funcion seleccionada.</p>
    </div>
</div>

<?php 
    foreach($billboard as $movie)
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

                        

                </div>

                <form action="Show/ModifyShow" method="post">

                

                </form>

            </div>
        </div>
    </div>
</div>
<br>

<?php  
          
    }
?>



<?php include_once("footer.php") ?>