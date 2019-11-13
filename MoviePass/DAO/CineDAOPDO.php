<?php namespace DAO;

use DAO\ICineDAO as ICineDAO;
use Models\Cine as Cine;
use Models\Room as Room;
use Models\Show as Show;
use Models\Movie as Movie;
use Models\Genre as Genre;
use DAO\Connection as Connection;
use \Exception as Exception;
use DAO\Helper as Helper;

class CineDAOPDO extends Helper implements ICineDAO{

  
    private $connection;
    public function GetAll()
        {
            try
            {
                $CineList = array();

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
                order by c.Id ,r.Id,s.Id,m.Id,g.Id;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $CineList=$this->GenerateClass($resultSet);

                return $CineList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
        public function GetCinesAndShowsByMovie($movie)
        {
            try
            {
                $id=$movie->getId();
                $CineList = array();

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
                where m.Id=".$id."
                order by c.Id ,r.Id,s.Id,m.Id,g.Id;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $CineList=$this->GenerateClass($resultSet);

                return $CineList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function GetByName($name)
        {
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
                where c.Name = '".$name."'
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
   

    public function GetById($id)
    {
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
            where c.Id = ".$id."
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
    
    public function ModifyCine($Cine)
        {
            try
            {
               
                $query = "UPDATE Cines SET Name= "."'".$Cine->getName()."'"." ,Address= "."'".$Cine->getAddress()."'"." ,Capacity= ".$Cine->getCapacity()." ,Value= ".$Cine->getValue()." WHERE Id= ".$Cine->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveCine($Cine)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Cines WHERE Id="."'".$Cine->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Cine)
        {
            try
            {
               

                $query = "INSERT INTO Cines (Name, Address, Capacity,Value) ValueS (:Name, :Address, :Capacity, :Value);";
                
                $parameters["Name"] = $Cine->getName();
                $parameters["Address"] = $Cine->getAddress();
                $parameters["Capacity"] = $Cine->getCapacity();
                $parameters["Value"] = $Cine->getValue();
               
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

