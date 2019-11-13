<?php
namespace Models;
    class Purchase{
        private $id;
        private $tickets=[];
        private $dateTime;
        private $totalValue;
        private $user;
        private $cine;
     
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

        public function addTickets($ticket)
        {
                array_push($this->tickets,$ticket);
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

        public function getUser()
        {
                return $this->user;
        }

        public function setUser($user)
        {
                $this->user = $user;
        }

        public function getCine()
        {
                return $this->cine;
        }

        public function setCine($cine)
        {
                $this->cine = $cine;
        }
    }

?>