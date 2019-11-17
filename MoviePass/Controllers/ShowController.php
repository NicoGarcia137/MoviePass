<?php
    namespace Controllers;

    use Models\Show as Show;
    use Models\Room as Room;
    use Models\Cine as Cine;
    use Models\Movie as Movie;
    use Models\Purchase as Purchase;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use DAO\CineDAOPDO as CineDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\ShowTimeDAOPDO as ShowTimeDAOPDO;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use \Exception as Exception;
    
    use \DateTime as DateTime;
    
    
    class ShowController
    {

        private $ShowDAOPDO;
        private $BillboardDAOPDO;
        private $RoomDAOPDO;
        private $CineDAOPDO;
        private $ShowTimeDAOPDO;
        private $PurchaseDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
            $this->RoomDAOPDO=new RoomDAOPDO();
            $this->ShowTimeDAOPDO=new ShowTimeDAOPDO();
            $this->PurchaseDAOPDO=new PurchaseDAOPDO();
            $this->CineDAOPDO=new CineDAOPDO();
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
                $_SESSION['successMessage']="Extio al modificar la funcion";
            }else{
                $_SESSION['errorMessage']="No se puede modificar esta funcion, hay tickets vendidos para la misma";
            }
            $room = $this->RoomDAOPDO->GetById($Show->getRoom()->getId());
            
            require_once(VIEWS_PATH."modifyRoom.php");
        }

        public function AddShowTime($roomId,$time,$cineId){
            $cine=$this->CineDAOPDO->GetById($cineId);
            $date=new DateTime();
            $time=explode(":",$time);
            date_time_set($date,$time[0],$time[1]);
            if(empty($this->ShowTimeDAOPDO->GetShowTime($date,$cine->getId()))){
                
                $this->ShowTimeDAOPDO->Add($date,$cine->getId());
                foreach($cine->getRooms() as $room){
                    for($x=0;$x<7;$x++){
                    $show=new Show();
                    $show->setRoom($room);
                    $show->setMovie(null);
                    $show->setTickets(null);
                    $show->setDateTime($date);
                    $this->ShowDAOPDO->Add($show);
                    $date->modify('+1 day');
                }
                    $date->modify('-7 day');
                }
                $_SESSION['successMessage']="Extio al agregar Horario";
                $this->ShowModifyRoomView($roomId);
            }else{
                $_SESSION['errorMessage']="Ya se encuentra asignadio ese horario para este cine";
                $this->ShowModifyRoomView($roomId);
            }
        }


        public function ShowModifyRoomView($id){
            $room=$this->RoomDAOPDO->GetById($id);
            
            require_once(VIEWS_PATH."ModifyRoom.php");
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