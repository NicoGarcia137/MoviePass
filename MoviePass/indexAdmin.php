<?php 
    include_once("header.php");
    include_once("navAdmin.php");
?>

<br><br><br><br><br><br><br><br><br><br><br><br><br>

Sats de Funciones Activas con Peliculas Asignadas: <br><br><br>

Cines: <br><br><br>
<?php for($x=0;$x<count($cinesStats['cine']);$x++){ ?>
    Cine: <?php echo $cinesStats['cine'][$x]->getName(); ?> <br>
    Entradas Vendidas: <?php echo $cinesStats['sold'][$x]; ?> <br>
    Entradas No Vendidas: <?php echo $cinesStats['unsold'][$x]; ?> <br>
    <br>
    
<?php } ?>
<br><br>
Peliculas: <br><br>
<?php for($x=0;$x<count($moviesStats['movie']);$x++){ ?>
    Pelicula: <?php echo $moviesStats['movie'][$x]->getName(); ?> <br>
    Entradas Vendidas: <?php echo $moviesStats['sold'][$x]; ?> <br>
    Entradas No Vendidas: <?php echo $moviesStats['unsold'][$x]; ?> <br>
    <br>
    
<?php } ?>



Sats de Funciones de toda la historia con Peliculas Asignadas: <br><br><br>

Cines: <br><br><br>
<?php for($x=0;$x<count($cinesStatsHistory['cine']);$x++){ ?>
    Cine: <?php echo $cinesStatsHistory['cine'][$x]->getName(); ?> <br>
    Entradas Vendidas: <?php echo $cinesStatsHistory['sold'][$x]; ?> <br>
    Entradas No Vendidas: <?php echo $cinesStatsHistory['unsold'][$x]; ?> <br>
    <br>
    
<?php } ?>
<br><br>
Peliculas: <br><br>
<?php for($x=0;$x<count($moviesStatsHistory['movie']);$x++){ ?>
    Pelicula: <?php echo $moviesStatsHistory['movie'][$x]->getName(); ?> <br>
    Entradas Vendidas: <?php echo $moviesStatsHistory['sold'][$x]; ?> <br>
    Entradas No Vendidas: <?php echo $moviesStatsHistory['unsold'][$x]; ?> <br>
    <br>
 
<?php } ?>


<br><br><br><br><br><br><br><br><br>


Dinero Acumulado por Cine <br><br>
<?php for($x=0;$x<count($CinesXMoney['cine']);$x++){ ?>
Cine: <?php echo $CinesXMoney['cine'][$x]->getName(); ?> <br>
Acumulado: $ <?php echo $CinesXMoney['value'][$x]; ?> <br>
<br><br>
<?php } ?>

<br><br><br><br><br><br>

Dinero Acumulado por Pelicula <br><br>
<?php $total=0; for($x=0;$x<count($MoviesXMoney['movie']);$x++){ $total+=$MoviesXMoney['value'][$x]; ?>
Movie: <?php echo $MoviesXMoney['movie'][$x]->getName(); ?> <br>
Acumulado: $ <?php echo $MoviesXMoney['value'][$x];  ?> <br>
<br><br>
<?php } ?>
<br><br>
Total Acumulado = <?php echo $total; ?>


<form action="<?php echo FRONT_ROOT."Home/ShowPurchasesStats"?>" method="post">
                                
<input class="imgButton imgButton-block" type="datetime-local" name="date1" value=""></input>
<input class="imgButton imgButton-block" type="datetime-local" name="date2" value=""></input>
    
<input type=submit class="button button-block" value="Elija Rango de fechas para ver las ganancias">
</form>





<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



<?php include_once("footer.php") ?>


