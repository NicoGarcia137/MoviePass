<?php

use Models\Usuario as User;

if($_SESSION){
  $user=$_SESSION["loggedUser"];
  if($user->getRol()->getDescripcion()==="admin"){

  }else{
    echo "<script> 
    if(confirm('no tiene permisos suficientes para acceder')){ 
    }
    </script>";
  }
}else{
  echo "<script> 
  if(confirm('debe loguearse para acceder')){ 
  }
  </script>";
}


?>
<div class="row-2">
          <ul>
            <li><a href="<?php echo FRONT_ROOT."Home/indexAdmin" ?>">Home</a></li>
            <li><a href="<?php echo FRONT_ROOT."Cine/ShowAddView" ?>">Añadir cine</a></li>
            <li><a href="<?php echo FRONT_ROOT."Cine/ShowRemoveView" ?>">Eliminar cine</a></li>
            <li><a href="<?php echo FRONT_ROOT."Movie/GetMoviesFromApi" ?>">Peliculas Api</a></li>
            <li class="last"><a href="<?php echo FRONT_ROOT."Cine/ShowListCinesAdminView" ?>">Cines</a></li>
          </ul>
        </div>
      </div>