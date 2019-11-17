<?php

use Models\Usuario as User;

if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol()->getDescripcion()=="admin"){
  header("location: ".FRONT_ROOT."Home/indexAdmin");
}
?>

<div class="row-2">
          <ul>
            <li><a href="<?php echo FRONT_ROOT."Home/index" ?>">Home</a></li>
            <li><a href="<?php echo FRONT_ROOT."Cine/ShowListCinesView" ?>">Cines</a></li>
            <li><a href="<?php echo FRONT_ROOT."Billboard/ShowMoviesInShows" ?>">Cartelera</a></li>
            <li><a href="<?php echo FRONT_ROOT."Purchase/ShowUserPurchases" ?>">Compras</a></li>
            <li class="last"><a href="#">Sitemap</a></li>
          </ul>
        </div>
      </div>
      <?php if(isset($_SESSION['errorMessage'])){ ?>
                <div class="error"><b> <?php echo $_SESSION['errorMessage'] ?> </b> </div>
                <?php       unset($_SESSION['errorMessage']);
                }
                if(isset($_SESSION['successMessage'])){ ?>
                  <div class="correcto"><b><?php echo $_SESSION['successMessage'] ?> </b></div>
                  <?php unset($_SESSION['successMessage']);
                 } ?>