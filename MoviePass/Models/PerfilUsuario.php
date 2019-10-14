<?php
namespace Models;
    class PerfilUsuario{
        private $firstName;
		private $lastName;
		private $dni;

	
	public function getFirstName(){
		return $this->firstName;
	}
	public function getLastName(){
		return $this->lastName;
	}


	public function getDni(){
		return $this->dni;
	}


	public function setDni($dni){
		$this->dni = $dni;
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