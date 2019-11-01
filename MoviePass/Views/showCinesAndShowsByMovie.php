<?php 
    include_once("header.php");
    include_once("navUser.php");
    $baseurl="https://image.tmdb.org/t/p/w500";
?>

<div id="signupSlogan">
    <div class="inside">
        <h2><?php echo $Movie->getName()?></h2>
        <p>Funciones donde pasan esta peli: </p>
    </div>
</div>

<?php 
    foreach($cinesAndShows as $Cine)
    {
?>
    Cine: <?php echo $Cine->getName() ; ?>
    <br>
    <?php foreach($Cine->getRooms() as $room){
            foreach($room->GetShows() as $show){
     ?>
      -Show: <?php echo $show->getDateTime() ?>


<?php     
    }}}
?>



<?php include_once("footer.php") ?>