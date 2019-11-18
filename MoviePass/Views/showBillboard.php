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

<div  class="box"> 
        <div class="border-right">
                <div class="border-left">
                    <div class="collapsible">
                      <form  method="post">
                        <?php   foreach($genres as $genr) 
                        {   $valor=$genr->getDescription(); ?> 
                                   <label > <input type="checkbox"  name="genreSelect[]"  value= "<?php  echo $valor ?>" ><?php echo $valor ?>  </label>
                                
                        
                        <?php } ?>
                        <br><br>
                        
                       
                      
                        <?php   foreach($array_days as $days) 
                        {  ?> 
                                   <label > <input type="checkbox"  name="daySelect[]"  value= "<?php  echo $days ?>" ><?php echo $days ?>  </label>
                        
                        
                        <?php } ?>
                        



                      <button class="optButton optButton-block" type="submit"  > Actualizar  </button>
                      </form>
                    </div>
                </div>
        </div>
</div>



<?php 
$MoviesWithFilter=array();
  
  
///filtro de generos
if(isset($_POST["genreSelect"]))
{   
   
   $i=0; //posMovie
   $j=0; //pos genreMovie pos i
   $k=0; //pos genreSelect
   $found=0;
 
    while($i<count($Billboard))
    { 
        $genreMovie=$Billboard[$i]->getGenres(); ///genero de la pelicula pos i
           
           while($j<count($genreMovie))
           {
              
                while ($k<count($_POST["genreSelect"]))
                {         
               
                       if( $genreMovie[$j]->getDescription() == $_POST["genreSelect"][$k]){
                         
                       
                        array_push($MoviesWithFilter,$Billboard[$i]);
                             
                      }
                 $k++;
                }
               $k=0;
               $j++;
        }
           $j=0;
           $i++;
    }
}else 
{
    foreach($Billboard as $movie)
    {
       array_push($MoviesWithFilter,$movie);
    }
}
///filtro de dias 
if(!isset($_POST["daySelect"]))
{
       
}
    foreach($MoviesWithFilter as $movie)
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