<?php
    namespace Controllers;

    use Models\Room as Room;
    use Models\Show as Show;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use \Exception as Exception;
    use Controllers\ShowController as ShowController;
    use \DateTime as DateTime;

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

        

        public function ModifyRoom($Id, $Capacity){
            $Room= $this->GetRoom($Id);
            $Room->setCapacity($Capacity);

            $this->RoomDAOPDO->ModifyRoom($Room);
            $this->ShowModifyCineView($Room->getCine()->getId());
        }
        
        public function ShowModifyRoomView($id){
            $room=$this->GetRoom($id);
            
            require_once(VIEWS_PATH."ModifyRoom.php");
        }

        public function ShowModifyCineView($id)
        {
            $cine=$this->GetCine($id);
            require_once(VIEWS_PATH."modifyCine.php");
        }


        public function RoomIndexView(){
            require_once(VIEWS_PATH."index.php");
        }
    }
?>