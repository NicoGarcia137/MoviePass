
<?php 
    $baseurl="https://image.tmdb.org/t/p/w500"; ?>

<div class="swiper-container">
    <br>
    <div class="swiper-wrapper">
        <?php foreach($carousel as $movie){  ?>
        <div class="swiper-slide">

            <div class="imgBox">
            
            <form action="<?php echo FRONT_ROOT."Cine/ShowCinesAndShowsByMovie"?>" method="post">
                        
                            <button type="submit" name="show" value="<?php echo $movie->getId();?>">
                                <a href="">
                                    <img src="<?php echo $baseurl . $movie->getImage();?>"alt="">          
                                </a>
                            </button>

                        </form>
                
            </div>  
            <div class="details">
                <h3><?php echo $movie->getName(); ?></h3>
            </div>

        </div>
        <?php } ?>


    </div>

    <!-- Add Pagination -->
    <br>
    <div class="swiper-pagination"></div>

    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

</div>

<!-- Swiper JS -->
<script type="text/javascript" src="<?php echo JS_PATH;?>swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
    slidesPerView: 3,
    spaceBetween: 20,
    slidesPerGroup: 3,
    loop: true,
    loopFillGroupWithBlank: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    });
</script>

