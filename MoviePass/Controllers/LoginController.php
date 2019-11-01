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

    public function FacebookLogin()
    {
        include_once("fb-Login.php");
        if($user!=null)
        {
            $this->Login($user->getEmail(), $user->getId());
        }
    }

    public function Login($email, $password)
    {
        $user = $this->UserDAO->GetByEmail($email);
        if(($user != null) && ($user->getPassword() === $password))
        {
            $_SESSION["loggedUser"] = $user;

            
            if($user->getRol()->getDescripcion()==="admin"){
                $this->ShowAdminView();
            }else{
                $this->ShowUserView();
            }
        }
        else{
            echo "<script> 
            if(confirm('Usuario y/o Contraseña incorrectos')){ 
            }
            </script>";
            $this->ShowLoginView();
        }
      
    }

    public function Logout()
    {
        session_destroy();
        $this->ShowUserView();
    }

    public function ShowLoginView(){
        require_once(VIEWS_PATH."login.php");
    }

    public function ShowUserView(){
        header("location:../index.php");
    }

    public function ShowAdminView(){
        require_once(VIEWS_PATH."indexAdmin.php");
    }


    

}

?>
