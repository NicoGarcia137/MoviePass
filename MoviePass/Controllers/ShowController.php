<?php
    namespace Controllers;

    use Models\Show as Show;
    use Models\Movie as Movie;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use \Exception as Exception;
    
    
    class ShowController
    {

        private $ShowDAOPDO;
        private $BillboardDAOPDO;
        private $RoomDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
            $this->RoomDAOPDO=new RoomDAOPDO();
        }

        public function GetAllByRoom($RoomId){
           return $this->ShowDAOPDO->GetAllByRoom($RoomId);
        }

        public function GetShow($Id){
            return $this->ShowDAOPDO->GetById($Id);
        }
  
        public function RemoveShow($Id){
            $Show= $this->GetShow($Id);
            $this->ShowDAOPDO->RemoveShow($Show);
            $this->ShowListShowsAdminView();
        }

        public function ModifyShow($Id,$MovieId, $Tickets){
            $Show=$this->GetShow($Id);
            var_dump($MovieId);
            $Movie=$this->BillboardDAOPDO->GetMovieById($MovieId);
            $Show->setMovie($Movie);
            $Show->setTickets($Tickets);

            $this->ShowDAOPDO->ModifyShow($Show);
            
            $room = $Show->getRoom();
            
            var_dump($room);
            require_once(VIEWS_PATH."modifyRoom.php");
        }
        
        public function ShowIndexView(){
            require_once(VIEWS_PATH."index.php");
        }

        public function ShowModifyView($id){
            $show=$this->GetShow($id);
            $billboard=$this->BillboardDAOPDO->GetAllMovies();
            require_once(VIEWS_PATH."modifyShow.php");
        }
        
    }
?>