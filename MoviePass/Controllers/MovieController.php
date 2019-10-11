<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    define("KEY","659f1569858f26bfcf78a91dd24bec94");

    class MovieController
    {
        private $MovieDAO;

        public function __construct()
        {
            $this->MovieDAO = new MovieDAO();
        }


        public function GetMoviesFromApi(){
            $url="https://api.themoviedb.org/3/movie/now_playing?api_key=659f1569858f26bfcf78a91dd24bec94";
            $moviesJson=file_get_contents($url);
            $movies=json_decode($moviesJson,true);
            require_once(VIEWS_PATH."moviesApi.php");
        }

/*

        public function GetAllMovies(){
           return $this->MovieDAO->GetAll();
        }

        public function GetMovie($name){
            $Movie= $this->MovieDAO->GetByMovieName($name);
            return $Movie;
         }

        public function Add($name, $address, $capacity,$value,$funciones=null)
        {

            $Movie = new Movie();
            $Movie->setName($name);
            $Movie->setAddress($address);
            $Movie->setCapacity($capacity);
            $Movie->setValue($value);
            $Movie->setFunciones($funciones);



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