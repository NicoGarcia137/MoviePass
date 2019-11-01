<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAOJSON;
    use Models\Cine as Cine;
    use Models\Room as Room;
    use Models\Show as Show;
    use Models\Movie as Movie;
    use DAO\CineDAOPDO as CineDAOPDO;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use \Exception as Exception;

    class CineController
    {
        private $CineDAOJSON;
        private $CineDAOPDO;
        private $RoomDAOPDO;
        private $BillboardDAOPDO;
        private $DAO;

        public function __construct()
        {
            $this->CineDAOJSON = new CineDAOJSON();
            $this->CineDAOPDO=new CineDAOPDO();
            $this->RoomDAOPDO=new RoomDAOPDO();
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->BillboardDAOPDO=new BillboardDAOPDO();
            

            $this->CineDAO=$this->CineDAOPDO;
        }



        public function GetAllCines(){
            try{
                return $this->CineDAO->GetAll();
             }catch(Exception $ex){
                $message=$ex->getMessage();
                echo "<script>if(confirm('$message'));</script>";
            }
        }

        public function GetCine($id){
            try{
                $cine= $this->CineDAO->GetById($id);
                return $cine;
            }catch(Exception $ex){
                $message=$ex->getMessage();
                echo "<script>if(confirm('$message'));</script>";
            }
         }

        
            public function Add($name, $address, $capacity,$value,$Rooms=null)
            {
               try{
                $Cine = new Cine();
                $Cine->setName($name);
                $Cine->setAddress($address);
                $Cine->setCapacity($capacity);
                $Cine->setValue($value);
                $Cine->setRooms($Rooms);

    
                $this->CineDAO->Add($Cine);
    
                $this->ShowAddView();
            }catch(Exception $ex){
                $message=$ex->getMessage();
                echo "<script>if(confirm('$message'));</script>";
            }
            }

            public function AddRoom($Capacity,$Name,$CineId)
            {
               try{
                $Room = new Room();
                $Cine = $this->GetCine($CineId);
                $Room->setCapacity($Capacity);
                $Room->setCine($Cine);
                $Room->setName($Name);
                $id=$this->RoomDAOPDO->GetLastId()+1;
                $day=1;
                for($x=0;$x<21;$x++){
                    $show=new Show();
                    $show->setRoom($id);
                    $show->setMovie(null);
                    $show->setTickets(null);
                    if($x<7){
                        $show->setDateTime("10:00"." day : ".$day);
                        $this->ShowDAOPDO->Add($show);
                    }
                    else if ($x>=7 && $x<14){
                        $show->setDateTime("15:00"." day : ".$day);
                        $this->ShowDAOPDO->Add($show);
                    }
                    else if ($x<21){
                        $show->setDateTime("20:00"." day : ".$day);
                        $this->ShowDAOPDO->Add($show);
                    }
                    if($day==7){
                        $day=1;
                    }else{
                        $day++;
                    }
                    
                }
                $this->RoomDAOPDO->Add($Room);

                $this->ShowModifyView($CineId);
               }catch(Exception $ex){
                require_once(VIEWS_PATH."IndexAdmin.php");
               }
            }
      
      
        
        public function RemoveCine($id){
            try{
                $cine= $this->GetCine($id);
                
                if($cine != null){
                    $this->CineDAO->RemoveCine($cine);
                    $this->ShowListCinesAdminView();        
                }else{
                    throw new Exception("Error, no se encuentra cine con esa Id en el sistema");
                }
                }catch(Exception $ex){
                $message=$ex->getMessage();
                echo "<script>if(confirm('$message'));</script>";
                $this->ShowListCinesAdminView(); 
            }
        }

        public function ModifyCine($id,$name, $address, $capacity,$value){
            try{
            $Cine = new Cine();
            $Cine->setId($id);
            $Cine->setName($name);
            $Cine->setAddress($address);
            $Cine->setCapacity($capacity);
            $Cine->setValue($value);

            $this->CineDAO->ModifyCine($Cine);
            $this->ShowListCinesAdminView();
        }catch(Exception $ex){
            echo "<script>if(confirm('echo $ex'));</script>";
        }
        }


        public function GetCinesAndShowsByMovie($movie){
            $cines= $this->CineDAOPDO->GetCinesAndShowsByMovie($movie);
            return $cines;
        }





        
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addCine.php");
        }

        public function ShowModifyView($id)
        {
            $cine=$this->GetCine($id);
            require_once(VIEWS_PATH."modifyCine.php");
        }

        public function ShowRemoveView()
        {
            require_once(VIEWS_PATH."removeCine.php");
        }

        public function ShowCinesAndShowsByMovie($id)
        {
            $Movie=$this->BillboardDAOPDO->GetMovieById($id);
            $cinesAndShows=$this->GetCinesAndShowsByMovie($Movie);
            require_once(VIEWS_PATH."showCinesAndShowsByMovie.php");
        }

        
        public function ShowListCinesAdminView(){
            $cines=$this->GetAllCines();
            require_once(VIEWS_PATH."listarCinesAdmin.php");
        }
        public function ShowListCinesView(){
            $cines=$this->GetAllCines();
            require_once(VIEWS_PATH."listarCinesUsuario.php");
        }
        public function ShowIndexView(){
            require_once(VIEWS_PATH."index.php");
        }
    }
?>