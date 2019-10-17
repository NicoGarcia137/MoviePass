<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    use Models\Genero as Genre;
    define("KEY","659f1569858f26bfcf78a91dd24bec94");

    class MovieController
    {
        private $MovieDAO;

        public function __construct()
        {
            $this->MovieDAO = new MovieDAO();
        }


        public function GetMoviesFromApi(){
            $url="https://api.themoviedb.org/3/movie/now_playing?api_key=659f1569858f26bfcf78a91dd24bec94&page=1";
            $moviesJson=file_get_contents($url);
            $moviesInc=json_decode($moviesJson,true);
            $movies=[];
            
                foreach($moviesInc['results'] as $movie){
                    $newMovie=new Movie();              
                    $newMovie->setName($movie['original_title']);
                    $newMovie->setDuration($movie['popularity']);
                    $newMovie->setLanguage($movie['original_language']);
                    $newMovie->setImage($movie['poster_path']);
                    $genres=$movie['genre_ids'];
                    $newMovie->setGenre($this->GetMovieGenres($genres));
                    array_push($movies,$newMovie);
                }
            
            require_once(VIEWS_PATH."moviesApi.php");
        }

        public function GetMovieGenres($genres){
            $url="https://api.themoviedb.org/3/genre/movie/list?api_key=659f1569858f26bfcf78a91dd24bec94";
            $genresJson=file_get_contents($url);
            $genresListApi=json_decode($genresJson,true);
            $genreFinal=[];
            
            foreach($genres as $genre){
                foreach($genresListApi as $resultg){
                    foreach ($resultg as $genreApi){
                        if($genre==$genreApi['id']){
                            $newGenre=new Genre();
                            $newGenre->setDescripcion($genreApi['name']);
                            array_push($genreFinal,$newGenre);
                        }
                    }
                  
                }
            }
            return $genreFinal;
        }

/*

        public function GetAllMovies(){
           return $this->MovieDAO->GetAll();
        }

        public function GetMovie($name){
            $Movie= $this->MovieDAO->GetByMovieName($name);
            return $Movie;
         }

        public function Add($name, $address, $capacity,$value,$function=null)
        {

            $Movie = new Movie();
            $Movie->setName($name);
            $Movie->setAddress($address);
            $Movie->setCapacity($capacity);
            $Movie->setValue($value);
            $Movie->setFunction($function);



            $this->MovieDAO->Add($Movie);

            $this->ShowAddView();
        }
        
        public function RemoveMovie($name){
            $Movie= $this->GetMovie($name);
            $this->MovieDAO->RemoveMovie($Movie);
            $this->ShowListMoviesAdminView();
        }


        
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addMovie.php");
        }
        public function ShowRemoveView()
        {
            require_once(VIEWS_PATH."removeMovie.php");
        }
        
        public function ShowListMoviesAdminView(){
            $Movies=$this->GetAllMovies();
            require_once(VIEWS_PATH."listarMoviesAdmin.php");
        }
        public function ShowListMoviesView(){
            $Movies=$this->GetAllMovies();
            require_once(VIEWS_PATH."listarMoviesUsuario.php");
        }
    */  }
?>