<?php namespace DAO;

use DAO\IUserDAO as IUserDAO;
use Models\Usuario as User;
use Models\PerfilUsuario as PerfilUsuario; 
use Models\Rol as Rol; 

class UserDAO implements IUserDAO{

    private $userList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->userList;
    }

    public function GetUserLogin($dni){
        $this->RetrieveData();
        $userFounded = null;
        
        if(!empty($this->userList)){
            foreach($this->userList as $user){
                if($user->getDni() == $dni){
                    $userFounded = $user;
                }
            }
        }
        return $userFounded;
    }

    public function GetByEmail($Email){
        $this->RetrieveData();
        $userFounded = null;
        
        if(!empty($this->userList)){
            foreach($this->userList as $user){
                if($user->getEmail() == $Email){
                    $userFounded = $user; 
                }
            }
        }

        return $userFounded;
    }

    public function Add(User $newUser){
        
        $this->RetrieveData();
        
        array_push($this->userList, $newUser);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->userList as $user)
        {            
           
            $perfilUsuario=$user->getPerfilUsuario();
            $rol=$user->getRol();

            $valuesArray["firstName"] = $perfilUsuario->getFirstName();
            $valuesArray["lastName"] = $perfilUsuario->getLastName();
            $valuesArray["dni"] =$perfilUsuario->getDni();
            $valuesArray["email"] = $user->getEmail();
            $valuesArray["password"] = $user->getPassword();
            $valuesArray["rol"] = $rol->getDescripcion();

            array_push($arrayToEncode,$valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/users.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->userList = array();

        if(file_exists('Data/users.json'))
        {
            $jsonContent = file_get_contents('Data/users.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $user = new User();
                $usuario= new PerfilUsuario();
                $rolUser=new Rol();

                $usuario->setFirstName($valuesArray["firstName"]);
                $usuario->setLastName($valuesArray["lastName"]);
                $usuario->setDni($valuesArray["dni"]);
                
                $rolUser->setDescripcion($valuesArray["rol"]);

                 
                $user->setPerfilUsuario($usuario);
                $user->setEmail($valuesArray["email"]);
                $user->setPassword($valuesArray["password"]);
                $user->setRol($rolUser);

                array_push($this->userList, $user);
            }
        }
    }
}

?>

