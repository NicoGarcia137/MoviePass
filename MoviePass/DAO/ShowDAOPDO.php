<?php namespace DAO;

use Models\Show as Show;
use DAO\Connection as Connection;
class ShowDAOPDO {

  
    private $connection;
    
    public function GetAllByRoom($Room)
        {
            try
            {
                $ShowList = array();

                $query = 
                "SELECT * 
                FROM Shows as S
                where S.RoomId=".$Room.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Show = new Show();
                    
                    $Show->setId($row["Id"]);
                    $Show->setDateTime($row["DateTime"]);
                    $Show->setMovie($row["MovieId"]);
                    $Show->setTickets($row["Tickets"]);
                    $Show->setRoom($row["RoomId"]);

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
                $Show->setMovie($row["MovieId"]);
                $Show->setTickets($row["Tickets"]);
                $Show->setRoom($row["RoomId"]);
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
                $query = "UPDATE Shows SET DateTime= "."'".$Show->getDateTime()."'"." ,MovieId= "."'".$Show->getMovie()."'"." ,Tickets= ".$Show->getTickets()." WHERE Id= ".$Show->getId().";";

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
               

                $query = "INSERT INTO Shows (DateTime, MovieId, Tickets,RoomId) VALUES (:DateTime, :MovieId, :Tickets, :RoomId);";
                
                $parameters["DateTime"] = $Show->getDateTime();
                $parameters["MovieId"] = $Show->getMovie();
                $parameters["Tickets"] = $Show->getTickets();
                $parameters["RoomId"] = $Show->getRoom();
               
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

