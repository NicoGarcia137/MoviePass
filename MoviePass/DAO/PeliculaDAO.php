<?php namespace DAO;

use Repositories\IPeliculaDAO as IPeliculaDAO;
use Models\Pelicula  as Pelicula;

class PeliculaDAO implements IPeliculaDAO{

    private $peliculaList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->peliculaList;
    }

    public function Add(Pelicula $newPelicula){
        
        $this->RetrieveData();
        
        array_push($this->peliculaList, $newPelicula);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->peliculaList as $pelicula)
        {
            $valuesArray["Nombre"] = $pelicula->getNombre();
            $valuesArray["Duracion"] = $pelicula->getDuracion();
            $valuesArray["Lenguaje"] = $pelicula->getLenguaje();
            $valuesArray["Imagen"] = $pelicula->getImagen();
            $valuesArray["Genero"] = $pelicula->getGenero();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('../Data/Pelicula.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->peliculaList = array();

        if(file_exists('../Data/Pelicula.json'))
        {
            $jsonContent = file_get_contents('../Data/Pelicula.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $pelicula = new Pelicula();
                $pelicula->setNombre($valuesArray["Nombre"]);
                $pelicula->setDuracion($valuesArray["Duracion"]);
                $pelicula->setLenguaje($valuesArray["Lenguaje"]);
                $pelicula->setImagen($valuesArray["Imagen"]);
                $pelicula->setImagen($valuesArray["Genero"]);

           

                array_push($this->peliculaList, $pelicula);
            }
        }
    }
}

?>

