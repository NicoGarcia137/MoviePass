<?php
namespace Models;
    class PerfilUsuario{
        private $userName;
        private $Usuario;
        private $firstName;
        private $lastName;
		private $rol;

	public function getUserName(){
		return $this->userName;
	}
	public function getPassword(){
		return $this->password;
	}
	public function getFirstName(){
		return $this->firstName;
	}
	public function getLastName(){
		return $this->lastName;
	}

	public function setUserName($userName){
		$this->userName = $userName;
	}


	public function setFirstName($firstName){
		$this->firstName = $firstName;
	}
	public function setLastName($lastName){
		$this->lastName = $lastName;

	}



		public function getRol()
		{
				return $this->rol;
		}

		public function setRol($rol)
		{
				$this->rol = $rol;
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