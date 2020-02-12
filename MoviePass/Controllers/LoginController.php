<?php 
namespace Controllers;

use DAO\UserDAOPDO as UserDAO;
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
                if(isset($_SESSION['failPurchase'])){
                    require_once(VIEWS_PATH."confirmFailPurchase.php");
                }else{
                     $this->ShowUserView();
                }
            }
        }
        else{
            $_SESSION['errorMessage']="Usuario y/o Contraseña incorrectos";
            $this->ShowLoginView();
        }
      
    }

    public function Logout()
    {
        session_destroy();
        session_start();
        $_SESSION['successMessage']="LogOut Exitoso, vuelva pronto";
        header("location: ".FRONT_ROOT."Home/index");
    }

    public function ShowLoginView(){
        require_once(VIEWS_PATH."login.php");
    }

    private function ShowUserView(){
        $_SESSION['successMessage']="Usuario logueado con exito";
        header("location: ".FRONT_ROOT."Home/index");
    }

    private function ShowAdminView(){
        $_SESSION['successMessage']="Usuario Admin logueado con exito";
        header("location: ".FRONT_ROOT."Home/indexAdmin");
    }


    

}

?>
