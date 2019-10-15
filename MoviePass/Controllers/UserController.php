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

        public function getUserByEmail($email){
            $user = $this->UserDAO->GetByEmail($email);
            return $user;
        }

        public function Add( $firstName,$lastName,$dni,$email, $password,$newRol)
        {
            if($this->getUserByEmail($email)==null){
                $User = new User();
                $perfilUsuario=new PerfilUsuario();
                $rol = new Rol();
                $rol->setDescripcion($newRol);
    
                $perfilUsuario->setFirstName($firstName);
                $perfilUsuario->setLastName($lastName);
                $perfilUsuario->setDni($dni);
    
    
                $User->setPerfilUsuario($perfilUsuario);
                $User->setPassword($password);
                $User->setEmail($email);
                $User->setRol($rol);
    
    
                $this->UserDAO->Add($User);
                
                $this->ShowLoginView();
            }else{
                echo "<script> 
                    if(confirm('Email ya existente en nuestra base de datos')){ 
                    }
                 </script>";
                $this->ShowSignUpView();
            }
           
        }


        public function ShowLoginView(){
            require_once(VIEWS_PATH."login.php");
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