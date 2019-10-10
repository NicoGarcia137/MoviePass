<?php namespace DAO;

use Repositories\IPeliculaDAO as IGeneroDAO;
use Models\Genero as Genero; 

class GeneroDAO implements IGeneroDAO{

    private $generoList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->generoList;
    }

    public function Add(Pelicula $newGenero){
        
        $this->RetrieveData();
        
        array_push($this->generoList, $newGenero);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->generoList as $genero)
        {
            $valuesArray["Descripcion"] = $genero->getDescripcion();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('../Data/Descripcion.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->generoList = array();

        if(file_exists('../Data/Descripcion.json'))
        {
            $jsonContent = file_get_contents('../Data/Descripcion.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $genero = new Genero();
                $genero->setDescripcion($valuesArray["Descripcion"]);
                

           

                array_push($this->generoList, $genero);
            }
        }
    }
}

?>

0