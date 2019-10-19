<?php namespace DAO;

use Models\MovieXGenre as MovieXGenre;
use DAO\Connection as Connection;
class MovieXGenreDAOPDO {

  
    private $connection;
    
    public function GetAll()
        {
            try
            {
                $MovieXGenreList = array();

                $query = "SELECT * FROM "."MovieXGenres;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $MovieXGenre = new MovieXGenre();
                    
                    
                    $MovieXGenre->setId($row["Id"]);
                    $MovieXGenre->setMovieId($row["MovieId"]);
                    $MovieXGenre->setGenreId($row["GenreId"]);
                    
                    array_push($MovieXGenreList, $MovieXGenre);
                }

                return $MovieXGenreList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
    public function GetById($Id)
    {
        try
        {         

            $query = "SELECT * FROM MovieXGenres WHERE MovieXGenres.Id =".$Id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {                
                $MovieXGenre = new MovieXGenre();
                    
                $MovieXGenre->setId($row["Id"]);
                $MovieXGenre->setMovieId($row["MovieId"]);
                $MovieXGenre->setGenreId($row["GenreId"]);
            }
  
            return $MovieXGenre;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function ModifyMovieXGenre($MovieXGenre)
        {
            try
            {
                $query = "UPDATE MovieXGenres SET GenreId= "."'".$MovieXGenre->getGenreId()."'"." WHERE Id= ".$MovieXGenre->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveMovieXGenre($MovieXGenre)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM MovieXGenres WHERE Id="."'".$MovieXGenre->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($MovieXGenre)
        {
            try
            {
               

                $query = "INSERT INTO MovieXGenres (MovieId,GenreId) VALUES (:MovieId,:GenreId);";
                 
                $parameters["MovieId"] = $MovieXGenre->getMovieId();
                $parameters["GenreId"] = $MovieXGenre->getGenreId();
               
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

