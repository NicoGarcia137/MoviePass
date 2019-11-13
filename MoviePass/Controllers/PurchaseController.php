<?php
    namespace Controllers;

    use Models\Show as Show;
    use Models\Ticket as Ticket;
    use Models\Purchase as Purchase;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use \Exception as Exception;
    use \DateTime as DateTime;

    class PurchaseController
    {
        private $ShowDAOPDO;
        private $PurchaseDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->PurchaseDAOPDO=new PurchaseDAOPDO();
        }
        
        public function CreatePurchase($showId,$value,$seats){
            try{
                if(isset($_SESSION['loggedUser'])){
                    $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($showId);
                    // var_dump($cine);
                    $show=$cine->getRooms()[0]->getShows()[0];
                    $show->setRoom($cine->getRooms()[0]);
                    $show->getRoom()->getCine()->setValue($cine->getValue());
                    $purchase=new Purchase();
                    foreach($seats as $seat){
                        $ticket=new Ticket();
                        // var_dump($seat);
                        $ticket->setSeat($seat);
                        $ticket->setShow($show);
                        $ticket->setValue($value);
                        $purchase->addTickets($ticket);
                    }
                    $purchase->setDateTime(new DateTime());
                    $purchase->setUser($_SESSION['loggedUser']);

                    $this->PurchaseDAOPDO->Add($purchase);
                    $this->ShowUserPurchases();
                }else{
                    throw new Exception("usuario invalido, necesitas estar logueado");
                }
                
            }catch(Exception $ex){
                $message=$ex->getMessage();
                echo "<script>if(confirm('$message'));</script>";
                header("location:".FRONT_ROOT."Login/ShowLoginView");
            }
            
        }

        public function getPurchaseByUser(){
            try{
                if(isset($_SESSION['loggedUser'])){
                    $user=$_SESSION['loggedUser'];
                    $purchase= $this->PurchaseDAOPDO->getPurchaseByUser($user);
                    return $purchase;
                }else{
                    throw new Exception("usuario invalido, necesitas estar logueado");
                }
            }catch(Exception $ex){
                $message=$ex->getMessage();
                echo "<script>if(confirm('$message'));</script>";
                header("location:".FRONT_ROOT."Login/ShowLoginView");
            }
        }

        public function ShowUserPurchases(){
            $purchases=$this->getPurchaseByUser();
            require_once(VIEWS_PATH."userPurchases.php");
        }



        public function ShowPurchaseView($showId){
            $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($showId);
            require_once(VIEWS_PATH."selectSeat.php");
        }


    }
?>