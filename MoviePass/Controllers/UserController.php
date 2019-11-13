<?php
    namespace Controllers;

    use DAO\UserDAOPDO as UserDAOPDO;
    use Models\Usuario as User;
    use Models\PerfilUsuario as PerfilUsuario;
    use Models\Rol as Rol;

    class UserController
    {
        private $UserDAOPDO;

        public function __construct()
        {
            $this->UserDAOPDO = new UserDAOPDO();
        }

        public function getUserByEmail($email){
            $user = $this->UserDAOPDO->GetByEmail($email);
            return $user;
        }

        public function FacebookAdd()
        {
            include_once("fb-Signup.php");

            if($user!=null){
                $this->Add($user->getFirstName(), $user->getLastName(), "0", $user->getEmail(), $user->getId() );
            }
        }

        public function Add( $firstName,$lastName,$dni,$email, $password)
        {
            if($this->getUserByEmail($email)==null){
                $User = new User();
                $perfilUsuario=new PerfilUsuario();
                $rol = new Rol();
                $rol->setDescripcion("user");
    
                $perfilUsuario->setFirstName($firstName);
                $perfilUsuario->setLastName($lastName);
                $perfilUsuario->setDni($dni);
    
    
                $User->setPerfilUsuario($perfilUsuario);
                $User->setPassword($password);
                $User->setEmail($email);
                $User->setRol($rol);
    
    
                $this->UserDAOPDO->Add($User);
                
                $this->ShowLoginView();
            }else{
                echo "<script> 
                    if(confirm('Email ya existente en nuestra base de datos')){ 
                        window.location= '../index.php'
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