<?php
    namespace DAO;

    use Models\Compra as Compra;
    

    interface ICompraDAO
    {
        function Add(Compra $newCompra);
        function GetAll();
    }
?>