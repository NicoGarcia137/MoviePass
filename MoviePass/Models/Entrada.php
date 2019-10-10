<?php
namespace Models;
    class Entrada{
        private $QR;
        private $NumeroEntrada;
        
        


        public function getQR()
        {
                return $this->QR;
        }

    
        public function setQR($QR)
        {
                $this->QR = $QR;

        }

        public function getNumeroEntrada()
        {
                return $this->NumeroEntrada;
        }

        public function setNumeroEntrada($NumeroEntrada)
        {
                $this->NumeroEntrada = $NumeroEntrada;
        }
    }

?>