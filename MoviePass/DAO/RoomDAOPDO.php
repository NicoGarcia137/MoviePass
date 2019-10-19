<?php namespace DAO;

use Models\Room as Room;
use DAO\Connection as Connection;
class RoomDAOPDO {

  
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
                    $Room->setName($row["Name"]);
                    $Room->setCapacity($row["Capacity"]);
                    $Room->setCineId($row["CineId"]);
                    
                    array_push($RoomList, $Room);
                }

                return $RoomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getRoomIdByName($Name){
            try
            {

                $query = "SELECT R.Id FROM Rooms as R where R.Name="."'".$Name."'".";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
               
                return $resultSet[0][0];
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
                $Room->setName($row["Name"]);
                $Room->setCapacity($row["Capacity"]);
                $Room->setCineId($row["CineId"]);
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
        {
            
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
               

                $query = "INSERT INTO Rooms (Capacity, Name,CineId) VALUES (:Capacity, :Name, :CineId);";
                 
                $parameters["Capacity"] = $Room->getCapacity();
                $parameters["Name"] = $Room->getName();
                $parameters["CineId"] = $Room->getCineId();
               
                $this->connection = Connection::GetInstance();                
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
 } 

?>

