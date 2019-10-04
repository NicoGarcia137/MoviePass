<?php
namespace Models;
    class Usuario{
        private $eMail;
        private $password;
        private $rol;
        

        public function getRol()
        {
                return $this->rol;
        }

        public function setRol($rol)
        {
                $this->rol = $rol;
        }
   
        public function getEMail()
        {
                return $this->eMail;
        }

        public function setEMail($eMail)
        {
                $this->eMail = $eMail;

                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }
 
        public function setPassword($password)
        {
                $this->password = $password;
        }
    }

?>