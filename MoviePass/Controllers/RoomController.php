<?php
    namespace Controllers;

    use Models\Room as Room;
    use Models\Show as Show;
    use Models\Cine as Cine;
    use DAO\CineDAOPDO as CineDAOPDO;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\ShowTimeDAOPDO as ShowTimeDAOPDO;
    use \Exception as Exception;
    use Controllers\ShowController as ShowController;
    use \DateTime as DateTime;

    class RoomController
    {
        private $RoomDAOPDO;
        private $ShowDAOPDO;
        private $CineDAOPDO;
        private $ShowTimeDAOPDO;
        private $ShowController;

        public function __construct()
        {
            $this->RoomDAOPDO=new RoomDAOPDO();
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->CineDAOPDO=new CineDAOPDO();
            $this->ShowTimeDAOPDO=new ShowTimeDAOPDO();
            
            $this->ShowController=new ShowController();
        }

        public function GetAllRooms(){
           $rooms= $this->RoomDAOPDO->GetAll();
        }

        public function GetRoom($id){
            $Room = $this->RoomDAOPDO->GetById($id);
            return $Room;
         }

         public function AddRoom($Capacity,$Name,$cineId)
            {
               try{
                $cine = $this->CineDAOPDO->GetById($cineId);
                if($this->RoomDAOPDO->NameCheck($Name)){
                    $Room = new Room();
                    $Room->setCapacity($Capacity);
                    $Room->setCine($cine);
                    $Room->setName($Name);
                    $this->RoomDAOPDO->Add($Room);
                    $Room->setId($this->RoomDAOPDO->GetLastId()-1);
                    $this->AddShows($Room);
                    $_SESSION['successMessage']="Exito al crear la sala";
                    $this->CineViewRefresh($cineId);
                }else{
                    $_SESSION['errorMessage']="Error, Ya se encuentra una sala con ese nombre";
                    $this->CineViewRefresh($cineId);
                }
               }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                $this->RoomIndexView();
               }
            }

        private function AddShows($room){
            $date=new DateTime();
            $ShowTimes=$this->ShowTimeDAOPDO->GetAllByCine($room->getCine()->getId());
            foreach($ShowTimes as $ShowTime){
                $time=explode(":",$ShowTime[0]);
                date_time_set($date,$time[0],$time[1]);
                for($x=0;$x<7;$x++){
                $show=new Show();
                $show->setRoom($room);
                $show->setMovie(null);
                $show->setDateTime($date);
                $this->ShowDAOPDO->Add($show);
                $date->modify('+1 day');
            }
                $date->modify('-7 day');
            }
        }

        private function UpdateShows(){
           
            $OldestShowTime=$this->ShowDAOPDO->GetOldestShowTime();
            if(!empty($OldestShowTime)){

                $OldestShowTime=new DateTime($OldestShowTime[0]);
                $now=new DateTime();
                $days=date_diff($OldestShowTime, $now);

                if($days->format('%a')>0){
                    $shows=$this->ShowDAOPDO->GetAllActiveShows();
                    foreach($shows as $show){
                        $dateTime=$show->getDateTime();
                        if($dateTime->format('Y-m-d')<$now->format('Y-m-d')){
                            $this->ShowDAOPDO->SoftDeleteShow($show);
                            $dateTime->modify('+7 day');
                            $newShow=new Show();
                            $newShow->setRoom($show->getRoom());
                            if(!empty($show->getMovie())){
                                $newShow->setMovie($show->getMovie());
                            }
                            $newShow->setDateTime($dateTime);
                            $this->ShowDAOPDO->Add($newShow);
                        }
                    }
                    $_SESSION['successMessage']="Funciones actualizadas al dia de la fecha";
                }
            }
        }





            public function RemoveRoom($cineId,$id){
                try{
                    $Room=$this->RoomDAOPDO->GetById($id);
                    $cine = $this->CineDAOPDO->GetById($cineId);
                    if($Room != null){
                        
                        var_dump($this->CheckShowsByRoom($Room));
                        if($this->CheckShowsByRoom($Room)){
                            $this->RoomDAOPDO->RemoveRoom($Room);
                            foreach($Room->getShows() as $show){
                                $this->ShowDAOPDO->RemoveShow($show);
                            }
                            $_SESSION['successMessage']="Exito al remover la sala";
                            $this->CineViewRefresh($cineId);   
                        }else{
                            $_SESSION['errorMessage']="Error al borrar la sala, hay entradas vendidas para shows de esta sala";
                            $this->CineViewRefresh($cineId);
                        }
                    }else{
                        throw new Exception("Error, no se encuentra sala con esa Id en el sistema");
                    }
                    }catch(Exception $ex){
                    $message=$ex->getMessage();
                    echo "<script>if(confirm('$message'));</script>";
                    $this->RoomIndexView();
                }
            }

            public function CheckShowsByRoom(Room $room){
                $result=true;
                foreach($room->getShows() as $show){
                    if(!empty($this->ShowDAOPDO->GetTicketsbyShow($show->getId()))){
                        $result=false;
                    }
                }
                return $result;
            }

        public function ModifyRoom($id,$name, $capacity){
            try{
                if($this->RoomDAOPDO->NameCheck($name,$id)){
                    $Room = $this->GetRoom($id);
                    $Room->setName($name);
                    $Room->setCapacity($capacity);
                    

                    $this->RoomDAOPDO->ModifyRoom($Room);
                    $_SESSION['successMessage']="Exito al modificar la sala";
                    $this->ShowModifyRoomView($id);
                 }else{
                    throw new Exception("Error, Ya se encuentra una sala con ese nombre");
                }
            }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                $this->RoomIndexView();
            }
        }

        function translator($day){
            if($day->format('l')=='Wednesday'){
              $day="Miercoles";
            }elseif($day->format('l')=='Thursday'){
              $day="Jueves";
            }elseif($day->format('l')=='Friday'){
              $day="Viernes";
            }elseif($day->format('l')=='Saturday'){
              $day="Sabado";
            }elseif($day->format('l')=='Sunday'){
              $day="Domingo";
            }elseif($day->format('l')=='Monday'){
              $day="Lunes";
            }elseif($day->format('l')=='Tuesday'){
              $day="Martes";
            }
            return $day;
}



        public function ShowModifyCineView(){
            if(isset($_SESSION['cineId'])){
                $cine=$this->CineDAOPDO->GetById($_SESSION['cineId']);
                unset($_SESSION['cineId']);
                require_once(VIEWS_PATH."modifyCine.php");
            }else{
                $_SESSION['errorMessage']="Error, se necesita un cine id para entrar a esta seccion";
                $this->RoomIndexView();
            }
        }

        private function CineViewRefresh($cineId){
            $_SESSION['cineId']=$cineId;
            header("location: ".FRONT_ROOT."Room/ShowModifyCineView");
        }
        
        public function ShowModifyRoomView($id){
            $this->UpdateShows();
            $room=$this->GetRoom($id);
            require_once(VIEWS_PATH."ModifyRoom.php");
        }

        public function RoomIndexView(){
            header("location: ".FRONT_ROOT."Home/indexAdmin");
        }
    }
?>