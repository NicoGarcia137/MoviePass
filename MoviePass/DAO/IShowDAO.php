<?php
    namespace DAO;

    use Models\Show as Show;
    

    interface IShowDAO
    {
        function Add(Show $newShow);
        function GetAll();
    }
?>