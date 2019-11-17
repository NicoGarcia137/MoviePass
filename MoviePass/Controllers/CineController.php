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
    use \DateTime as DateTime;

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
                $_SESSION['errorMessage']=$message;
                header("location: ".FRONT_ROOT."Home/index");
            }
        }

        public function GetCine($id){
            try{
                $cine= $this->CineDAO->GetById($id);
                return $cine;
            }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                header("location: ".FRONT_ROOT."Home/index");
            }
         }

        
            public function Add($name, $address,$value)
            {
               try{
                   if($this->CineDAOPDO->NameCheck($name)){
                    $Cine = new Cine();
                    $Cine->setName($name);
                    $Cine->setAddress($address);
                    $Cine->setValue($value);
        
                    $this->CineDAO->Add($Cine);
                    $_SESSION['successMessage']="Exito al crear el cine";
        
                    $this->ShowAddView();
                   }else{
                    throw new Exception("Error, Ya se encuentra un cine con ese nombre");
                   }
                
                }catch(Exception $ex){
                    $message=$ex->getMessage();
                    $_SESSION['errorMessage']=$message;
                    header("location: ".FRONT_ROOT."Cine/ShowAddView");
                }
            }

      
        
        public function RemoveCine($id){
            try{
                $cine= $this->GetCine($id);
                
                if($cine != null){
                    if(empty($cine->getRooms())){
                        $this->CineDAO->RemoveCine($cine);
                        $_SESSION['successMessage']="Exito al remover el cine";
                        $this->ShowListCinesAdminView();   
                    }else{
                        throw new Exception("Error, Asegurarse de que el cine no tenga salas");
                    }
                }else{
                    throw new Exception("Error, no se encuentra cine con esa Id en el sistema");
                }
                }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                $this->ShowListCinesAdminView(); 
            }
        }

        public function ModifyCine($id,$name, $address,$value){
            try{
                if($this->CineDAOPDO->NameCheck($name,$id)){
                    $Cine = $this->GetCine($id);
                    $Cine->setName($name);
                    $Cine->setAddress($address);
                    $Cine->setValue($value);

                    $this->CineDAO->ModifyCine($Cine);
                    $_SESSION['successMessage']="Exito al modificar el cine";
                    $this->ShowModifyView($id);
                 }else{
                    throw new Exception("Error, Ya se encuentra un cine con ese nombre");
                }
            }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                header("location: ".FRONT_ROOT."Home/indexAdmin");
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
        public function ShowIndexAdminView(){
            require_once(VIEWS_PATH."indexAdmin.php");
            
        }
    }
?>