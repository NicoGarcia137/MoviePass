<?php
namespace Models;
    class Show{
        private $Id;
        private $DateTime;
        private $Peliculas;
        private $Tickets;

        
        public function getId()
        {
                return $this->Id;
        }

        public function setId($Id)
        {
                $this->Id = $Id;
        }

        public function getDateTime()
        {
                return $this->DateTime;
        }

        public function setDateTime($DateTime)
        {
                $this->DateTime = $DateTime;
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

        public function getTickets()
        {
                return $this->Tickets;
        }

        public function setTickets($Tickets)
        {
                $this->Tickets = $Tickets;
        }
}

?>