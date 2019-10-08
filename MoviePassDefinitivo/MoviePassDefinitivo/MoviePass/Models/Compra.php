<?php
namespace Models;
    class Compra{

        private $FechaCompra;
        private $CantidadEntradas;
        private $Total;
        private $Descuento;
        private $Entradas;
        private $Usuario;
        
        


        public function getFechaCompra()
        {
                return $this->FechaCompra;
        }
 
        public function setFechaCompra($FechaCompra)
        {
                $this->FechaCompra = $FechaCompra;

        }

        public function getCantidadEntradas()
        {
                return $this->CantidadEntradas;
        }

        public function setCantidadEntradas($CantidadEntradas)
        {
                $this->CantidadEntradas = $CantidadEntradas;

        }

        public function getTotal()
        {
                return $this->Total;
        }

        public function setTotal($Total)
        {
                $this->Total = $Total;

        }

        public function getDescuento()
        {
                return $this->Descuento;
        }

        public function setDescuento($Descuento)
        {
                $this->Descuento = $Descuento;

        }

        public function getEntradas()
        {
                return $this->Entradas;
        }

        public function setEntradas($Entradas)
        {
                $this->Entradas = $Entradas;
        }

        public function getUsuario()
        {
                return $this->Usuario;
        }

        public function setUsuario($Usuario)
        {
                $this->Usuario = $Usuario;
        }
    }

?>