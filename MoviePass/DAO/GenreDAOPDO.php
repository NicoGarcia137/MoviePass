<?php namespace DAO;

use DAO\IGenreDAO as IGenreDAO;
use Models\Genre as Genre;
use DAO\Connection as Connection;
class GenreDAOPDO implements IGenreDAO{

  
    private $connection;
    
    public function GetAll()
        {
            try
            {
                $GenreList = array();

                $query = "SELECT * FROM "."Genres;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Genre = new Genre();
                    
                    $Genre->setId($row["Id"]);
                    $Genre->setDescription($row["Description"]);
                    
                    array_push($GenreList, $Genre);
                }

                return $GenreList;
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

            $query = "SELECT * FROM Genres WHERE Genres.Id =".$Id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {                
                $Genre = new Genre();
                    
                $Genre->setId($row["Id"]);
                $Genre->setShows($row["Shows"]);
            }
  
            return $Genre;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function ModifyGenre($Genre)
        {
            try
            {
                $query = "UPDATE Genres SET Description= "."'".$Genre->getDescription()."'"." WHERE Id= ".$Genre->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveGenre($Genre)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Genres WHERE Id="."'".$Genre->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Genre)
        {
            try
            {
               

                $query = "INSERT INTO Genres (Description) VALUES (:Description);";
                 
                $parameters["Description"] = $Genre->getDescription();
               
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

