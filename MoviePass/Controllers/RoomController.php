<?php
    namespace Controllers;

    use Models\Room as Room;
    use Models\Show as Show;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use \Exception as Exception;
    use Controllers\ShowController as ShowController;

    class RoomController
    {

        private $RoomDAOPDO;
        private $ShowDAOPDO;
        private $ShowController;

        public function __construct()
        {
            $this->RoomDAOPDO=new RoomDAOPDO();
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->ShowController=new ShowController();
        }

        public function GetAllRooms(){
           $rooms= $this->RoomDAOPDO->GetAll();
        }

        public function GetRoom($id){
            $Room = $this->RoomDAOPDO->GetById($id);
            return $Room;
         }

        
            public function Add($Capacity,$Name,$CineId)
            {
               
               try{
                $Room = new Room();
               
                $Room->setCapacity($Capacity);
                $Room->setCineId($CineId);
                $Room->setName($Name);
                $this->RoomDAOPDO->Add($Room);

                $RoomId=$this->RoomDAOPDO->getRoomIdByName($Name);

                $this->ShowModifyRoomView($RoomId);
               }catch(Exception $ex){
               
                require_once(VIEWS_PATH."IndexAdmin.php");
               }
              
            }
              
        public function RemoveRoom($Id){
            $Room= $this->GetRoom($Id);
            $this->RoomDAOPDO->RemoveRoom($Room);
            $this->RoomListRoomsAdminView();
        }

        public function ModifyRoom($Id, $Shows, $Capacity,$CineId){
            $Room = new Room();
            $Room->setId($Id);
            $Room->setShows($Shows);
            $Room->setCapacity($Capacity);
            $Room->setCineId($CineId);

            $this->RoomDAOPDO->ModifyRoom($Room);
            $this->RoomListRoomsAdminView();
        }
        
        public function ShowModifyRoomView($id){
            $room=$this->GetRoom($id);
            $showsRoom=$this->ShowController->GetShowsCompleteByRoom($id);
            


            if($showsRoom==null){
                $shows=[];
                
                for($x=0;$x<21;$x++){
                    $show=new Show();
                    $show->setRoomId($id);
                    $show->setMovie(null);
                    $show->setTickets(null);
                    if($x<7){
                        $show->setDateTime("10:00");
                        $this->ShowDAOPDO->Add($show);
                    }
                    else if ($x>=7 && $x<14){
                        $show->setDateTime("15:00");
                        $this->ShowDAOPDO->Add($show);
                    }
                    else if ($x<21){
                        $show->setDateTime("20:00");
                        $this->ShowDAOPDO->Add($show);
                    }
                }
                $showsRoom=$this->ShowController->GetShowsCompleteByRoom($id);
                
            }

            if($showsRoom!=null){
               
                $room->setShows($showsRoom);
               }
            require_once(VIEWS_PATH."ModifyRoom.php");
        }


        public function RoomIndexView(){
            require_once(VIEWS_PATH."index.php");
        }
    }
?>