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
        
        public function CreatePurchase($showId,$value,...$seats){
            try{
                if(!empty($seats)){
                    if(isset($_SESSION['loggedUser'])){
                        $check=$this->PurchaseDAOPDO->CheckTicketExist($showId,$seats);
                        if($check==0){
                            $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($showId);
                            $show=$cine->getRooms()[0]->getShows()[0];
                            $show->setRoom($cine->getRooms()[0]);
                            $show->getRoom()->getCine()->setValue($cine->getValue());
                            $purchase=new Purchase();
                            foreach($seats[0] as $seat){
                                $ticket=new Ticket();
                                $ticket->setSeat($seat);
                                $ticket->setShow($show);
                                $ticket->setValue($value);
                                $purchase->addTickets($ticket);
                            }
                            $purchase->setCine($cine);
                            $purchase->setDateTime(new DateTime());
                            $purchase->setUser($_SESSION['loggedUser']);
        
                            $this->PurchaseDAOPDO->Add($purchase);
                            unset($_SESSION['failPurchase']);
                            $this->ShowUserPurchases();
                        }else{
                            $purchases=$this->getPurchaseByUser();
                            foreach($purchases as $purchase){
                                foreach($purchase->getTickets() as $ticket){
                                    if(in_array($ticket->getSeat(),$seats[0])){
                                        $this->ShowUserPurchases();
                                        $check=0;
                                    }
                                }
                            }
                            if($check!=0){
                                $_SESSION['errorMessage']= "Butaca seleccionada ya nose encuentra disponible.";
                                $this->ShowPurchaseView($showId);
                            }
                        }
                    }else{
                        $show=$this->ShowDAOPDO->GetById($showId);
                        $_SESSION['failPurchase']= array($show,$value,$seats[0]);
                        throw new Exception("usuario invalido, necesitas estar logueado");
                    }
                }else{
                    $_SESSION['errorMessage']= "Seleccione al menos 1 butaca antes de continuar.";
                    $this->ShowPurchaseView($showId);
                }
                
            }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                require_once(VIEWS_PATH."login.php");
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
                $_SESSION['errorMessage']=$message;
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function ShowUserPurchases(){
            try{
                $purchases=$this->getPurchaseByUser();
                if($purchases!=null){
                    foreach($purchases as $purchase){
                        $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($purchase->getTickets()[0]->getShow()->getId());
                        $purchase->setCine($cine);
                        foreach($purchase->getTickets() as $ticket){
                            $show=$this->ShowDAOPDO->GetById($ticket->getShow()->getId());
                            $ticket->setShow($show);
                        }
                     }
                     require_once(VIEWS_PATH."userPurchases.php");
                }else{
                    $purchases=[];
                    require_once(VIEWS_PATH."userPurchases.php");
                }
            }catch(Exception $ex){
                $message=$ex->getMessage();
                $_SESSION['errorMessage']=$message;
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function AbortPurchase(){
            unset($_SESSION['failPurchase']);
            header("location:".FRONT_ROOT."Home/Index");
        }


        public function ShowPurchaseView($showId){
            $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($showId);
            $OccupiedSeats=[];
            foreach($this->ShowDAOPDO->GetTicketsbyShow($showId) as $ticket){
                array_push($OccupiedSeats,$ticket->getSeat());
            }
            require_once(VIEWS_PATH."selectSeat.php");
        }


    }
?>