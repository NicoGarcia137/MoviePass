<?php
namespace Models;
    class Cine{
        private $name;
        private $address;
        private $Capacity;
        private $Value;
        private $funciones;

        


        public function getName()
        {
                return $this->name;
        }


        public function setName($name)
        {
                $this->name = $name;
        }

        public function getAddress()
        {
                return $this->address;
        }

        public function setAddress($address)
        {
                $this->address = $address;

        }

        public function getCapacity()
        {
                return $this->Capacity;
        }

        public function setCapacity($Capacity)
        {
                $this->Capacity = $Capacity;

        }

        public function getValue()
        {
                return $this->Value;
        }
     
        public function setValue($Value)
        {
                $this->Value = $Value;
        }

        public function getfunciones()
        {
                return $this->funciones;
        }

        public function setfunciones($funciones)
        {
                $this->funciones = $funciones;

        }
    }

?>