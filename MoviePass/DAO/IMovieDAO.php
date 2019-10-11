<?php
    namespace DAO;

    use Models\Movie as Movie;
    

    interface IMovieDAO
    {
        function Add(Movie $newMovie);
        function GetAll();
        
    }
?>