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
            s.RoomId,
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
            $show=null;
            $y=count($resultSet);


           

            $x=0;
            while($x<$y){
                $show=$this->CreateShow($resultSet[$x],array());

                while($x<$y && $resultSet[$x]['ShowId']==$show->getId()){
                    if($resultSet[$x]['MovieId']!=null){
                        $movie=$this->CreateMovie($resultSet[$x],array());
                        
                        while($x<$y&& $movie->getId()==$resultSet[$x]["MovieId"] && $resultSet[$x]['ShowId']==$show->getId())
                        {
                            if($resultSet[$x]['GenreId']!=null)
                            {
                                $genre=$this->CreateGenre($resultSet[$x]);
                                $movie->addGenre($genre);
                                $x++;
                            }else{
                                $x++;
                            }
                        }
                        $show->setMovie($movie);
                        
                    }else{
                        $x++;
                    }
                }
            }
        
  
            return $show;
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
                $query = "UPDATE Shows SET MovieId=". $Show->getMovie()->getId()." WHERE Shows.Id = ". $Show->getId().";";

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
                
                $parameters["DateTime"] = $Show->getDateTime();
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

