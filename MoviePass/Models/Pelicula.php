<?php
namespace Models;
    class Movie{
        private $Name;
        private $Duration;
        private $Language;
        private $Image;
        private $Genre;
        
        

 
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

        public function getLenguage()
        {
                return $this->Lenguage;
        }

        public function setLenguage($Language)
        {
                $this->Lenguage = $Language;

        }

        public function getImagen()
        {
                return $this->Image;
        }

        public function setImagen($Image)
        {
                $this->Image = $Image;

        }

        public function getGenre()
        {
                return $this->Genre;
        }

        public function setGenre($Genre)
        {
                $this->Genre = $Genre;

        }
    }

?>