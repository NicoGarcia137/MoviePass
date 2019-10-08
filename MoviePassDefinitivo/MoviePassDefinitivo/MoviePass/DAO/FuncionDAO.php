<?php namespace DAO;

use Repositories\IFuncionDAO as IFuncionDAO;
use Models\Funcion as Funcion;

class FuncionDAO implements IFuncionDAO{

    private $funcionList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->funcionList;
    }

    public function Add(Entrada $newFuncion){
        
        $this->RetrieveData();
        
        array_push($this->funcionList, $newFuncion);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->funcionList as $funcion)
        {
            $valuesArray["dateTime"] = $funcion->getFechaCompra();
            $valuesArray["Peliculas"] = $funcion->getCantidadEntradas();
            $valuesArray["Entradas"] = $funcion->getTotal();
           

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('../Data/Funcion.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->funcionList = array();

        if(file_exists('../Data/Funcion.json'))
        {
            $jsonContent = file_get_contents('../Data/Funcion.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $funcion = new Funcion();
                $funcion->setDateTime($valuesArray["dateTime"]);
                $funcion->setPeliculas($valuesArray["Peliculas"]);
                $funcion->setEntradas($valuesArray["Entradas"]);

                array_push($this->funcionList, $funcion);
            }
        }
    }
}

?>

