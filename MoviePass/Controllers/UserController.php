<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\Usuario as User;
    use Models\PerfilUsuario as PerfilUsuario;
    use Models\Rol as Rol;

    class UserController
    {
        private $UserDAO;

        public function __construct()
        {
            $this->UserDAO = new UserDAO();
        }

        public function Add($dni, $password, $firstName,$lastName,$email,$rol="usuario")
        {
            $User = new User();
            $perfilUsuario=new PerfilUsuario();
            $rol = new Rol();
            
            $rol->setDescripcion($rol);

            $perfilUsuario->setFirstName($firstName);
            $perfilUsuario->setLastName($lastName);
            $perfilUsuario->setDni($dni);


            $User->setPerfilUsuario($perfilUsuario);
            $User->setPassword($password);
            $User->setEmail($email);
            $User->setRol($rol);


            $this->UserDAO->Add($User);
            
            $this->ShowIndexView();
        }



        public function ShowIndexView()
        {      
            require_once(VIEWS_PATH."index.php");
        }

         public function ShowSignUpView()
         {      
             require_once(VIEWS_PATH."signup.php");
         }
        
    }
?>