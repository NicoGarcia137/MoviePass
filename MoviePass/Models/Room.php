<?php
namespace Models;
    class Room{
        private $Id;
        private $Shows=[];
        private $Capacity;
        private $Name;
        private $Cine;
        
        public function getId()
        {
            return $this->Id;
        }

        public function setId($Id)
        {
            $this->Id = $Id;
        }

        public function getShows()
        {
            return $this->Shows;
        }

        public function setShows($Shows)
        {
            $this->Shows = $Shows;
        }

    

        public function getCapacity()
        {
            return $this->Capacity;
        }

        public function setCapacity($Capacity)
        {
            $this->Capacity = $Capacity;
        }


        public function getCine()
        {
                return $this->Cine;
        }

       
        public function setCine($Cine)
        {
                $this->Cine = $Cine;
        }

        public function getName()
        {
                return $this->Name;
        }

        public function setName($Name)
        {
                $this->Name = $Name;
        }
    }
?>