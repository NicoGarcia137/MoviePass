<?php
    namespace Controllers;
   
    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use DAO\GenreDAOPDO as GenreDAOPDO;
    class BillboardController
    {
     
        private $BillboardDAOPDO;
        private $GenreDAOPDO;
        public function __construct()
        {
            $this->GenreDAOPDO=new GenreDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
        }
        public function GetAllMovies(){
            return $this->BillboardDAOPDO->GetAllMovies();
        }
 
        public function GetMovie($Id){
             $Movie= $this->BillboardDAOPDO->GetMovieById($Id);
             return $Movie;
        }
 
         public function AddMovie($Movie)
         {
             $this->BillboardDAOPDO->Add($Movie);
         }
         
         public function RemoveMovie($Id){
             $Movie= $this->GetMovie($Id);
             if($Movie){
             $this->BillboardDAOPDO->RemoveMovie($Movie);
             }else{
               return null;
             }
         }
         public function UpdateBillboardFromApi(){
            $this->GetMoviesFromApi();
            $this->GetMovieGenresFromApi();
            $_SESSION['successMessage']="Cartelera actualizada con exito";
            $this->ShowBillboard();
         }
         public function ShowBillboard(){
            $Billboard= $this->GetAllMovies();
            require_once(VIEWS_PATH."moviesApi.php");
         }
         
         public function GetAllMoviesInshows(){
            $movies=[];
            $movieIds= $this->BillboardDAOPDO->GetAllMoviesInshows();
            foreach($movieIds as $id){
                $movie=$this->GetMovie($id);
                array_push($movies,$movie);
            }
            return $movies;
         }
         public function ShowMoviesInShows(){
            
             
            $Billboard= $this->GetAllMoviesInshows();
            $genres=$this->GenreDAOPDO->GetAll();
            $array_days[0] = "Monday";
            $array_days[1] = "Tuesday";
            $array_days[2] = "Wednesday";
            $array_days[3] = "Thursday";
            $array_days[4] = "Friday";
            $array_days[5] = "Saturday";
            $array_days[6] = "Sunday";
            
            require_once(VIEWS_PATH."showBillboard.php");
            
         }
         public function ShowMoviesInShowsByCineId($cineId){
            
            $Billboard= $this->BillboardDAOPDO->ShowMoviesInShowsByCineId($cineId);
            require_once(VIEWS_PATH."showBillboard.php");
        }
        public function ShowMoviesInShowsByRoomId($roomId){
            
            $Billboard= $this->BillboardDAOPDO->ShowMoviesInShowsByCineId($roomId);
            require_once(VIEWS_PATH."showBillboard.php");
        }
      
         public function GetMoviesFromApi(){
            $url="https://api.themoviedb.org/3/movie/now_playing?api_key=659f1569858f26bfcf78a91dd24bec94&page=1";
            $moviesJson=file_get_contents($url);
            $moviesInc=json_decode($moviesJson,true);   
            
            
                
            
                foreach($moviesInc['results'] as $movie){
                    if($this->getMovie($movie['id'])==null)
                    {
                        $newMovie=new Movie();        
                        $newMovie->setId($movie['id']);      
                        $newMovie->setName($movie['original_title']);
                        $newMovie->setDuration($movie['popularity']);
                        $newMovie->setLanguage($movie['original_language']);
                        $newMovie->setImage($movie['poster_path']);
                        $newMovie->setGenre($movie['genre_ids']);
                        $this->AddMovie($newMovie);
                    }
                }
                
                $Billboard= $this->BillboardDAOPDO->GetAllMovies();
                
                
                $MovieIds=[];
                $BillboardIds=[];
                foreach($moviesInc['results'] as $Movie){
                     array_push($MovieIds,$Movie['id']);
                }
                foreach($Billboard as $BMovie){
                     array_push($BillboardIds,$BMovie->getId());
                }
                $new_array = array_diff($BillboardIds,$MovieIds);
                $MoviesIdsInShows=$this->BillboardDAOPDO->GetAllMoviesInshows();
                foreach($new_array as $movieId){
                    if(!in_array($movieId,$MoviesIdsInShows)){
                    $this->RemoveMovie($movieId);
                    }
                }
        }
        public function GetMovieGenresFromApi(){
            $urlg="https://api.themoviedb.org/3/genre/movie/list?api_key=659f1569858f26bfcf78a91dd24bec94";
            $genresJson=file_get_contents($urlg);
            $genresListApi=json_decode($genresJson,true);
            
                    foreach ($genresListApi['genres'] as $genreApi){
                        
                        if($this->GenreDAOPDO->GetById($genreApi['id'])==null){
                            $newGenre=new Genre();
                            $newGenre->setId($genreApi['id']);
                            $newGenre->setDescription($genreApi['name']);
                            $this->GenreDAOPDO->Add($newGenre);  
                        }
                    }
                
        }
    }
?>