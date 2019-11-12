<?php
namespace Models;
    class Purchase{
        private $id;
        private $tickets;
        private $dateTime;
        private $totalValue;
     
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getTickets()
        {
                return $this->tickets;
        }

        public function setTickets($tickets)
        {
                $this->tickets = $tickets;
        }


        public function getTotalValue()
        {
                $result=0;
                foreach($this->tickets as $ticket){
                        $result+=$ticket->getValue();
                }
                return $result;
        }

        public function getDateTime()
        {
                return $this->dateTime;
        }

        public function setDateTime($dateTime)
        {
                $this->dateTime = $dateTime;
        }
    }

?>