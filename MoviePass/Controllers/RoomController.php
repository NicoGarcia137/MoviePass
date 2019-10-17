<?php
    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomDAOPDO as RoomDAOPDO;

    class RoomController
    {

        private $RoomDAOPDO;

        public function __construct()
        {
            $this->RoomDAOPDO=new RoomDAOPDO();
        }

        public function GetAllRooms(){
           return $this->RoomDAOPDO->GetAll();
        }

        public function GetRoom($id){
            $Room = $this->RoomDAOPDO->GetById($id);
            return $Room;
         }

        
            public function Add($Shows, $Capacity)
            {
               
                $Room = new Room();
                $Room->setShows($Shows);
                $Room->setCapacity($Capacity);
    
                $this->RoomDAOPDO->Add($Room);
    
                $this->RoomAddView();
            }
              
        public function RemoveRoom($Id){
            $Room= $this->GetRoom($Id);
            $this->RoomDAOPDO->RemoveRoom($Room);
            $this->RoomListRoomsAdminView();
        }

        public function ModifyRoom($Id, $Shows, $Capacity){
            $Room = new Room();
            $Room->setId($Id);
            $Room->setShows($Shows);
            $Room->setCapacity($Capacity);

            $this->RoomDAOPDO->ModifyRoom($Room);
            $this->RoomListRoomsAdminView();
        }
        
        public function RoomIndexView(){
            require_once(VIEWS_PATH."index.php");
        }
    }
?>