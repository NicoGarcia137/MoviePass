<?php
    namespace Controllers;

    use Models\Billboard as Billboard;

    use DAO\BillboardDAOPDO as BillboardDAOPDO;

    class HomeController
    {

        private $BillboardDAOPDO;

        public function __construct()
        {
            $this->BillboardDAOPDO=new BillboardDAOPDO();
        }

        public function Index($message = "")
        {
            $carousel=$this->GetAllMoviesInshows();
            require_once(VIEWS_PATH."index.php");
        }

        public function IndexAdmin(){
            require_once(VIEWS_PATH."indexAdmin.php");
        }

        private function GetAllMoviesInshows(){
            $movies=[];
            $movieIds= $this->BillboardDAOPDO->GetAllMoviesInshows();
            foreach($movieIds as $id){
                $movie= $this->BillboardDAOPDO->GetMovieById($id);
                array_push($movies,$movie);
            }
            return $movies;
         }

    }
?>