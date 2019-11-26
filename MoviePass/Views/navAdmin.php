<?php

use Models\Usuario as User;

if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol()->getDescripcion()!="admin"){
  header("location: ".FRONT_ROOT."Home/index");
}


?>
<div class="row-2">
          <ul>
            <li><a href="<?php echo FRONT_ROOT."Home/indexAdmin" ?>">Home</a></li>
            <li><a href="<?php echo FRONT_ROOT."Cine/ShowAddView" ?>">Añadir cine</a></li>
            <!-- <li><a href="<?php echo FRONT_ROOT."Cine/ShowRemoveView" ?>">Eliminar cine</a></li> -->
            <li><a href="<?php echo FRONT_ROOT."Billboard/ShowBillboard" ?>">Cartelera Api</a></li>
            <li ><a href="<?php echo FRONT_ROOT."Cine/ShowListCinesAdminView" ?>">Cines</a></li>
            <li class="last"><a href="#"></a></li>
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