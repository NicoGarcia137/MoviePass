<?php namespace DAO;

use DAO\Connection as Connection;
use DAO\Helper as Helper;
class ShowTimeDAOPDO extends Helper{

  
    private $connection;
    
    
    public function GetShowTime($showTime,$CineId)
    {
        try
        {   
            $query = "select
            s.ShowTime as ShowTime,
            s.CineId
            from ShowTimes as s
            where s.ShowTime = '".$showTime->Format('H:i')."' AND s.CineId= ".$CineId." ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
  
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    
    public function GetAllByCine($cineId)
    {
        try
        {   
            $showTimes=[];
            $query = "select distinct
            s.ShowTime as ShowTime
            from ShowTimes as s
            where s.CineId= " .$cineId." ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
  
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    
    public function RemoveShowTime($showTime,$CineId)
    {
        try
        {
            
            $query = "DELETE FROM ShowTimes WHERE ShowTime = :ShowTime  AND CineId= :CineId ;";

            $parameters['ShowTime']=$showTime->Format('H:i');
            $parameters['CineId']=$CineId;
            
            $this->connection = Connection::GetInstance();                
            $this->connection->ExecuteNonQuery($query,$parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($showTime,$CineId)
    {
        try
        {
            $query = "INSERT INTO ShowTimes (ShowTime,CineId) VALUES (:ShowTime,:CineId);";
            
            $parameters['ShowTime']=$showTime->Format('H:i');
            $parameters['CineId']=$CineId;
            
            $this->connection = Connection::GetInstance();                
            $this->connection->ExecuteNonQuery($query,$parameters);
            
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }


 } 

?>