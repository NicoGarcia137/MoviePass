<?php
    namespace Controllers;
   
    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use DAO\GenreDAOPDO as GenreDAOPDO;
    use \DateTime as DateTime;
    class BillboardController
    {
     
        private $BillboardDAOPDO;
        private $GenreDAOPDO;
        public function __construct()
        {
            $this->GenreDAOPDO=new GenreDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
        }

        /** Llama al billboard repository y retorna todas las movies */
        public function GetAllMovies(){
            return $this->BillboardDAOPDO->GetAllMovies();
        }
        
        /** Llama al billboard repository y retorna una movie dependiendo 
         * del Id que llega por parametro
         */
        public function GetMovie($Id){
             $Movie= $this->BillboardDAOPDO->GetMovieById($Id);
             return $Movie;
        }
 
        /**Ingresa por parametro una movie y llama al billboard add con la movie como parametro */
         public function AddMovie($Movie)
         {
             $this->BillboardDAOPDO->Add($Movie);
         }
         /** Recibe un Movie Id
          * obtiene un movie y
          * llama al billboard repository para eliminarlo
         */
         public function RemoveMovie($Id){
             $Movie= $this->GetMovie($Id);
             if($Movie){
             $this->BillboardDAOPDO->RemoveMovie($Movie);
             }else{
               return null;
             }
         }
         /**Obtiene las movies y Generos de la api
          * muestra el billboard
          */
         public function UpdateBillboardFromApi(){
            $this->GetMoviesFromApi();
            $this->GetMovieGenresFromApi();
            $_SESSION['successMessage']="Cartelera actualizada con exito";
            $this->ShowBillboard();
         }
         /** obtiene todas las movies de la base
          * los carga en el billboard y llama a la vista
          * moviesApi
         */
         public function ShowBillboard(){
            $Billboard= $this->GetAllMovies();
            require_once(VIEWS_PATH."moviesApi.php");
         }
         /** Obtiene todas las movies Id que tienen un show cargado
          * crea las peliculas para cada id y retorna una lista con las mismas
          */
         public function GetAllMoviesInshows(){
            $movies=[];
            $movieIds= $this->BillboardDAOPDO->GetAllMoviesInshows();
            foreach($movieIds as $id){
                $movie=$this->GetMovie($id);
                array_push($movies,$movie);
            }
            return $movies;
         }

         /**Obtiene todas las movies depetiendo la fecha que llega por parametro */
         public function GetAllMoviesInshowsByDateTime($date){
             $Date=new DateTime($date);
             var_dump($Date);
            $Billboard=[];
            $movieIds= $this->BillboardDAOPDO->GetAllMoviesInshowsByDateTime($Date);
            foreach($movieIds as $id){
                $movie=$this->GetMovie($id);
                array_push($Billboard,$movie);
            }
            $genres=$this->BillboardDAOPDO->getAllGenres();
            require_once(VIEWS_PATH."showBillboard.php");
         }

         /** Obtiene todas las movies dependiendo de la lista de generos que llega por parametro */
         public function GetAllMoviesInshowsByGenre(...$genres){
             if(!empty($genres)){
                $Billboard=[];
                $movieIds= $this->BillboardDAOPDO->GetAllMoviesInshowsByGenres($genres[0]);
                foreach($movieIds as $id){
                    $movie=$this->GetMovie($id);
                    array_push($Billboard,$movie);
                }
                $genres=$this->BillboardDAOPDO->getAllGenres();
                require_once(VIEWS_PATH."showBillboard.php");
            }else{
                $this->ShowMoviesInShows();
            }
         }

         /** Obtiene todas las movies en shows y todos los generos de la base
          * para mostrar la vista del billboard
          */
         public function ShowMoviesInShows(){
            $Billboard= $this->GetAllMoviesInshows();
            $genres=$this->BillboardDAOPDO->getAllGenres();
            require_once(VIEWS_PATH."showBillboard.php");
         }


         /**Llama a la api externa, obtiene las peliculas y las compara con 
          * las peliculas de la base de datos para actualizarlas, borra las que ya no 
          * esten en la api externa, pero se asegura antes de que esas peliculas no es encuentren
          * en ningun show, si estan en algun show no se borran.
           */
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
        /** Obtiene todos les generos de la api externa y los agrega en la base de datos */
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
