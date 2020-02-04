<?php 
    include_once("header.php");
    include_once("navUser.php");
?>


<div id="signupSlogan">
    <div class="inside">
        <h2>Nuevo<span>Usuario</span></h2>
        <p>Complete todos los datos para registrarse.</p>
    </div>
</div>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">
                <div class="form">
                    <div class="tab-content">
                        <div id="signup">   
                        
                            <form action="<?php echo FRONT_ROOT."User/Add" ?>" method="post">
                            
                                <div class="field-wrap">
                                    <label class="log-label" >Nombre</label>
                                    <input class="log-input" type="text" name="firstName" required />
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" >Apellido</label>
                                    <input class="log-input" type="text" name="lastName" required />
                                </div>
                                
                                <div class="field-wrap">
                                    <label class="log-label" >DNI</label>
                                    <input class="log-input" type="number" name="dni" required />
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" >Correo electrónico</label>
                                    <input class="log-input" type="email" name="email" placeholder="example@gmail.com" required />
                                </div>
                            
                                <div class="field-wrap">
                                    <label class="log-label" >Contraseña</label>
                                    <input class="log-input" type="password" name="password" placeholder="••••••" required/>
                                </div>

                                <br>
                                <br>

                                <button class="button button-block">Crear cuenta</button>
                            
                            </form>

                            <br>
                            
                            <form action="<?php echo FRONT_ROOT."User/FacebookAdd" ?>">

                                <input type="submit" class="button button-block" value="Acceder con Facebook">  

                            </form>

                        </div>
                    </div><!-- tab-content -->
                </div> <!-- /form -->
            </div>
        </div>
    </div>
</div>

<br><br><br><br>     

<?php include_once("footer.php") ?>
