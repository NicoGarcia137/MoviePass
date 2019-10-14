<?php
namespace Models;
    class Usuario{
        private $perfilUsuario;
        private $Email;
        private $password;
        private $rol;
        

        public function getPerfilUsuario()
        {
                return $this->perfilUsuario;
        }

        public function setPerfilUsuario($perfilUsuario)
        {
                $this->perfilUsuario = $perfilUsuario;
        }


        public function getRol()
        {
                return $this->rol;
        }

        public function setRol($rol)
        {
                $this->rol = $rol;
        }
   
        public function getEmail()
        {
                return $this->Email;
        }

        public function setEmail($Email)
        {
                $this->Email = $Email;

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