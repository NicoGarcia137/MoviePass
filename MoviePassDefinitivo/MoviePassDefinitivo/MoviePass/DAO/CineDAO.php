<?php namespace DAO;

use Repositories\ICineDAO as ICineDAO;
use Models\Cine as Cine;

class CineDAO implements ICineDAO{

    private $cineList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->cineList;
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
                $cine->setFunciones($valuesArray["funciones"]);

                array_push($this->cineList, $cine);
            }
        }
    }
}

?>

