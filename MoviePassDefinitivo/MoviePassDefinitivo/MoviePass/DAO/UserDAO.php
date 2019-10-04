<?php namespace DAO;

use DAO\IUserDAO as IUserDAO;
use Models\User as User;

class UserDAO implements IUserDAO{

    private $userList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->userList;
    }

    public function GetByUserName($userName){
        $this->RetrieveData();
        $userFounded = null;
        
        if(!empty($this->userList)){
            foreach($this->userList as $user){
                if($user->getUserName() == $userName){
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
            $valuesArray["firstName"] = $user->getFirstName();
            $valuesArray["lastName"] = $user->getLastName();
            $valuesArray["dni"] = $user->getDni();
            $valuesArray["email"] = $user->getEmail();
            $valuesArray["username"] = $user->getUserName();
            $valuesArray["password"] = $user->getPassword();

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
                $user->setEmail($valuesArray["email"]);
                $user->setUserName($valuesArray["username"]);
                $user->setPassword($valuesArray["password"]);

                array_push($this->userList, $user);
            }
        }
    }
}

?>

