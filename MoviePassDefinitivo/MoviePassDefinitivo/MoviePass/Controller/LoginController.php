<?php 
namespace Controller;

use DAO\UserDAO as UserDAO;
use Models\Usuario as Usuario;

class LoginController
{
    private $UserDAO;

        public function __construct()
        {
            $this->UserDAO = new UserDAO();
        }

    public function Login($userName, $password)
    {
        $user = $this->userDAO->GetByUserName($userName);

        if(($user != null) && ($user->getPassword() === $password))
        {
            $_SESSION["loggedUser"] = $user;
            $this->XVIEW(); //falta
        }
        else
            $this->Index("Usuario y/o Contraseña incorrectos");
    }

    public function Logout()
    {
        session_destroy();
        $this->Index();
    }

    // public function CheckLogin(){
    //     $user= $_SESSION["loggedUser"];
    //     if($user->=="")
    // }

}

?>
