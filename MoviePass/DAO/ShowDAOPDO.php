<?php namespace DAO;

use Models\Show as Show;
use DAO\Connection as Connection;
use DAO\Helper as Helper;
use \Exception as Exception;

class ShowDAOPDO extends Helper{

  
    private $connection;
    
    
    public function GetById($Id)
    {
        try
        {
            $query = "select
            s.Id as ShowId,
            s.DateTime,
            s.RoomId as RoomIdShow,
            m.Id as MovieId,
            m.Name as MovieName,
            m.Duration,
            m.Language,
            m.Image,
            g.Description as Genre,
            g.Id as GenreId
            from Shows as s
             left join Movies as m
            on s.MovieId=m.Id AND m.Active=1 
             left join MovieXGenres as mg
            on mg.MovieId=m.Id
             left join Genres as g
            on mg.GenreId = g.Id
            where s.Id =".$Id."  
            order by s.Id,m.Id,g.Id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $show=$this->GenerateClass($resultSet);
            
            if(!empty($show)){
                $tickets=$this->GetTicketsbyShow($show[0]->getId());
                foreach($tickets as $ticket){
                    
                    $show[0]->addTickets($ticket);
                }
            }
  
            return array_shift($show);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetTicketsbyShow($showId){
        try
        {
            $tickets=[];

            $query ="select
            t.Id as TicketId,
            t.ShowId as ShowIdTicket,
            t.Value,
            t.Seat
            from tickets as t
            where t.ShowId= ".$showId.";";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            
            foreach($resultSet as $row){
                $ticket= $this->CreateTicket($row);
                array_push($tickets,$ticket);
            }
            
  
            return $tickets;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }



    public function GetTicketInfoByShowId($id){
       
        try
        {
            $query = "Select 
            c.Id as CineId,
            c.Name as CineName,
            c.Address,
            c.Capacity as CineCapacity,
            c.Value,
            r.Id as RoomId,
            r.Capacity as RoomCapacity,
            r.Name as RoomName,
            s.Id as ShowId,
            s.DateTime,
            m.Id as MovieId,
            m.Name as MovieName,
            m.Duration,
            m.Language,
            m.Image,
            g.Description as Genre,
            g.Id as GenreId
            from Cines as c
             left join Rooms as r
            on r.CineId=c.Id
             left join Shows as s
            on s.RoomId=r.Id AND s.Active=1
             left join Movies as m
            on s.MovieId=m.Id AND m.Active=1 
             left join MovieXGenres as mg
            on mg.MovieId=m.Id
             left join Genres as g
            on mg.GenreId = g.Id
            where s.Id = ".$id."  
            order by c.Id ,r.Id,s.Id,m.Id,g.Id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $cine=$this->GenerateClass($resultSet);
            
  
            return array_shift($cine);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    

    public function GetAllActiveShows(){
        try
        {
            $query = "select
            s.Id as ShowId,
            s.DateTime,
            s.RoomId as RoomIdShow,
            m.Id as MovieId,
            m.Name as MovieName,
            m.Duration,
            m.Language,
            m.Image,
            g.Description as Genre,
            g.Id as GenreId
            from Shows as s
             left join Movies as m
            on s.MovieId=m.Id AND m.Active=1 
             left join MovieXGenres as mg
            on mg.MovieId=m.Id
             left join Genres as g
            on mg.GenreId = g.Id
            where s.Active=1 
            order by s.Id,m.Id,g.Id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $shows=$this->GenerateClass($resultSet);
            return $shows;
        }catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetOldestShowTime(){
        $query = "select
            MIN(s.DateTime)
            from Shows as s
            where s.Active =1 ;";

            $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $result=$resultSet[0];
                return $result;
    }
    

    public function ModifyShow($Show)
        {
            try
            {
                if($Show->GetMovie()==null){
                    $query = "UPDATE Shows SET MovieId= null WHERE Shows.Id =".$Show->getId().";";
                }else{
                    $query = "UPDATE Shows SET MovieId= ".$Show->getMovie()->getId()." WHERE Shows.Id =".$Show->getId().";";
                }
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function SoftDeleteShow($show){
            try
            { 
                $query = "UPDATE Shows SET Active=0 WHERE Id= ".$show->getId().";";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function RemoveShow($show){
            try
            { 
                $query = "Delete from Shows WHERE Id= ".$show->getId().";";

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
            $query = "INSERT INTO Shows (DateTime, MovieId,RoomId) VALUES (:DateTime, :MovieId, :RoomId);";

            $date=$Show->getDateTime();
            $parameters["DateTime"] =$date->format('Y-m-d H:i:s');
            if($Show->getMovie()!=null){
                $parameters["MovieId"] = $Show->getMovie()->getId();
            }else{
                $parameters["MovieId"] = null;
            }

            $parameters["RoomId"] = $Show->getRoom()->getId();
            
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

