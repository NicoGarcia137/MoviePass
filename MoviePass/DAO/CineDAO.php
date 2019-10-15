<?php namespace DAO;

use DAO\ICineDAO as ICineDAO;
use Models\Cine as Cine;

class CineDAO implements ICineDAO{

    private $cineList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->cineList;
    }

    public function GetById($id){
        $this->RetrieveData();
        $cineFounded = null;
        
        if(!empty($this->cineList)){
            foreach($this->cineList as $cine){
                if($cine->getId() == $id){
                    $cineFounded = $cine;
                }
            }
        }

        return $cineFounded;
    }

    public function ModifyCine($cine)
    {
        $this->RetrieveData();

        foreach($this->cineList as $cineValue){

            if($cineValue->getId() == $cine->getId()){
                $key = array_search($cineValue, $this->cineList);
                unset($this->cineList[$key]);
            }
        }
        
        array_push($this->cineList, $cine);

        usort($this->cineList,function ($a, $b)
        {
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });


        $this->SaveData();
    }

    public function RemoveCine($cine){
         $this->RetrieveData();

        foreach($this->cineList as $cineValue){

            if($cineValue->getId() == $cine->getId()){
                $key = array_search($cineValue, $this->cineList);
                unset($this->cineList[$key]);
            }
        }


        $this->SaveData();

        echo "<script> if(confirm('Cine eliminado correctamente'));";  
        echo " </script>";
    }


    public function Add(Cine $newCine){
        
        $this->RetrieveData();
        $id=0;
        foreach($this->cineList as $cine){
            if($id<=$cine->getId()){
                $id=$cine->getId();
                $id++;
            }
        }
        $newCine->setId($id);
        array_push($this->cineList, $newCine);

        $this->SaveData();
    }

    

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->cineList as $cine)
        {
            $valuesArray["Id"] = $cine->getId();
            $valuesArray["Name"] = $cine->getName();
            $valuesArray["Address"] = $cine->getAddress();
            $valuesArray["Capacity"] = $cine->getCapacity();
            $valuesArray["Value"] = $cine->getValue();
            $valuesArray["Funciones"] = $cine->getFunciones();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/Cines.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->cineList = array();

        if(file_exists('Data/Cines.json'))
        {
            $jsonContent = file_get_contents('Data/Cines.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $cine = new Cine();
                $cine->setId($valuesArray["Id"]);
                $cine->setName($valuesArray["Name"]);
                $cine->setAddress($valuesArray["Address"]);
                $cine->setCapacity($valuesArray["Capacity"]);
                $cine->setValue($valuesArray["Value"]);
                $cine->setfunciones($valuesArray["Funciones"]);

                array_push($this->cineList, $cine);
            }
        }
    }
}

?>

