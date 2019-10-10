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

         public function ShowAddView()
         {
             require_once(VIEWS_PATH."addCine.php");
         }


        public function GetCine($name){
            $cine= $this->CineDAO->GetByCineName($name);
            return $cine;
         }

        public function Add($name, $address, $capacity,$value,$funciones)
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
            $this->CineDAO->RemoveCineByName($name);
            $this->ShowListView();
        }

    }
?>