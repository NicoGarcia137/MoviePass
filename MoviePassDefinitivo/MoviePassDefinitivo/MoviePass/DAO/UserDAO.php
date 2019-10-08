<?php namespace DAO;

use DAO\IUserDAO as IUserDAO;
use Models\Usuario as User;

class UserDAO implements IUserDAO{

    private $userList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->userList;
    }

    public function GetUserLogin($name){
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

    public function Add(Client $newUser){
        
        $this->RetrieveData();
        
        array_push($this->userList, $newUser);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->userList as $user)
        {


            $valuesArray["perfilUsuario"] =$user->getPerfilUsuario();
            $valuesArray["firstName"] = $user->getFirstName();
            $valuesArray["lastName"] = $user->getLastName();
            $valuesArray["rol"] = $user->getRol();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('../Data/users.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->userList = array();

        if(file_exists('../Data/users.json'))
        {
            $jsonContent = file_get_contents('../Data/users.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $user = new User();
                $user->setFirstName($valuesArray["firstName"]);
                $user->setLastName($valuesArray["lastName"]);

                $usuario= new PerfilUsuario();
                $usuario->set();
                $usuario->
                $user->setPerfilUsuario($valuesArray["perfilUsuario"]);


                $user->setRol($valuesArray["rol"]);



                $user->setPassword($valuesArray["password"]);

                array_push($this->userList, $user);
            }
        }
    }
}

?>

