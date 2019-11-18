<?php namespace DAO;

use Models\Purchase as Purchase;
use DAO\Connection as Connection;
use DAO\Helper as Helper;
class PurchaseDAOPDO extends Helper{

  
    private $connection;
    


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

    public function CheckTicketExist($showId,$seats){
        try
        {         
            $query = "SELECT COUNT(*) as tickets FROM Tickets as t
                     WHERE t.ShowId= :ShowId AND t.Seat IN (:Seats);";


            $parameters["ShowId"]=$showId;
            $seats=implode(",", $seats[0]);
            $parameters["Seats"] =$seats;

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query,$parameters);
            $result=0;
            if($resultSet[0]['tickets']!=0){
                $result=$seats[0];
            }
            return $result;
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
