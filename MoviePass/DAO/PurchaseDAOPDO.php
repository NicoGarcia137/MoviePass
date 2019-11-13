<?php namespace DAO;

use Models\Purchase as Purchase;
use DAO\Connection as Connection;
use DAO\Helper as Helper;
class PurchaseDAOPDO extends Helper{

  
    private $connection;
    

    public function getTicketsByShowId($Id)
    {
        try
        {         

            $query = "select Id from tickets where ShowId=".$Id.";";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            
  
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getPurchaseByUser($user){
        try
        {         
            
            $query = "select p.Id as PurchaseId,p.UserEmail,p.CineId as CineIdParchuse,p.DateTime,p.TotalValue,t.Id as TicketId,t.ShowId as ShowIdTicket,t.Value,t.Seat
                        from purchases as p
                        join tickets as t
                        on t.PurchaseId=p.Id
                        where p.UserEmail='".$user->getEmail()."';";

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query);
            
            $purchases=$this->GenerateClass($resultSet);
            

            return $purchases;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetOccupiedSeatsByShowId($showId){
        try
        {         
            
            $query = "select Seat from tickets where ShowId=".$showId.";";

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query);
            $occupiedSeats=[];
            foreach($resultSet as $row){
                array_push($occupiedSeats,$row['Seat']);
            }

            return $occupiedSeats;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Purchase)
    {
        try
        {
            $query = "INSERT INTO Purchases (CineId,DateTime, TotalValue,UserEmail) VALUES (:CineId,:DateTime, :TotalValue,:UserEmail);";
           
            
            $date=$Purchase->getDateTime();
            $parameters["CineId"]=$Purchase->getCine()->getId();
            $parameters["DateTime"] =$date->format('Y-m-d H:i:s');
            $parameters["TotalValue"]=$Purchase->getTotalValue();
            $parameters["UserEmail"]=$Purchase->getUser()->getEmail();
            
            $this->connection = Connection::GetInstance();                
            $this->connection->ExecuteNonQuery($query, $parameters);
         
            foreach($Purchase->getTickets() as $ticket){
                $this->AddTicket($ticket);
            }
            
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    private function AddTicket($ticket){
            $query = "INSERT INTO Tickets (ShowId,Value,Seat, PurchaseId) VALUES (:ShowId,:Value,:Seat, (SELECT MAX(id) FROM purchases));";
        
            $parameters["ShowId"] =$ticket->getShow()->getId();
            $parameters["Value"]=$ticket->getValue();
            $parameters["Seat"]=$ticket->getSeat();
                          
            $this->connection->ExecuteNonQuery($query, $parameters);
    }

 } 
?>
