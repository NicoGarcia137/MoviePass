<?php 
    include_once("header.php");
    include_once("navUser.php");

    if(isset($_SESSION['failPurchase'])){
        $show=$_SESSION['failPurchase'][0];
        $value=$_SESSION['failPurchase'][1];
        $seats=$_SESSION['failPurchase'][2];
    }else{
        header("location:../index.php");
    }
?>

<br>
        <h3>Antes de loguearse le quedo una compra pendiente para la siguiente funcion: <h3><br>
        <h3>Pelicula: <?php echo $show->getMovie()->getName(); ?></h3>
        <h3>Fecha: <?php echo $show->getDateTime()->format('Y-m-d'); ?></h3>
        <h3>Hora: <?php echo $show->getDateTime()->format('H:i'); ?></h3>
        <h3>Asientos: <?php foreach($seats as $seat){ echo "/".$seat;} echo "/" ?></h3>
        <h3>Valor: <?php echo $value*count($seats); ?></h3>
        <h3>Desea continuarla?  </h3><br>
        <form action="<?php echo FRONT_ROOT."Purchase/ShowPurchaseView" ?>" method="post">

            <input type="hidden" value="<?php echo $show->getId() ?>" name="showId" >
            
            <button class="optButton optButton-block" type="submit"  > Confirmar</button>
        </form>

    
            

<br>




<?php include_once("footer.php") ?>