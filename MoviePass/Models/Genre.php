<?php
namespace Models;
    class Genre{
        private $Id;
        private $Descripcion;
        
        public function getId()
        {
            return $this->Id;
        }

        public function setId($Id)
        {
            $this->Id = $Id;
        }

        public function getDescripcion()
        {
            return $this->Descripcion;
        }
 
        public function setDescripcion($Descripcion)
        {
            $this->Descripcion = $Descripcion;

        }
    }

?>