<?php
    namespace DAO;

    use Models\Cine as Cine;
    

    interface ICineDAO
    {
        function Add(Cine $newCine);
        function GetAll();
        function GetByCineName($cineName);
    }
?>