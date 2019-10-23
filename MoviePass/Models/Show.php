<?php
namespace Models;
    class Show{
        private $Id;
        private $DateTime;
        private $Movie;
        private $Tickets;
        private $Room;

        
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

        public function getMovie()
        {
                return $this->Movie;
        }

        public function setMovie($Movie)
        {
                $this->Movie = $Movie;
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

       
        public function getRoom()
        {
                return $this->Room;
        }

        public function setRoom($Room)
        {
                $this->Room = $Room;
        }
}

?>