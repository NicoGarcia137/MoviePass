<?php 
namespace DAO;
use Models\Cine as Cine;
use Models\Room as Room;
use Models\Show as Show;
use Models\Movie as Movie;
use Models\Genre as Genre;

abstract class Helper{

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
        foreach($shows as $show){
            $newRoom->addShow($show);
        }
        return $newRoom;
    }


    public function CreateShow($show,$movie){
        $newShow= new Show();
        $newShow->setId($show['ShowId']);
        $newShow->setDateTime($show['DateTime']);
        $newShow->setTickets($show['Tickets']);
        $newShow->setMovie($movie);
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