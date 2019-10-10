<?php namespace DAO;

use Repositories\ICompraDAO as ICompraDAO;
use Models\Compra as Compra;

class CompraDAO implements ICompraDAO{

    private $compraList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->compraList;
    }

    

    public function Add(Entrada $newEntrada){
        
        $this->RetrieveData();
        
        array_push($this->compraList, $newCompra);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->compraList as $compra)
        {
            $valuesArray["FechaCompra"] = $compra->getFechaCompra();
            $valuesArray["CantidadEntradas"] = $compra->getCantidadEntradas();
            $valuesArray["Total"] = $compra->getTotal();
            $valuesArray["Descuento"] = $compra->getDescuento();
            $valuesArray["Entradas"] = $compra->getEntradas();
            $valuesArray["Usuario"] = $compra->getUsuario();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('../Data/Compra.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->compraList = array();

        if(file_exists('../Data/Compra.json'))
        {
            $jsonContent = file_get_contents('../Data/Compra.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $compra = new Compra();
                $compra->setFechaCompra($valuesArray["FechaCompra"]);
                $compra->setCantidadEntradas($valuesArray["CantidadEntradas"]);
                $compra->setTotal($valuesArray["Total"]);
                $compra->setDescuento($valuesArray["Descuento"]);
                $compra->setEntradas($valuesArray["Entradas"]);
                $compra->setUsuario($valuesArray["Usuario"]);
              
                array_push($this->compraList, $compra);
            }
        }
    }
}

?>

