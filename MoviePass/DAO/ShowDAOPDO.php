<?php namespace DAO;

use Models\Show as Show;
use DAO\Connection as Connection;
use DAO\Helper as Helper;
class ShowDAOPDO extends Helper{

  
    private $connection;
    
    
    public function GetById($Id)
    {
        try
        {
            $query = "select
            s.Id as ShowId,
            s.DateTime,
            s.Tickets,
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
            on s.MovieId=m.Id
            left join MovieXGenres as mg
            on mg.MovieId=m.Id
            left join Genres as g
            on mg.GenreId = g.Id
            where s.Id =".$Id."
            order by s.Id,m.Id,g.Id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $show=$this->GenerateClass($resultSet);
        
  
            return array_shift($show);
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
            s.Tickets,
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
            on s.RoomId=r.Id
            left join Movies as m
            on s.MovieId=m.Id
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
    
    public function ModifyShow($Show)
        {
            try
            {
                //$query = "UPDATE Shows SET DateTime= "."'".$Show->getDateTime()."'"." ,MovieId= "."'".$Show->getMovie()."'"." ,Tickets= ".$Show->getTickets()." WHERE Id= ".$Show->getId().";";
                
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
    public function RemoveShow($Show)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Shows WHERE Id="."'".$Show->getId()."'".";";

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
            $query = "INSERT INTO Shows (DateTime, MovieId, Tickets,RoomId) VALUES (:DateTime, :MovieId, :Tickets, :RoomId);";
            
            $date=$Show->getDateTime();
            $parameters["DateTime"] =$date->format('Y-m-d H:i:s');
            $parameters["MovieId"] = $Show->getMovie();
            $parameters["Tickets"] = $Show->getTickets();
            $parameters["RoomId"] = $Show->getRoom();
            
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

