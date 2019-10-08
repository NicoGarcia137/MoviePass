<?php
    namespace DAO;

    use Models\Funcion as Funcion;
    

    interface IFuncionDAO
    {
        function Add(Funcion $newFuncion);
        function GetAll();
    }
?>