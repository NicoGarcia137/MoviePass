<?php namespace DAO;

use Models\Room as Room;
use DAO\Connection as Connection;
use DAO\Helper as Helper;
class RoomDAOPDO extends Helper{

  
    private $connection;
    

    public function GetById($Id)
    {
        try
        {         

            $query = "select
            r.Id as RoomId,
            r.Capacity as RoomCapacity,
            r.Name as RoomName,
            r.CineId as CineIdRoom,
            s.Id as ShowId,
            s.DateTime,
            s.Tickets,
            m.Id as MovieId,
            m.Name as MovieName,
            m.Duration,
            m.Language,
            m.Image,
            g.Description as Genre,
            g.Id as GenreId
            from Rooms as r
            left join Shows as s
            on s.RoomId=r.Id
            left join Movies as m
            on s.MovieId=m.Id
            left join MovieXGenres as mg
            on mg.MovieId=m.Id
            left join Genres as g
            on mg.GenreId = g.Id
            where r.Id = ".$Id."
            order by r.Id,s.Id,m.Id,g.Id;";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $room=$this->GenerateClass($resultSet);
  
            return array_shift($room);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetCineIdByRoomId($roomId){
        $query = "select
            r.CineId 
            from Rooms as r
            where r.Id = '".$roomId."' ;";

            $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $result=$resultSet[0];
                return $result;
    }

    public function NameCheck($name,...$id){
        $query = "select
            r.Id as RoomId,
            r.Capacity as RoomCapacity,
            r.Name as RoomName,
            r.CineId as CineIdRoom
            from Rooms as r
            where r.Name = '".$name."' ;";

            $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $result=false;
                if(empty($resultSet)){
                    $result=true;
                }else if($id[0]==$resultSet[0]['RoomId']){
                    $result=true;
                }
                return $result;
    }

    public function GetLastId(){
        try
        {         

            $query = "select auto_increment from information_schema.TABLES where table_schema = 'moviepass' and table_name = 'rooms' ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            $LastId=$resultSet[0]["auto_increment"];

  
            return $LastId;
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
                $query = "UPDATE Rooms SET Name =:Name,Capacity =:Capacity WHERE Id=:Id;";
                
                $parameters["Id"] = $Room->getId();
                $parameters["Name"] = $Room->getName();
                $parameters["Capacity"] = $Room->getCapacity();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameters);
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
                $parameters["CineId"] = $Room->getCine()->getId();
               
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

