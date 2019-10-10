<?php
    namespace DAO;

    use Models\Genero as Genero;
    

    interface IGeneroDAO
    {
        function Add(Genero $newGenero);
        function GetAll();
        
    }
?>