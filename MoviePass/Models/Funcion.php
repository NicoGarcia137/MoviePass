<?php
namespace Models;
    class Funcion{
        private $dateTime;
        private $Peliculas;
        private $Entradas;
        
        

        public function getDateTime()
        {
                return $this->dateTime;
        }

        public function setDateTime($dateTime)
        {
                $this->dateTime = $dateTime;
        }

        public function getPeliculas()
        {
                return $this->Peliculas;
        }

        public function setPeliculas($Peliculas)
        {
                $this->Peliculas = $Peliculas;

        }

        public function getEntradas()
        {
                return $this->Entradas;
        }

        public function setEntradas($Entradas)
        {
                $this->Entradas = $Entradas;

        }
    }

?>