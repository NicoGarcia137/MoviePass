<?php namespace DAO;

use DAO\IMovieDAO as IMovieDAO;
use Models\Movie  as Movie;

class MovieDAO implements IMovieDAO{

    private $MovieList = array();

    public function GetAll(){
        $this->RetrieveData();

        return $this->MovieList;
    }

    public function Add(Movie $newMovie){
        
        $this->RetrieveData();
        
        array_push($this->MovieList, $newMovie);

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->MovieList as $Movie)
        {
            $valuesArray["Name"] = $Movie->getName();
            $valuesArray["Duration"] = $Movie->getDuration();
            $valuesArray["Language"] = $Movie->getLanguage();
            $valuesArray["Image"] = $Movie->getImage();
            $valuesArray["Genre"] = $Movie->getGenre();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/Movie.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->MovieList = array();

        if(file_exists('Data/Movie.json'))
        {
            $jsonContent = file_get_contents('Data/Movie.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $Movie = new Movie();
                $Movie->setName($valuesArray["Name"]);
                $Movie->setDuration($valuesArray["Duration"]);
                $Movie->setLanguage($valuesArray["Language"]);
                $Movie->setImage($valuesArray["Image"]);
                $Movie->setImage($valuesArray["Genre"]);

           

                array_push($this->MovieList, $Movie);
            }
        }
    }
}

?>

