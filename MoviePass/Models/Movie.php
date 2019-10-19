<?php
namespace Models;
    class Movie{
        private $Id;
        private $Name;
        private $Duration;
        private $Language;
        private $Image;
        private $Genres=[];
        
        
        public function getId()
        {
                return $this->Id;
        }


        public function setId($Id)
        {
                $this->Id = $Id;

        }
 
        public function getName()
        {
                return $this->Name;
        }


        public function setName($Name)
        {
                $this->Name = $Name;

        }

        public function getDuration()
        {
                return $this->Duration;
        }


        public function setDuration($Duration)
        {
                $this->Duration = $Duration;

        }

        public function getLanguage()
        {
                return $this->Language;
        }

        public function setLanguage($Language)
        {
                $this->Language = $Language;

        }

        public function getImage()
        {
                return $this->Image;
        }

        public function setImage($Image)
        {
                $this->Image = $Image;

        }

        public function getGenres()
        {
                return $this->Genres;
        }

        public function setGenre($Genres)
        {
                $this->Genres = $Genres;

        }

        public function addGenre($genre){
                array_push($this->Genres,$genre);
        }
    }

?>