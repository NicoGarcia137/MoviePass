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

        public function GetCine($id){
            $cine= $this->CineDAO->GetById($id);
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
        
        public function RemoveCine($id){
            $cine= $this->GetCine($id);
            $this->CineDAO->RemoveCine($cine);
            $this->ShowListCinesAdminView();
        }

        public function ModifyCine($id,$name, $address, $capacity,$value){
            $Cine = new Cine();
            $Cine->setId($id);
            $Cine->setName($name);
            $Cine->setAddress($address);
            $Cine->setCapacity($capacity);
            $Cine->setValue($value);

            $this->CineDAO->ModifyCine($Cine);
            $this->ShowListCinesAdminView();
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