<?php 
include_once("header.php");
include_once("nav.php");


?>
 <main class="d-flex align-items-center justify-content-center height-100">
          <div class="content">
               <header class="text-center">
                    <h2>Practico N° 5.1</h2>
               </header>
               <form action="Process/login.php" method="post" class="login-form bg-dark-alpha p-5 text-white">
                    <div class="form-group">
                         <label for="">Nombre de Usuario</label>
                         <input type="text" name="username" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
                    </div>
                    <div class="form-group">
                         <label for="">Contraseña</label>
                         <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                    </div>
                    <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
               </form>
          </div>
     </main>

<?php
 include('footer.php') 
?>