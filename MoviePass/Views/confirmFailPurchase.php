<?php 
    include_once("header.php");
    include_once("navUser.php");
    $baseurl="https://image.tmdb.org/t/p/w500";

    if(isset($_SESSION['failPurchase'])){
        $show=$_SESSION['failPurchase'][0];
        $value=$_SESSION['failPurchase'][1];
        $seats=$_SESSION['failPurchase'][2];
    }else{
        header("location:../index.php");
    }
?>

<div class="box">

    <div class="inner">

        <h2>AVISO:</h2>
        <h3>Previo a su inicio de sesion, usted tenia una compra en curso<h3>


        <div class="form" >

            <div class="movieText">
               
                <span>Pelicula: </span><?php echo $show->getMovie()->getName(); ?><br>
                <span>Fecha:</span> <?php echo $show->getDateTime()->format('Y-m-d'); ?><br>
                <span>Hora:</span> <?php echo $show->getDateTime()->format('H:i'); ?><br>
                <span>Cantidad de entradas: </span><?php echo count($seats);  ?><br>
                <span>Butacas:</span> <?php echo implode("-",$seats) ?><br>
                <span>Valor Final: </span>$<?php echo $value*count($seats);?> <br>
          
            </div>
        </div>

        <h3>Desea continuarla?  </h3>
        <div class="form">
            <form  action="<?php echo FRONT_ROOT."Purchase/ShowPurchaseView" ?>" method="post">

                <input type="hidden" value="<?php echo $show->getId() ?>" name="showId" >
            
                <button class="optButton optButton-block" type="submit"  > Confirmar</button>
            </form>
            <br>
            <form  action="<?php echo FRONT_ROOT."Purchase/AbortPurchase" ?>">
                <button class="optButton optButton-block" type="submit"  > Cancelar</button>
            </form>
        </div>
    </div>

</div> 

        

    
            






<?php include_once("footer.php") ?>