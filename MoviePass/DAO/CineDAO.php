<?php namespace DAO;

use DAO\ICineDAO as ICineDAO;
use Models\Cine as Cine;
use DAO\Connection as Connection;

class CineDAO implements ICineDAO{

    private $cineList = array();
    private $connection;
    private $tableName ="cines";


    public function GetAll(){
        $this->RetrieveData();

        return $this->cineList;
    }
    public function NewGetAll()
        {
            try
            {
                $cineListPDO = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $student = new Student();
                    $student->setRecordId($row["recordId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);

                    array_push($cineList, $student);
                }

                return $cineListPDO;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }

    public function GetByCineName($name){
        $this->RetrieveData();
        $cineFounded = null;
        
        if(!empty($this->cineList)){
            foreach($this->cineList as $cine){
                if($cine->getUserName() == $name){
                    $cineFounded = $cine;
                }
            }
        }

        return $cineFounded;
    }

    public function RemoveCineByName($name){
         $this->RetrieveData();

        foreach($this->cineList as $cineValue){

            if($cineValue->GetByCineName($name) == $name){
                $key = array_search($cineValue, $this->cineList);
                unset($this->cineList[$key]);
            }
        }

        $this->SaveData();
    }

    public function Add(Cine $newCine){
        
        $this->RetrieveData();
        
        array_push($this->cineList, $newCine);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->cineList as $cine)
        {
            $valuesArray["Name"] = $cine->getName();
            $valuesArray["address"] = $cine->getAddress();
            $valuesArray["Capacity"] = $cine->getCapacity();
            $valuesArray["Value"] = $cine->getValue();
            $valuesArray["funciones"] = $cine->getFunciones();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('../Data/Cines.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->cineList = array();

        if(file_exists('../Data/Cines.json'))
        {
            $jsonContent = file_get_contents('../Data/Cines.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $cine = new Cine();
                $cine->setName($valuesArray["name"]);
                $cine->setAddress($valuesArray["Address"]);
                $cine->setCapacity($valuesArray["Capacity"]);
                $cine->setValue($valuesArray["Value"]);
                $cine->setfunciones($valuesArray["funciones"]);

                array_push($this->cineList, $cine);
            }
        }
    }
}

?>

