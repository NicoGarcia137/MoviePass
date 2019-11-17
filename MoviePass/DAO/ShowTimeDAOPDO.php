<?php namespace DAO;

use DAO\Connection as Connection;
use DAO\Helper as Helper;
class ShowTimeDAOPDO extends Helper{

  
    private $connection;
    
    
    public function GetShowTime($showTime,$roomId)
    {
        try
        {   
            $showTimeExist=null;
            $query = "select
            s.ShowTime as ShowTime,
            s.RoomId
            from ShowTimes as s
            where s.ShowTime = '".$showTime->getFormat('H:i')."' AND s.RoomId= ".$roomId." ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            $showTimeExist=$resultSet[0];
        
  
            return array_shift($showExist);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetAllByRoom($roomId)
    {
        try
        {   
            $showTimes=[];
            $query = "select
            s.ShowTime as ShowTime,
            s.RoomId
            from ShowTimes as s
            where s.RoomId= " .$roomId." ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            $showTimes=$resultSet[0];
  
            return array_shift($showTimes);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function RemoveShowTime($showTime,$roomId)
    {
        try
        {
            
            $query = "DELETE FROM ShowTimes WHERE ShowTime = :ShowTime  AND RoomId= :RoomId ;";

            $parameters['ShowTime']=$showTime->getFormat('H:i');
            $parameters['RoomId']=$roomId;
            
            $this->connection = Connection::GetInstance();                
            $this->connection->ExecuteNonQuery($query,$parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($showTime,$roomId)
    {
        try
        {
            $query = "INSERT INTO ShowTimes (ShowTime,RoomId) VALUES (:ShowTime,:RoomId);";
            
            $parameters['ShowTime']=$showTime->getFormat('H:i');
            $parameters['RoomId']=$roomId;
            
            $this->connection = Connection::GetInstance();                
            $this->connection->ExecuteNonQuery($query,$parameters);
            
        }
        catch(Exception $ex)
        {
            var_dump($ex);
        }
    }


 } 

?>