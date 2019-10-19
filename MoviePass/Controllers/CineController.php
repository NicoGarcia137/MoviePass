<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAOJSON;
    use Models\Cine as Cine;
    use DAO\CineDAOPDO as CineDAOPDO;
    use DAO\RoomDAOPDO as RoomDAOPDO;
    use \Exception as Exception;

    class CineController
    {
        private $CineDAOJSON;
        private $CineDAOPDO;
        private $RoomDAOPDO;
        private $DAO;

        public function __construct()
        {
            $this->CineDAOJSON = new CineDAOJSON();
            $this->CineDAOPDO=new CineDAOPDO();
            $this->RoomDAOPDO=new RoomDAOPDO();
            

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
                $rooms=$this->RoomDAOPDO->GetAll();
                foreach($rooms as $room){
                    if($room->getCineId()==$cine->getId())
                        $cine->addRoom($room);
                }

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