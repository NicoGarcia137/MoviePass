<?php
    namespace Controllers;

   
    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use Models\MovieXGenre as MovieXGenre;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use DAO\GenreDAOPDO as GenreDAOPDO;
    use DAO\MovieXGenreDAOPDO as MovieXGenreDAOPDO;
    use \Exception as Exception;

    class BillboardController
    {
     
        private $BillboardDAOPDO;
        private $GenreDAOPDO;
        private $MovieXGenreDAOPDO;

        public function __construct()
        {
            $this->GenreDAOPDO=new GenreDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
            $this->MovieXGenreDAOPDO=new MovieXGenreDAOPDO();
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

         public function ShowBillboard(){
             $this->GetMoviesFromApi();
             $this->GetMovieGenresFromApi();

             $Billboard= $this->PutGenresInMovies();
             require_once(VIEWS_PATH."moviesApi.php");
         }

         public function PutGenresInMovies(){
            $MovieXGenreList=$this->MovieXGenreDAOPDO->GetAll();
            $movies=[];
            foreach($MovieXGenreList as $MovieXGenre){
                $movie=$this->BillboardDAOPDO->GetMovieById($MovieXGenre->getMovieId());
                $movie->addGenre($this->GenreDAOPDO->GetGenreById($MovieXGenre->getGenreId()));

                foreach($movies as $moviex){
                    if($moviex->getId()==$movie->getId()){
                        array_push($movies,$movie);
                    }
                }
            }
            return $movies;
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
                        $this->AddMovie($newMovie);

                        foreach($movie['genre_ids'] as $genre){
                            $MovieXGenre=new MovieXGenre();
                            $MovieXGenre->setMovieId($movie['id']);
                            $newGenre=new Genre();
                            $newGenre->setId($genre['id']);
                            $MovieXGenre->setGenreId($newGenre);
                            $this->MovieXGenreDAOPDO->Add($MovieXGenre);
                        }
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
        }

        public function GetMovieGenresFromApi(){
            $url="https://api.themoviedb.org/3/genre/movie/list?api_key=659f1569858f26bfcf78a91dd24bec94";
            $genresJson=file_get_contents($url);
            $genresListApi=json_decode($genresJson,true);
            
           
                foreach($genresListApi as $resultg){
                    foreach ($resultg as $genreApi){
                        if($this->GenreDAOPDO->GetById($genreApi['id'])==null){
                            $newGenre=new Genre();
                            $newGenre->setId($genreApi['id']);
                            $newGenre->setDescription($genreApi['name']);
                            $this->GenreDAOPDO->Add($newGenre);  /// LLAMAR DIRECTAMENTE?
                        }
                    }
                }
        }
    }
?>