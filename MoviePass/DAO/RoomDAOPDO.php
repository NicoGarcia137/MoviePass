<?php namespace DAO;

use DAO\IRoomDAO as IRoomDAO;
use Models\Room as Room;
use DAO\Connection as Connection;
class RoomDAOPDO implements IRoomDAO{

  
    private $connection;
    
    public function GetAll()
        {
            try
            {
                $RoomList = array();

                $query = "SELECT * FROM "."Rooms;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Room = new Room();
                    
                    $Room->setId($row["Id"]);
                    $Room->setShows($row["Shows"]);
                    $Room->setCapacity($row["Capacity"]);
                    
                    array_push($RoomList, $Room);
                }

                return $RoomList;
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

            $query = "SELECT * FROM Rooms WHERE Rooms.Id =".$Id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {                
                $Room = new Room();
                    
                $Room->setId($row["Id"]);
                $Room->setShows($row["Shows"]);
                $Room->setCapacity($row["Capacity"]);
            }
  
            return $Room;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function ModifyRoom($Room)
        {
            try
            {
                $query = "UPDATE Rooms SET Shows= "."'".$Room->getShows()."'"." ,Capacity= "."'".$Room->getCapacity()."'"." WHERE Id= ".$Room->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveRoom($Room)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Rooms WHERE Id="."'".$Room->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Room)
        {
            try
            {
               

                $query = "INSERT INTO Rooms (Capacity, Shows) VALUES (:Capacity, :Shows);";
                 
                $parameters["Capacity"] = $Room->getCapacity();
                $parameters["Shows"] = $Room->getShows();
               
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

