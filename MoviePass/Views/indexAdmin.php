<?php 
    include_once("header.php");
    include_once("navAdmin.php");
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Informacion<span>del sistema</span></h2>
        <p>Listado de cines disponibles para su utilización.</p>
    </div>
</div>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="address">

                    <h4><span>Info funciones activas</span></h4><br>

                    <div class="left" >
                        <button type="button" class="infoCollapsible" > <span>Cines</span> </button>
                        <div class="infoBox" >
                            <hr>
                            <?php for($x=0;$x<count($cinesStats['cine']);$x++){ ?>
                                <h5><?php echo $cinesStats['cine'][$x]->getName(); ?> </h5>
                                <span>Entradas Vendidas:</span> <?php echo $cinesStats['sold'][$x]; ?> <br>
                                <span>Entradas No Vendidas:</span> <?php echo $cinesStats['unsold'][$x]; ?> <br>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="right" >
                        <button type="button" class="infoCollapsible" > <span>Peliculas</span> </button>
                        <div class="infoBox" >
                            <hr>
                            <?php for($x=0;$x<count($moviesStats['movie']);$x++){ ?>
                                <h5><?php echo $moviesStats['movie'][$x]->getName(); ?> </h5>
                                <span>Entradas Vendidas:</span> <?php echo $moviesStats['sold'][$x]; ?> <br>
                                <span>Entradas No Vendidas:</span> <?php echo $moviesStats['unsold'][$x]; ?> <br>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div> 

<br>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="address" >

                    <h4><span>Info historica funciones</span></h4><br>

                    <div class="left">
                        <button type="button" class="infoCollapsible" > <span>Cines</span> </button>
                        <div class="infoBox" >
                            <hr>
                            <?php for($x=0;$x<count($cinesStatsHistory['cine']);$x++){ ?>
                                <h5><?php echo $cinesStatsHistory['cine'][$x]->getName(); ?> </h5>
                                <span>Entradas Vendidas:</span> <?php echo $cinesStatsHistory['sold'][$x]; ?> <br>
                                <span>Entradas No Vendidas:</span> <?php echo $cinesStatsHistory['unsold'][$x]; ?> <br>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="right">
                        <button type="button" class="infoCollapsible" > <span>Peliculas</span> </button>
                        <div class="infoBox" >
                            <hr>
                            <?php for($x=0;$x<count($moviesStatsHistory['movie']);$x++){ ?>
                                <h5><?php echo $moviesStatsHistory['movie'][$x]->getName(); ?> </h5>
                                <span>Entradas Vendidas:</span> <?php echo $moviesStatsHistory['sold'][$x]; ?> <br>
                                <span>Entradas No Vendidas:</span> <?php echo $moviesStatsHistory['unsold'][$x]; ?> <br>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> 

<br>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="address" >

                    <h4><span>Ventas</span></h4><br>

                    <div class="left" >
                        <button type="button" class="infoCollapsible" > <span>Cines</span> </button>
                        <div class="infoBox" >
                            <hr>
                            <?php for($x=0;$x<count($CinesXMoney['cine']);$x++){ ?>
                            <h5><?php echo $CinesXMoney['cine'][$x]->getName(); ?> </h5>
                            <span>Ventas:</span> $ <?php echo $CinesXMoney['value'][$x]; ?> <br>
                            <hr>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="right" >
                        <button type="button" class="infoCollapsible" > <span>Peliculas</span> </button>
                        <div class="infoBox" >
                            <hr>
                            <?php $total=0; for($x=0;$x<count($MoviesXMoney['movie']);$x++){ $total+=$MoviesXMoney['value'][$x]; ?>
                            <h5> <?php echo $MoviesXMoney['movie'][$x]->getName(); ?> </h5>
                            <span>Ventas:</span> $ <?php echo $MoviesXMoney['value'][$x];  ?> <br>
                            <hr>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <br>
                <div class="field-wrap">
                    <span>Total <h3>$ <?php echo $total; ?></h3></span>
                </div>
                
                <div class="form">
                    <span>Seleccionar periodo de ventas</span>
                    <hr><br>
                    <form action="<?php echo FRONT_ROOT."Home/ShowPurchasesStats"?>" method="post">

                        <div class="fleft">
                            <input class="imgButton imgButton-block" type="datetime-local" name="date1" value=""></input>
                            
                        </div>

                        <div class="fleft">
                            > ><br>> ><br>> >
                        </div>

                        <div class="fleft">
                            <input class="imgButton imgButton-block" type="datetime-local" name="date2" value=""></input>
                        </div>

                        <div class="fright">
                            <input type=submit class="optButton optButton-block" value="Seleccionar">
                        </div>
                        <br> 
                        
                    </form>
                </div>
                

            </div>
        </div>
    </div>
</div> 


<script>
    var coll = document.getElementsByClassName("modifyCollapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        } 
    });
    }
</script>

<script>
    var coll = document.getElementsByClassName("infoCollapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        } 
    });
    }
</script>


<?php include_once("footer.php") ?>


