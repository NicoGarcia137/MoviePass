<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use Models\Cine as Cine;

    class CineController
    {
        private $CineDAO;

        public function __construct()
        {
            $this->CineDAO = new CineDAO();
        }


        public function GetAllCines(){
           return $this->CineDAO->GetAll();
        }

        public function GetCine($name){
            $cine= $this->CineDAO->GetByCineName($name);
            return $cine;
         }

        public function Add($name, $address, $capacity,$value,$funciones=null)
        {

            $Cine = new Cine();
            $Cine->setName($name);
            $Cine->setAddress($address);
            $Cine->setCapacity($capacity);
            $Cine->setValue($value);
            $Cine->setFunciones($funciones);



            $this->CineDAO->Add($Cine);

            $this->ShowAddView();
        }
        
        public function RemoveCine($name){
            $cine= $this->GetCine($name);
            $this->CineDAO->RemoveCine($cine);
            $this->ShowListCinesAdminView();
        }


        
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addCine.php");
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
    }
?>