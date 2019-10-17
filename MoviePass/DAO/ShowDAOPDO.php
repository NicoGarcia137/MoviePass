<?php namespace DAO;

use DAO\IShowDAO as IShowDAO;
use Models\Show as Show;
use DAO\Connection as Connection;
class ShowDAOPDO implements IShowDAO{

  
    private $connection;
    
    public function GetAll()
        {
            try
            {
                $ShowList = array();

                $query = "SELECT * FROM "."Shows;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Show = new Show();
                    
                    $Show->setId($row["Id"]);
                    $Show->setDateTime($row["DateTime"]);
                    $Show->setPeliculas($row["Peliculas"]);
                    $Show->setTickets($row["Tickets"]);

                    array_push($ShowList, $Show);
                }

                return $ShowList;
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
           

            $query = "SELECT * FROM Shows WHERE Shows.Id =".$Id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {                
                $Show = new Show();
                    
                $Show->setId($row["Id"]);
                $Show->setDateTime($row["DateTime"]);
                $Show->setPeliculas($row["Peliculas"]);
                $Show->setTickets($row["Tickets"]);
            }
  
            return $Show;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function ModifyShow($Show)
        {
            try
            {
                $comilla="'";
                $query = "UPDATE Shows SET DateTime= "."'".$Show->getDateTime()."'"." ,Peliculas= "."'".$Show->getPeliculas()."'"." ,Tickets= ".$Show->getTickets()." WHERE Id= ".$Show->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveShow($Show)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Shows WHERE Id="."'".$Show->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Show)
        {
            try
            {
               

                $query = "INSERT INTO Shows (Date Time, Peliculas, Tickets) VALUES (:DateTime, :Peliculas, :Tickets);";
                
                $parameters["DateTime"] = $Show->getDateTime();
                $parameters["Peliculas"] = $Show->getPeliculas();
                $parameters["Tickets"] = $Show->getTickets();
               
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

