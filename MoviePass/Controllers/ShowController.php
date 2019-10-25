<?php
    namespace Controllers;

    use Models\Show as Show;
    use Models\Movie as Movie;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use \Exception as Exception;
    
    class ShowController
    {

        private $ShowDAOPDO;
        private $BillboardDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
        }

        public function GetAllByRoom($RoomId){
           return $this->ShowDAOPDO->GetAllByRoom($RoomId);
        }


        public function GetShowsCompleteByRoom($RoomId){
            $Shows = $this->GetAllByRoom($RoomId);
            foreach($Shows as $Show){
                if($Show->getMovie()!=null){
                    $movie=$this->BillboardDAOPDO->GetMovieById($Show->getMovie());
                    }else{
                        $movie=new Movie();
                        $movie->setName("No Asignado");
                        $movie->setImage("https://media.licdn.com/dms/image/C560BAQHvjs3O4Utmdw/company-logo_200_200/0?e=2159024400&v=beta&t=qdZJ4JLDc4N_esDRR0m2L6_qz27N2KKhi9yP5-LtAFA");
                    }
                    $Show->setMovie($movie);
            }
            return $Shows;
         }

        
            public function Add($DateTime, $Movie, $Tickets,$RoomId)
            {
               
                $Show = new Show();
                $Show->setDateTime($DateTime);
                $Show->setMovie($Movie);
                $Show->setTickets($Tickets);
                $Show->setRoomId($RoomId);
    
                $this->ShowDAOPDO->Add($Show);
    
                $this->ShowAddView();
            }
              
        public function RemoveShow($Id){
            $Show= $this->GetShow($Id);
            $this->ShowDAOPDO->RemoveShow($Show);
            $this->ShowListShowsAdminView();
        }

        public function ModifyShow($Id,$DateTime, $Movie, $Tickets,$RoomId){
            $Show = new Show();
            $Show->setId($Id);
            $Show->setDateTime($DateTime);
            $Show->setMovie($Movie);
            $Show->setTickets($Tickets);
            $Show->setRoomId($RoomId);

            $this->ShowDAOPDO->ModifyShow($Show);
            $this->ShowListShowsAdminView();
        }
        
        public function ShowIndexView(){
            require_once(VIEWS_PATH."index.php");
        }

        public function ShowModifyView($id){
            $show=$this->GetShow($id);
            require_once(VIEWS_PATH."ModifyShow.php");
        }
        
    }
?>