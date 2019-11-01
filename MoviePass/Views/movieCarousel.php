
    <!-- Carousel de peliculas
    Todo esto deberia trabajar en un foreach con las peliculas correspondientes -->


<div class="swiper-container">
    <br>
    <div class="swiper-wrapper">

        <div class="swiper-slide">

            <div class="imgBox">
                <a href=""><img src="https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg" alt=""></a>
            </div>  
            <div class="details">
                <h3>Joker</h3>
            </div>

        </div>

        <div class="swiper-slide">

            <div class="imgBox">
                <img src="https://image.tmdb.org/t/p/w500/ePXuKdXZuJx8hHMNr2yM4jY2L7Z.jpg" alt="">
            </div>
            <div class="details">
                    <h3>El Camino: A Breaking Bad Movie</h3>
            </div>

        </div>

        <div class="swiper-slide">

            <div class="imgBox">
                <img src="https://image.tmdb.org/t/p/w500/uTALxjQU8e1lhmNjP9nnJ3t2pRU.jpg" alt="">
            </div>
            <div class="details">
                <h3>Gemini Man</h3>
            </div>
            
        </div>

        <div class="swiper-slide">

            <div class="imgBox">
                <img src="https://image.tmdb.org/t/p/w500/zfE0R94v1E8cuKAerbskfD3VfUt.jpg" alt="">
            </div>
            <div class="details">
                <h3>It Chapter Two</h3>
            </div>
            
        </div>

        <div class="swiper-slide">

            <div class="imgBox">
                <img src="https://image.tmdb.org/t/p/w500/w9kR8qbmQ01HwnvK4alvnQ2ca0L.jpg" alt="">
            </div>
            <div class="details">
                <h3>Toy Story 4</h3>
            </div>
            
        </div>

        <div class="swiper-slide">

            <div class="imgBox">
                <img src="https://image.tmdb.org/t/p/w500/tBuabjEqxzoUBHfbyNbd8ulgy5j.jpg" alt="">
            </div>
            <div class="details">
                <h3>Maleficent: Mistress of Evil</h3>
            </div>
            
        </div>

        <div class="swiper-slide">

            <div class="imgBox">
                <img src="https://image.tmdb.org/t/p/w500/8j58iEBw9pOXFD2L0nt0ZXeHviB.jpg" alt="">
            </div>
            <div class="details">
                <h3>Once Upon a Time... in Hollywood</h3>
            </div>
            
        </div>

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

