<?php
namespace Models;
    class MovieXGenre{
        private $Id;
        private $MovieId;
        private $GenreId;
        


        public function getId()
        {
                return $this->Id;
        }
 
        public function setId($Id)
        {
                $this->Id = $Id;

        }

        public function getMovieId()
        {
                return $this->MovieId;
        }
 
        public function setMovieId($MovieId)
        {
                $this->MovieId = $MovieId;

        }

        public function getGenreId()
        {
                return $this->GenreId;
        }
 
        public function setGenreId($GenreId)
        {
                $this->GenreId = $GenreId;

        }


    }

?>