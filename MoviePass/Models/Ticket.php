<?php
namespace Models;
    class Ticket{
        private $id;
        private $show;
        private $number;
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

        public function getNumber()
        {
                return $this->number;
        }

        public function setNumber($number)
        {
                $this->number = $number;
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