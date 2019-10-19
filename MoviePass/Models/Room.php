<?php
namespace Models;
    class Room{
        private $Id;
        private $Shows=[];
        private $Capacity;
        private $Name;
        private $CineId;
        
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


        public function getCineId()
        {
                return $this->CineId;
        }

       
        public function setCineId($CineId)
        {
                $this->CineId = $CineId;
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