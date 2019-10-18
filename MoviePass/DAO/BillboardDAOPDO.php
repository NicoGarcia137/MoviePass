<?php namespace DAO;

use Models\Movie as Movie;
use DAO\Connection as Connection;
use \Exception as Exception;

class BillboardDAOPDO {

  
    private $connection;


    
    public function GetAllMovies()
        {
            try
            {
                $MovieList = array();

                $query = "SELECT * FROM "."Movies;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Movie = new Movie();
                    
                    $Movie->setId($row["Id"]);
                    $Movie->setName($row["Name"]);
                    $Movie->setDuration($row["Duration"]);
                    $Movie->setLanguage($row["Language"]);
                    $Movie->setImage($row["Image"]);
                    $Movie->setGenre($row["Genre"]);
                    

                    array_push($MovieList, $Movie);
                }


                usort($MovieList,function ($a, $b){
                    if($a == $b) {
                        return 0;
                    }
                    return ($a < $b) ? -1 : 1;
                });


                return $MovieList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    

   

    public function GetMovieById($id)
    {
        try
        {
           

            $query = "SELECT * FROM Movies WHERE Movies.Id =".$id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $MovieSearch=null;
            foreach ($resultSet as $row)
            {                
                $MovieSearch = new Movie();
                $MovieSearch->setId($row['Id']);
                $MovieSearch->setName($row["Name"]);
                $MovieSearch->setDuration($row["Duration"]);
                $MovieSearch->setLanguage($row["Language"]);
                $MovieSearch->setImage($row["Image"]);
                $MovieSearch->setGenre($row["Genre"]);
            }
            
  
            return $MovieSearch;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
 
    public function RemoveMovie($Movie)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Movies WHERE Id="."'".$Movie->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Movie)
        {
            try
            {
               

                $query = "INSERT INTO Movies (Id,Name, Duration, Language,Image) VALUES (:Id,:Name, :Duration, :Language, :Image);";
                
                $parameters["Id"] = $Movie->getId();
                $parameters["Name"] = $Movie->getName();
                $parameters["Duration"] = $Movie->getDuration();
                $parameters["Language"] = $Movie->getLanguage();
                $parameters["Image"] = $Movie->getImage();
                
               
                $this->connection = Connection::GetInstance();                
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            }
            catch(Exception $ex)
            {
                var_dump($ex);
            }
        }
 } 

?>

