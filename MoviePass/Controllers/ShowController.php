<?php
    namespace Controllers;

    use Models\Show as Show;
    use Models\Movie as Movie;
    use Models\Purchase as Purchase;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use \Exception as Exception;
    
    
    class ShowController
    {

        private $ShowDAOPDO;
        private $BillboardDAOPDO;
        private $RoomDAOPDO;
        private $PurchaseDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
            $this->RoomDAOPDO=new RoomDAOPDO();
            $this->PurchaseDAOPDO=new PurchaseDAOPDO();
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
            if(empty($this->PurchaseDAOPDO->getTicketsByShowId($Id))){
                $Show=$this->GetShow($Id);
                $Movie=null;
                if($MovieId!=null){
                    $Movie=$this->BillboardDAOPDO->GetMovieById($MovieId);
                }
                $Show->setMovie($Movie);
                $Show->setTickets($Tickets);
                $this->ShowDAOPDO->ModifyShow($Show);
            }
            
            $room = $this->RoomDAOPDO->GetById($Show->getRoom()->getId());
            
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