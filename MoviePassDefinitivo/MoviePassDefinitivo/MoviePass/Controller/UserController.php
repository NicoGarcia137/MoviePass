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

        // public function ShowAddView()
        // {
        //     require_once(VIEWS_PATH."User-add.php");
        // }

        // public function ShowListView()
        // {
        //     $UserList = $this->UserDAO->GetAll();

        //     require_once(VIEWS_PATH."User-list.php");
        // }
        public function Add($userName, $password, $firstName,$lastName,$email)
        {
            $User = new User();
            $User->setUserName($userName);
            $user->setPassword($password);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);


            $this->UserDAO->Add($User);

            $this->ShowAddView();
        }
        
    }
?>