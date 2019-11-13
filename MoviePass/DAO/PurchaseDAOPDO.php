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
            
            $query = "select p.Id as PurchaseId,p.UserEmail,p.DateTime,p.TotalValue,t.ShowId as ShowIdTicket,t.Value
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
  
    public function Add($Purchase)
    {
        try
        {
            $query = "INSERT INTO Purchases (DateTime, TotalValue,UserEmail) VALUES (:DateTime, :TotalValue,:UserEmail);";
        
            $date=$Purchase->getDateTime();
            $parameters["DateTime"] =$date->format('Y-m-d H:i:s');
            var_dump($Purchase);
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
            $query = "INSERT INTO Tickets (ShowId,Value, PurchaseId) VALUES (:ShowId,:Value, (SELECT MAX(id) FROM purchases));";
        
            $parameters["ShowId"] =$ticket->getShow()->getId();
            $parameters["Value"]=$ticket->getValue();
                          
            $this->connection->ExecuteNonQuery($query, $parameters);
    }

 } 
?>
