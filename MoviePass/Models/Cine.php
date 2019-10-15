<?php
namespace Models;
    class Cine{
        private $id;
        private $Name;
        private $Address;
        private $Capacity;
        private $Value;
        private $Funciones;

        
        public function getId()
        {
                return $this->id;
        }


        public function setId($id)
        {
                $this->id = $id;
        }

        public function getName()
        {
                return $this->Name;
        }


        public function setName($name)
        {
                $this->Name = $name;
        }

        public function getAddress()
        {
                return $this->Address;
        }

        public function setAddress($address)
        {
                $this->Address = $address;

        }

        public function getCapacity()
        {
                return $this->Capacity;
        }

        public function setCapacity($capacity)
        {
                $this->Capacity = $capacity;

        }

        public function getValue()
        {
                return $this->Value;
        }
     
        public function setValue($value)
        {
                $this->Value = $value;
        }

        public function getfunciones()
        {
                return $this->Funciones;
        }

        public function setfunciones($funciones)
        {
                $this->Funciones = $funciones;

        }
    }

?>