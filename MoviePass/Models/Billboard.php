<?php
namespace Models;
    class Billboard{
        private $Movies;

        public function getMovies()
        {
                return $this->Movies;
        }

        public function setMovies($Movies)
        {
                $this->Movies = $Movies;
        }

 
    }

?>