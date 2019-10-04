<?php
    namespace DAO;

    use Models\Usuario as User;

    interface IUserDAO
    {
        function Add(User $newUser);
        function GetAll();
        function GetByUserName($userName);
    }
?>