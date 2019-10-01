<?php
namespace Models;
    class Genero{
        private $Descripcion;
        


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