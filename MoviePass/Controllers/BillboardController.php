<?php
    namespace Controllers;

   
    use Models\Movie as Movie;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use \Exception as Exception;

    class BillboardController
    {
     
        private $BillboardDAOPDO;

        public function __construct()
        {
            $this->BillboardDAOPDO=new BillboardDAOPDO();
        }


        public function GetAllMovies(){
            return $this->BillboardDAOPDO->GetAll();
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
                        //$genres=$movie['genre_ids'];
                        //$newMovie->setGenre($genres);//$this->GetMovieGenres($genres));
    
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

                foreach($new_array as $movieId){
                    $this->RemoveMovie($movieId);
                }
            
                $Billboard= $this->BillboardDAOPDO->GetAllMovies();
             
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


    }
?>