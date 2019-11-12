<?php 
namespace DAO;
use Models\Cine as Cine;
use Models\Room as Room;
use Models\Show as Show;
use Models\Movie as Movie;
use Models\Genre as Genre;
use \DateTime as DateTime;


abstract class Helper{




    public function GenerateClass($resultSet){
        $y=count($resultSet);
        $x=0;
        $result=null;

        if(isset($resultSet[$x]['CineId'])){

            $result=$this->GenerateCine($resultSet,$x,$y);

        }else if(isset($resultSet[$x]['RoomId'])){

            $result=$this->GenerateRoom($resultSet,$x,$y);

        }else if(isset($resultSet[$x]['ShowId'])){

            $result=$this->GenerateShow($resultSet,$x,$y);

        }
        
        return $result;
    }

    public function GenerateCine($resultSet,$x,$y){
        $CineList=[];
            while($x<$y){
                $cine=$this->CreateCine($resultSet[$x],array());

                while($x<$y && $resultSet[$x]['CineId']==$cine->getId()){
                    if($resultSet[$x]['RoomId']!=null){
                        $room=$this->CreateRoom($resultSet[$x],array());

                        while($x<$y && $resultSet[$x]['RoomId']==$room->getId() && $resultSet[$x]['CineId']==$cine->getId()){
                            if($resultSet[$x]['ShowId']!=null){
                                $show=$this->CreateShow($resultSet[$x],array());

                                while($x<$y && $resultSet[$x]['ShowId']==$show->getId()&& $resultSet[$x]['RoomId']==$room->getId() && $resultSet[$x]['CineId']==$cine->getId()){
                                    if($resultSet[$x]['MovieId']!=null){
                                        $movie=$this->CreateMovie($resultSet[$x],array());
                                        
                                        while($x<$y&& $movie->getId()==$resultSet[$x]["MovieId"] && $resultSet[$x]['ShowId']==$show->getId()&& $resultSet[$x]['RoomId']==$room->getId()  && $resultSet[$x]['CineId']==$cine->getId())
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
                               $room->addShow($show);
                            }else{
                                $x++;
                            }
                        }
                        $cine->addRoom($room);
                    }else{
                        $x++;
                    }
                }
                    
                    array_push($CineList, $cine);
            }
            return $CineList;
    }

    public function GenerateRoom($resultSet,$x,$y){
        $RoomList=[];
        while($x<$y){
            $room=$this->CreateRoom($resultSet[$x],array());

            while($x<$y && $resultSet[$x]['RoomId']==$room->getId()){
                if($resultSet[$x]['ShowId']!=null){
                    $show=$this->CreateShow($resultSet[$x],array());

                    while($x<$y && $resultSet[$x]['ShowId']==$show->getId()&& $resultSet[$x]['RoomId']==$room->getId()){
                        if($resultSet[$x]['MovieId']!=null){
                            $movie=$this->CreateMovie($resultSet[$x],array());
                            
                            while($x<$y&& $movie->getId()==$resultSet[$x]["MovieId"] && $resultSet[$x]['ShowId']==$show->getId()&& $resultSet[$x]['RoomId']==$room->getId())
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
                    $room->addShow($show);
                }else{
                    $x++;
                }
            }
            array_push($RoomList,$room);
        }
        return $RoomList;
    }

    public function GenerateShow($resultSet,$x,$y){
        $showList=[];
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
            array_push($showList,$show);
        }
        return $showList;
    }




    public function CreateCine($cine,$rooms){
        $newCine=new Cine();
        $newCine->setId($cine["CineId"]);
        $newCine->setName($cine["CineName"]);
        $newCine->setAddress($cine["Address"]);
        $newCine->setCapacity($cine["CineCapacity"]);
        $newCine->setValue($cine["Value"]);
        foreach($rooms as $room){
            $newCine->addRoom($room);
        }
        return $newCine;
    }

    public function CreateRoom($room,$shows){
        $newRoom= new Room();
        $newRoom->setId($room['RoomId']);
        $newRoom->setCapacity($room['RoomCapacity']);
        $newRoom->setName($room['RoomName']);
        $cine= new Cine();
        if(isset($room['CineIdRoom'])){
            $cine->setId($room['CineIdRoom']);
        }else{
            $cine->setId($room['CineId']);
        }
        $newRoom->setCine($cine);
        foreach($shows as $show){
            $newRoom->addShow($show);
        }
        return $newRoom;
    }


    public function CreateShow($show,$movie){
        $newShow= new Show();
        $newShow->setId($show['ShowId']);
        $date= new DateTime($show['DateTime']);
        $newShow->setDateTime($date);
        $newShow->setTickets($show['Tickets']);
        $newShow->setMovie($movie);
        $room= new Room();
        if(isset($show['RoomIdShow'])){
            $room->setId($show['RoomIdShow']);
        }else{
            $room->setId($show['RoomId']);
        }
        $newShow->setRoom($room);
        return $newShow;
    }

    public function CreateMovie($movie,$genres){
        $newMovie = new Movie();
        $newMovie->setId($movie["MovieId"]);
        $newMovie->setName($movie["MovieName"]);
        $newMovie->setDuration($movie["Duration"]);
        $newMovie->setLanguage($movie["Language"]);
        $newMovie->setImage($movie["Image"]);
        foreach($genres as $genre){
            $newMovie->addGenre($genre);
        }
        return $newMovie;
    }

    public function CreateGenre($genre){
        $newGenre= new Genre();
        $newGenre->setId($genre["GenreId"]);
        $newGenre->setDescription($genre["Genre"]);
        return $newGenre;
    }



}
?>