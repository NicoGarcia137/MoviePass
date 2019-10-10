<?php 
namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\Usuario as Usuario;

class LoginController
{
    private $UserDAO;

        public function __construct()
        {
            $this->UserDAO = new UserDAO();
        }

    public function Login($email, $password)
    {
        //$this->ShowAdminView();
        
        $user = $this->userDAO->GetByEmail($email);

        if(($user != null) && ($user->getPassword() === $password))
        {
            $_SESSION["loggedUser"] = $user;

            
            if($user->getRol()=="admin"){
                $this->ShowAdminView();
            }else{
                $this->ShowUserView();
            }
        }
        else
            $this->Index("Usuario y/o Contraseña incorrectos");
    }

    public function Logout()
    {
        session_destroy();
        $this->Index();
    }

    public function ShowLoginView(){
        require_once(VIEWS_PATH."login.php");
    }

    public function ShowUserView(){
        require_once(VIEWS_PATH."index.php");
    }

    public function ShowAdminView(){
        require_once(VIEWS_PATH."settings.php");
    }


    public function CheckLoginUser(){
         $check=false;
        $user= $_SESSION["loggedUser"];
         if($user->getRol()=="admin"){
            $check=true;
         }
         return $check;
     }

     public function CheckLoginAdmin(){
        $check=false;
        $user= $_SESSION["loggedUser"];
         if($user->getRol()=="admin"){
            $check=true;
         }
         return $check;
     }

}

?>
