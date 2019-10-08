<?php
    namespace DAO;

    use Models\Pelicula as Pelicula;
    

    interface IPeliculaDAO
    {
        function Add(Pelicula $newPelicula);
        function GetAll();
        
    }
?>