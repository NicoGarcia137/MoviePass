<?php
namespace Models;
    class Genre{
        private $Id;
        private $Description;
        
        public function getId()
        {
            return $this->Id;
        }

        public function setId($Id)
        {
            $this->Id = $Id;
        }

        public function getDescription()
        {
            return $this->Description;
        }
 
        public function setDescription($Description)
        {
            $this->Description = $Description;

        }
    }

?>