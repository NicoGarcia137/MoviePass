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
        
        public function CreatePurchase($showId,$value,$creditCard,$type,...$seats){
            try{
                
                if(!empty($seats)){
                    if(isset($_SESSION['loggedUser'])){
                        
                        if($this->ValidCreditcard($creditCard,$type)){
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
                                
                                include_once('sendMail.php');

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
                            $_SESSION['errorMessage']= "Error, Tarjeta de credito ".$type." no corresponde.";
                            $this->ShowConfirmPurchase($showId,$seats[0]);
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



        private function luhn($number)
{
   //Force the value to be a string as this method uses string functions.
   //Converting to an integer may pass PHP_INT_MAX and result in an error!
    $number = (string)$number;

    if (!ctype_digit($number)) {
       //Luhn can only be used on numbers!
        return FALSE;
    }

   //Check number length
    $length = strlen($number);

   //Checksum of the card number
    $checksum = 0;

    for ($i = $length - 1; $i >= 0; $i -= 2) {
       //Add up every 2nd digit, starting from the right
        $checksum += substr($number, $i, 1);
    }

    for ($i = $length - 2; $i >= 0; $i -= 2) {
       //Add up every 2nd digit doubled, starting from the right
        $double = substr($number, $i, 1) * 2;

       //Subtract 9 from the double where value is greater than 10
        $checksum += ($double >= 10) ? ($double - 9) : $double;
    }

   //If the checksum is a multiple of 10, the number is valid
    return ($checksum % 10 === 0);
}

private function ValidCreditcard($number,$type)
{
    $card_array = array(
        'default' => array(
            'length' => '13,14,15,16,17,18,19',
            'prefix' => '',
            'luhn' => TRUE,
        ),
        'american express' => array(
            'length' => '15',
            'prefix' => '3[47]',
            'luhn' => TRUE,
        ),
        'diners club' => array(
            'length' => '14,16',
            'prefix' => '36|55|30[0-5]',
            'luhn' => TRUE,
        ),
        'discover' => array(
            'length' => '16',
            'prefix' => '6(?:5|011)',
            'luhn' => TRUE,
        ),
        'jcb' => array(
            'length' => '15,16',
            'prefix' => '3|1800|2131',
            'luhn' => TRUE,
        ),
        'maestro' => array(
            'length' => '16,18',
            'prefix' => '50(?:20|38)|6(?:304|759)',
            'luhn' => TRUE,
        ),
        'mastercard' => array(
            'length' => '16',
            'prefix' => '5[1-5]',
            'luhn' => TRUE,
        ),
        'visa' => array(
            'length' => '13,16',
            'prefix' => '4',
            'luhn' => TRUE,
        ),
    );

   //Remove all non-digit characters from the number
    if (($number = preg_replace('/\D+/', '', $number)) === '')
        return FALSE;


    $cards = $card_array;

   //Check card type
    $type = strtolower($type);

    if (!isset($cards[$type]))
        return FALSE;

   //Check card number length
    $length = strlen($number);

   //Validate the card length by the card type
    if (!in_array($length, preg_split('/\D+/', $cards[$type]['length'])))
        return FALSE;

   //Check card number prefix
    if (!preg_match('/^' . $cards[$type]['prefix'] . '/', $number))
        return FALSE;

   //No Luhn check required
    if ($cards[$type]['luhn'] == FALSE)
        return TRUE;

    return $this->luhn($number);

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
                        uasort($purchases, function($a, $b){return strcasecmp($b->getDateTime() , $a->getDateTime());});
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

        public function AbortPurchase(){
            unset($_SESSION['failPurchase']);
            header("location:".FRONT_ROOT."Home/Index");
        }

        public function ShowConfirmPurchase($showId,...$seats){
            $cine=$this->ShowDAOPDO->GetTicketInfoByShowId($showId);
            $room=$cine->getRooms()[0];
            $show=$room->getShows()[0];
            $value=$cine->getValue();
            $day=new DateTime();
            $array=array("Tuesday","Wednesday");
            $discount=false;
            $seats=$seats[0];
            if(count($seats)>=2 && in_array($day->format('l'),$array)){
            
                $value=$value * 0.75;
                $discount=true;
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