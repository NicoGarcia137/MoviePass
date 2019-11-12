<?php
    namespace Controllers;

    use Models\Show as Show;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use \Exception as Exception;
    use \DateTime as DateTime;

    class PurchaseController
    {
        private $ShowDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
        }
        
        public function CreatePurchase($showId, $amount,$numbers){
            
        }

        public function ShowPurchaseView($showId,$amount){
            $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($showId);
            require_once(VIEWS_PATH."selectSeat.php");
        }


        public function RoomIndexView(){
            require_once(VIEWS_PATH."index.php");
        }
    }
?>