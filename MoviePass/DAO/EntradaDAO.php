<?php namespace DAO;

use Repositories\IEntradaDAO as IEntradaDAO;
use Models\Entrada as Entrada;

class EntradaDAO implements IEntradaDAO{

    private $entradaList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->entradaList;
    }

    

    public function Add(Entrada $newEntrada){
        
        $this->RetrieveData();
        
        array_push($this->entradaList, $newEntrada);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->entradaList as $entrada)
        {
            $valuesArray["QR"] = $entrada->getQR();
            $valuesArray["NumeroEntrada"] = $entrada->getNumeroEntrada();


    

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('../Data/Entrada.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->cineList = array();

        if(file_exists('../Data/Entrada.json'))
        {
            $jsonContent = file_get_contents('../Data/Entrada.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $entrada = new Entrada();
                $entrada->setQR($valuesArray["QR"]);
                $entrada->setQR($valuesArray["NumeroEntrada"]);
              

                array_push($this->entradaList, $entrada);
            }
        }
    }
}

?>

