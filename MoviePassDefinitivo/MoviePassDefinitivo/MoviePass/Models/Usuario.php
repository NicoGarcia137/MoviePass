<?php
namespace Models;
    class Usuario{
        private $eMail;
        private $password;
        


   
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