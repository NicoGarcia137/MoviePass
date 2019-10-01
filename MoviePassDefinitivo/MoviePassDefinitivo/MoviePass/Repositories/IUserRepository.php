<?php
    namespace Repositories;

    use Models\Person as Person;
    use Models\Client as Client;

    interface IUserRepository
    {
        function Add(Client $newUser);
        function GetAll();
        function GetByUserName($userName);
    }
?>