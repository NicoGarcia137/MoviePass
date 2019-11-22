<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAOJSON;
    use Models\Cine as Cine;
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

        /** Obtiene todos los cines de la base de datos */
        public function GetAllCines(){
            try{
                $cines=$this->CineDAO->GetAll();
                return $cines;
             }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                header("location: ".FRONT_ROOT."Home/index");
            }
        }

        /** Llega por parametro el id de un cine 
         * y obtiene el cine correspondiente de la base de datos*/
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

            /**Agrega un cine a la base de datos, llegan por parametro el nombre, 
             * direccion y valor del mismo */
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

      
        /** Elimina un cine de la base de datos segun el id que llega por parametro */
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

        /** Recibe por parametros el id, nombre, direccion y valor de un cine para modificarlo */
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

        /**Obtiene las peliculas de la base de datos 
         * dependiendo el cineId que llega por parametro
         */
        public function GetMoviesByCine($cineId){
            $movies=[];
            $cine=$this->GetCine($cineId);
            foreach($cine->getRooms() as $room){
                foreach($room->getShows() as $show){
                    if($show->getMovie()!=null){
                        array_push($movies,$show->getMovie());
                    }
                }
            }
            return $movies;
        }

        /** Obtiene todos los cines y shows de la base de datos segun la pelicula */
        public function GetCinesAndShowsByMovie($movie){
            $cines= $this->CineDAOPDO->GetCinesAndShowsByMovie($movie);
            return $cines;
        }

        /**Muestra el addcine */
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addCine.php");
        }

        /**Muestra el modifycine segun el Cine id que llega por parametro */
        public function ShowModifyView($id)
        {
            $cine=$this->GetCine($id);
            require_once(VIEWS_PATH."modifyCine.php");
        }

        /**muestra el removecine */
        public function ShowRemoveView()
        {
            require_once(VIEWS_PATH."removeCine.php");
        }

        /**Recibe un movie id y obtiene todos los cines y shwos de esa movie
         * luego muestra la vista de showCinesAndShowsByMovie
         */
        public function ShowCinesAndShowsByMovie($id)
        {
            $Movie=$this->BillboardDAOPDO->GetMovieById($id);
            $cinesAndShows=$this->GetCinesAndShowsByMovie($Movie);
            require_once(VIEWS_PATH."showCinesAndShowsByMovie.php");
        }

        /** Obtiene todos los cines y llama a la vista ListarCinesAdmin */
        public function ShowListCinesAdminView(){
            $cines=$this->GetAllCines();
            
            require_once(VIEWS_PATH."listarCinesAdmin.php");
        }

        /**Obtiene todos los cines y llama a la vista listarCinesUsuario */
        public function ShowListCinesView(){
            $cines=$this->GetAllCines();
            require_once(VIEWS_PATH."listarCinesUsuario.php");
        }

        /** Redirecciona al Index View del HomeController */
        public function ShowIndexView(){
            header("location: ".FRONT_ROOT."Home/index");
        }

        /** Redireccione al Index Admin View del homeController */
        public function ShowIndexAdminView(){
            header("location: ".FRONT_ROOT."Home/indexAdmin");
        }
    }
?>