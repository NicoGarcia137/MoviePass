<?php
    namespace DAO;

    use Models\Entrada as Entrada;
    

    interface IEntradaDAO
    {
        function Add(Compra $newCompra);
        function GetAll();
        
    }
?>