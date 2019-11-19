<?php
    namespace Controllers;

    use Models\Show as Show;
    use Models\Cine as Cine;
    use Models\Ticket as Ticket;
    use Models\Purchase as Purchase;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use DAO\CineDAOPDO as CineDAOPDO;
    use \Exception as Exception;
    use \DateTime as DateTime;

    class PurchaseController
    {
        private $ShowDAOPDO;
        private $PurchaseDAOPDO;
        private $CineDAOPDO;

        public function __construct()
        {
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->PurchaseDAOPDO=new PurchaseDAOPDO();
            $this->CineDAOPDO=new CineDAOPDO();
        }
        
        public function CreatePurchase($showId,$value,...$seats){
            try{
                if(!empty($seats)){
                    if(isset($_SESSION['loggedUser'])){
                        $check=$this->PurchaseDAOPDO->CheckTicketExist($showId,$seats);
                        if(empty($check)){
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
                            $_SESSION['successMessage']= "Compra exitosa.";
                           
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

        public function ShowUserPurchases($orderBy = "movie"){
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
                     if($orderBy=="date"){
                        uasort($purchases, function($a, $b){return strcasecmp($a->getDateTime() , $b->getDateTime());});
                     }else if($orderBy=="movie"){
                        uasort($purchases, function($a, $b){return strcasecmp($a->getTickets()[0]->getShow()->getMovie()->getName() , $b->getTickets()[0]->getShow()->getMovie()->getName());});
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

        public function ShowPurchasesStats(){
            $cines= $this->CineDAOPDO->getAll();
            $moviesStats=array();
            $moviesStats['movie']=array();
            $moviesStats['sold']=array();
            $moviesStats['unsold']=array();

            $cinesSats=array();
            $cinesSats['cine']=array();
            $cinesSats['sold']=array();
            $cinesSats['unsold']=array();

            foreach($cines as $cine){
                $count=0;
                foreach($cine->getRooms() as $room){
                    foreach($room->getShows() as $show){
                        $tickets=$this->ShowDAOPDO->GetTicketsbyShow($show->getId());
                        foreach($tickets as $ticket){
                            $show->addTickets($ticket);
                            $count++;
                        }
                        if(!empty($show->getMovie())){
                            var_dump($show->getMovie()->getName());
                            array_push($moviesStats['movie'],$show->getMovie());
                            array_push($moviesStats['sold'],count($tickets));
                            array_push($moviesStats['unsold'],$room->getCapacity()-count($tickets));
                        }
                    }
                }

                array_push($cinesSats['cine'],$cine);
                array_push($cinesSats['sold'],$count);
                array_push($cinesSats['unsold'],$cine->getCapacity()-$count);
            }

            for($x=0;$x<count($moviesStats['movie']);$x++){
                for($y=0;$y<count($moviesStats['movie']);$y++){
                    if($x!=$y && isset($moviesStats['movie'][$y]) && isset($moviesStats['movie'][$y]) && $moviesStats['movie'][$x]==$moviesStats['movie'][$y]){
                       
                        
                        $moviesStats['unsold'][$x]+=$moviesStats['unsold'][$y];
                        $moviesStats['sold'][$x]+=$moviesStats['sold'][$y];
                        unset($moviesStats['movie'][$y]);
                        unset($moviesStats['sold'][$y]);
                       unset($moviesStats['unsold'][$y]);
                       sort($moviesStats['movie']); 
                       sort($moviesStats['sold']); 
                       sort($moviesStats['unsold']); 

                    }   
                }
            }
        }



        public function AbortPurchase(){
            unset($_SESSION['failPurchase']);
            header("location:".FRONT_ROOT."Home/Index");
        }

        public function ShowConfirmPurchase($showId,...$seats){
            $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($showId);
            $room=array_shift($cine->getRooms());
            $show=array_shift($room->getShows());
            $value=$cine->getValue();
            $day=new DateTime('l');
            $array=array("Tuesday","Wednesday");
            $seats=$seats[0];
            if(count($seats)>=2 && in_array($day,$array)){
                $value=$value * 0.75;
            }
            require_once(VIEWS_PATH."confirmPurchase.php");
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