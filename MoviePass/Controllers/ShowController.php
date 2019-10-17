<?php
    namespace Controllers;

    use Models\Show as Show;
    use DAO\ShowDAOPDO as ShowDAOPDO;

    class ShowController
    {

        private $ShowDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
        }

        public function GetAllShows(){
           return $this->ShowDAOPDO->GetAll();
        }

        public function GetShow($id){
            $Show = $this->ShowDAOPDO->GetById($id);
            return $Show;
         }

        
            public function Add($DateTime, $Peliculas, $Tickets)
            {
               
                $Show = new Show();
                $Show->setDateTime($DateTime);
                $Show->setPeliculas($Peliculas);
                $Show->setTickets($Tickets);
    
                $this->ShowDAOPDO->Add($Show);
    
                $this->ShowAddView();
            }
              
        public function RemoveShow($Id){
            $Show= $this->GetShow($Id);
            $this->ShowDAOPDO->RemoveShow($Show);
            $this->ShowListShowsAdminView();
        }

        public function ModifyShow($Id,$DateTime, $Peliculas, $Tickets){
            $Show = new Show();
            $Show->setId($Id);
            $Show->setDateTime($DateTime);
            $Show->setPeliculas($Peliculas);
            $Show->setTickets($Tickets);

            $this->ShowDAOPDO->ModifyShow($Show);
            $this->ShowListShowsAdminView();
        }
        
        public function ShowIndexView(){
            require_once(VIEWS_PATH."index.php");
        }
    }
?>