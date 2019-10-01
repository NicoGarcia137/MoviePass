<?php
namespace Models;
    class Pelicula{
        private $Nombre;
        private $Duracion;
        private $Lenguaje;
        private $Imagen;
        private $Genero;
        
        

 
        public function getNombre()
        {
                return $this->Nombre;
        }


        public function setNombre($Nombre)
        {
                $this->Nombre = $Nombre;

        }

        public function getDuracion()
        {
                return $this->Duracion;
        }


        public function setDuracion($Duracion)
        {
                $this->Duracion = $Duracion;

        }

        public function getLenguaje()
        {
                return $this->Lenguaje;
        }

        public function setLenguaje($Lenguaje)
        {
                $this->Lenguaje = $Lenguaje;

        }

        public function getImagen()
        {
                return $this->Imagen;
        }

        public function setImagen($Imagen)
        {
                $this->Imagen = $Imagen;

        }

        public function getGenero()
        {
                return $this->Genero;
        }

        public function setGenero($Genero)
        {
                $this->Genero = $Genero;

        }
    }

?>