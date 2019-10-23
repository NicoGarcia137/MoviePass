<?php namespace DAO;

use Models\Genre as Genre;
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

                $query = 
                "Select 
                m.Id as MovieId,
                m.Name,
                m.Duration,
                m.Language,
                m.Image,
                mg.Id,
                g.Id as GenreId,
                g.Description
                from moviexgenres as mg
                Join movies as m 
                on m.Id=mg.MovieId
                join genres as g
                on g.Id=mg.GenreId
                order by m.Id desc;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                

                $MovieList=[];
                $y=count($resultSet);
                if($y!=0)
                    for ($x=0;$x<=$y;$x++)
                    {  
                        $Movie = new Movie();
                        $Movie->setId($resultSet[$x]["MovieId"]);
                        $Movie->setName($resultSet[$x]["Name"]);
                        $Movie->setDuration($resultSet[$x]["Duration"]);
                        $Movie->setLanguage($resultSet[$x]["Language"]);
                        $Movie->setImage($resultSet[$x]["Image"]);
    
                        while($x<$y&&$Movie->getId()==$resultSet[$x]["MovieId"]){
                            $genre= new Genre();
                            $genre->setId($resultSet[$x]["GenreId"]);
                            $genre->setDescription($resultSet[$x]["Description"]);
            
                            $Movie->addGenre($genre);
                            $x++;
                        }
                        array_push($MovieList,$Movie);
                    }
                
                
                

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

