<?php 
include_once("header.php");
include_once("navUser.php");
?>

<?php 
$rooms=$cine->getRooms();
$room=array_shift($rooms);
$shows=$room->getShows();
$show=array_shift($shows);

?>
<form action="<?php echo FRONT_ROOT."Purchase/CreatePurchase" ?>" method="post">
    <input type="hidden" value="<?php echo $show->getId(); ?>" name="showId" >
    <input type="hidden" value="<?php echo $cine->getValue(); ?>" name="value">
<?php  for($x=0;$x<$room->getCapacity();$x++){?>
    
    <input type="checkbox" name="seats[]" value="<?php echo $x ?>"><?php echo $x ?></option>

<?php } ?>
<button class="optButton optButton-block" type="submit"  >comprar</button>
</form>




<?php 
include_once("footer.php");
?>