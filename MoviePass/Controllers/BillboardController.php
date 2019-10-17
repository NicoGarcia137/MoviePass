<?php
    namespace Controllers;

    use DAO\BillboardDAO as BillboardDAOJSON;
    use Models\Billboard as Billboard;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use Models\Movie as Movie;
    use Models\
    use \Exception as Exception;

    class BillboardController
    {
        private $BillboardDAOJSON;
        private $BillboardDAOPDO;
        private $DAO;

        public function __construct()
        {
            $this->BillboardDAOJSON = new BillboardDAOJSON();
            $this->BillboardDAOPDO=new BillboardDAOPDO();


            $this->BillboardDAO=$this->BillboardDAOPDO;
        }


        public function GetAllMovies(){
            return $this->MovieDAO->GetAll();
        }
 
         public function GetMovie($name){
             $Movie= $this->MovieDAO->GetByMovieName($name);
             return $Movie;
        }
 
         public function AddMovie($name, $address, $capacity,$value,$function=null)
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






         public function GetMoviesFromApi(){
            $url="https://api.themoviedb.org/3/movie/now_playing?api_key=659f1569858f26bfcf78a91dd24bec94&page=1";
            $moviesJson=file_get_contents($url);
            $moviesInc=json_decode($moviesJson,true);
            $movies=[];

            $this->
            
            
                foreach($moviesInc['results'] as $movie){
                    $newMovie=new Movie();  
                    $newMovie->setId($movie['id']);         
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






        
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addBillboard.php");
        }

        public function ShowModifyView($id)
        {
            $Billboard=$this->GetBillboard($id);
            require_once(VIEWS_PATH."modifyBillboard.php");
        }

        public function ShowRemoveView()
        {
            require_once(VIEWS_PATH."removeBillboard.php");
        }
        
        public function ShowListBillboardsAdminView(){
            $Billboards=$this->GetAllBillboards();
            require_once(VIEWS_PATH."listarBillboardsAdmin.php");
        }
        public function ShowListBillboardsView(){
            $Billboards=$this->GetAllBillboards();
            require_once(VIEWS_PATH."listarBillboardsUsuario.php");
        }
        public function ShowIndexView(){
            require_once(VIEWS_PATH."index.php");
        }
    }
?>