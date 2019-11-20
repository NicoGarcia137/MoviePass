<?php namespace DAO;

use Models\Genre as Genre;
use Models\Movie as Movie;
use DAO\Connection as Connection;
use \Exception as Exception;
use DAO\Helper as Helper;

class BillboardDAOPDO extends Helper{

  
    private $connection;


    
    public function GetAllMovies()
        {
            try
            {
                $MovieList = array();

                $query = 
                "Select 
                m.Id as MovieId,
                m.Name as MovieName,
                m.Duration,
                m.Language,
                m.Image,
                g.Id as GenreId,
                g.Description as Genre
                from moviexgenres as mg
                left join movies as m 
                on m.Id=mg.MovieId AND m.Active=1 
                left join genres as g
                on g.Id=mg.GenreId
                order by m.Id desc;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                

                $MovieList=[];
                $y=count($resultSet);
                $x=0;
                if($y>$x){
                    while($x<$y)
                    {  
                        
                        $Movie=$this->CreateMovie($resultSet[$x],array());
                        
                        while($x<$y&&$Movie->getId()==$resultSet[$x]["MovieId"]){
                            $genre= $this->CreateGenre($resultSet[$x]);
                            $Movie->addGenre($genre);
                            $x++;
                        }
                        array_push($MovieList,$Movie);
                        
                        
                    }
                }
                return $MovieList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    


    public function GetMovieById($id)
    {
        try
            {

                $query = 
                "Select 
                m.Id as MovieId,
                m.Name as MovieName,
                m.Duration,
                m.Language,
                m.Image,
                g.Id as GenreId,
                g.Description as Genre
                from moviexgenres as mg
                left join movies as m 
                on m.Id=mg.MovieId AND m.Active=1 
                left join genres as g
                on g.Id=mg.GenreId
                where m.Id = ".$id."
                order by m.Id desc;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
            

                $Movie=null;
                $y=count($resultSet);
                $x=0;
                if($y!=$x){
                    $Movie=$this->CreateMovie($resultSet[$x],array());
                        
                    while($x<$y&&$Movie->getId()==$resultSet[$x]["MovieId"]){
                        $genre= $this->CreateGenre($resultSet[$x]);
                        $Movie->addGenre($genre);
                        $x++;
                    }
                }
                return $Movie;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


    public function GetAllMoviesInshows(){
        try
            {

                $query = 
                "select distinct
                s.MovieId
                from Shows as s
                where s.MovieId is not null AND s.Active=1;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $MovieIds=[];
                foreach($resultSet as $movieId){
                    array_push($MovieIds,$movieId['MovieId']);
                }
                
                return $MovieIds;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function GetAllMoviesInshowsByDateTime($date){
        try
            {

                $query = 
                "select distinct
                s.MovieId
                from Shows as s
                where s.MovieId is not null AND s.Active=1 AND DATE(s.DateTime) = '".$date->format('Y-m-d')."';";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $MovieIds=[];
                foreach($resultSet as $movieId){
                    array_push($MovieIds,$movieId['MovieId']);
                }
                
                return $MovieIds;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


public function GetAllGenres(){
        try
            {

                $query = 
                "select 
                g.Id as GenreId,
                g.Description as Description
                from Genres as g;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $Genres=[];
                foreach($resultSet as $Genre){
                    $newGenre= new Genre();
                    $newGenre->setId($Genre['GenreId']);
                    $newGenre->setDescription($Genre['Description']);
                    array_push($Genres,$newGenre);
                }
                
                return $Genres;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


    public function GetAllMoviesInshowsByGenres(...$genres){
        try
            {
                $query = 
                "select distinct
                s.MovieId
                from Shows as s
                join moviexgenres as mg
                on s.MovieId=mg.MovieId
                where s.MovieId is not null AND s.Active=1 AND mg.GenreId IN (".implode(",",$genres[0]).");";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $MovieIds=[];
                foreach($resultSet as $movieId){
                    array_push($MovieIds,$movieId['MovieId']);
                }
                
                return $MovieIds;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

 
    public function RemoveMovie($Movie)
    {
        try
        { 
            
            $query = "Update Movies set Active=false where Id=".$Movie->getId().";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Movie)
        {
            try
            {
               

                $query = "INSERT INTO Movies (Id,Name, Duration, Language,Image) VALUES (:Id,:Name, :Duration, :Language, :Image);";
                
                $parameters["Id"] = $Movie->getId();
                $parameters["Name"] = $Movie->getName();
                $parameters["Duration"] = $Movie->getDuration();
                $parameters["Language"] = $Movie->getLanguage();
                $parameters["Image"] = $Movie->getImage();
                
                $this->connection = Connection::GetInstance();                
                $this->connection->ExecuteNonQuery($query, $parameters);
               
                foreach($Movie->getGenres() as $genre){

                    $query2 = "INSERT INTO MovieXGenres (MovieId,GenreId) VALUES (:MovieId, :GenreId);";
                    
                    $parameters2["MovieId"]= $Movie->getId();
                    $parameters2["GenreId"]= $genre;
                    
                    $this->connection = Connection::GetInstance();                
                    $this->connection->ExecuteNonQuery($query2, $parameters2);
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
       
 } 

?>

