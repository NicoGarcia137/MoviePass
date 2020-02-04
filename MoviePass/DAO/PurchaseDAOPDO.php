<?php namespace DAO;

use Models\Purchase as Purchase;
use DAO\Connection as Connection;
use DAO\Helper as Helper;
use Models\Cine as Cine;
use \Exception as Exception;

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

    public function getAllPurchasesForCine($date1,$date2){
        try
        {         
            
            $query = "select
            sum(p.TotalValue) as Value,
            p.CineId as Cine
            from purchases as p
            where p.DateTime >= '".$date1->format('Y-m-d H:m:s')."' AND p.DateTime <= '".$date2->format('Y-m-d H:m:s')."'
            group by p.CineId;";

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query);

            
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getAllPurchasesForMovie($date1,$date2){
        try
        {         
            
            $query = "select
            sum(t.Value) as Value,
            m.Id as Movie
            from tickets as t
            join shows as s
            on s.Id=t.ShowId
            join movies as m
            on m.Id=s.MovieId
            join purchases as p
            on p.Id=t.PurchaseId
            where p.DateTime >= '".$date1->format('Y-m-d H:m:s')."' AND p.DateTime <= '".$date2->format('Y-m-d H:m:s')."'
            group by s.MovieId";

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query);
    
            
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    private function getCineByIdForParchuse($id){
        try
        {         
            
            $query = "Select 
            c.Id as CineId,
            c.Name as CineName,
            c.Address,
            c.Value
            from cines as c
            where c.Id =".$id.";";
            
            $resultSet = $this->connection->Execute($query);
            $cine=$resultSet[0];
            $newCine=new Cine();
            $newCine->setId($cine["CineId"]);
            $newCine->setName($cine["CineName"]);
            $newCine->setAddress($cine["Address"]);
            $newCine->setValue($cine["Value"]);

            return $newCine;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    


    public function CheckTicketExist($showId,$seats){
        try
        {         
            
            $query = "SELECT t.Id as tickets FROM Tickets as t
                     WHERE t.ShowId= ".$showId." AND t.Seat IN (".implode(",",$seats[0]).");";

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query);
            
            return $resultSet;
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
