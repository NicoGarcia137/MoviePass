<?php
namespace Models;
    class Ticket{
        private $id;
        private $show;
        private $seat;
        private $value;
     

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getShow()
        {
                return $this->show;
        }

        public function setShow($show)
        {
                $this->show = $show;
        }

        public function getSeat()
        {
                return $this->seat;
        }

        public function setSeat($seat)
        {
                $this->seat = $seat;
        }

        public function getValue()
        {
                return $this->value;
        }

        public function setValue($value)
        {
                $this->value = $value;
        }
    }

?>