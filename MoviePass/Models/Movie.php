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