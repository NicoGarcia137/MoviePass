<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class UserController
    {
        private $UserDAO;

        public function __construct()
        {
            $this->UserDAO = new UserDAO();
        }

        public function Add($userName, $password, $firstName,$lastName,$email,$rol)
        {
            $User = new User();
            $User->setUserName($userName);
            $user->setPassword($password);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setRol($rol);


            $this->UserDAO->Add($User);

            if($rol=="X"){
            $this->ShowXView();
            }
            else if($rol=="x"){
                $this->ShowxView();
            }
        }

        public function ShowSignUpView(){
            require_once(VIEWS_PATH."signup.php");
        }
        
    }
?>