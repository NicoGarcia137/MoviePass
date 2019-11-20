<?php
    namespace Controllers;

    use Models\Billboard as Billboard;

    use DAO\BillboardDAOPDO as BillboardDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\CineDAOPDO as CineDAOPDO;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use \DateTime as DateTime;

    class HomeController
    {

        private $BillboardDAOPDO;
        private $ShowDAOPDO;
        private $CineDAOPDO;
        private $PurchaseDAOPDO;

        public function __construct()
        {
           
            $this->BillboardDAOPDO=new BillboardDAOPDO();
            $this->ShowDAOPDO=new ShowDAOPDO();
            $this->CineDAOPDO=new CineDAOPDO();
            $this->PurchaseDAOPDO=new PurchaseDAOPDO();
        }

        public function Index($message = "")
        {
            $carousel=$this->GetAllMoviesInshows();
            require_once(VIEWS_PATH."index.php");
        }

        public function IndexAdmin(){
            $date1=new DateTime();
            $date2=new DateTime();
            $date1->modify('-1 day');
            $this->ShowPurchasesStats($date1->format('Y-m-d H:m:s'),$date2->format('Y-m-d H:m:s'));
        }

        private function GetAllMoviesInshows(){
            $movies=[];
            $movieIds= $this->BillboardDAOPDO->GetAllMoviesInshows();
            foreach($movieIds as $id){
                $movie= $this->BillboardDAOPDO->GetMovieById($id);
                array_push($movies,$movie);
            }
            return $movies;
         }

         public function StatsShows($cines){

            $moviesStats=array();
            $moviesStats['movie']=array();
            $moviesStats['sold']=array();
            $moviesStats['unsold']=array();

            $cinesStats=array();
            $cinesStats['cine']=array();
            $cinesStats['sold']=array();
            $cinesStats['unsold']=array();

            foreach($cines as $cine){
                $sold=0;
                $unsold=0;
                foreach($cine->getRooms() as $room){
                    foreach($room->getShows() as $show){
                        $tickets=$this->ShowDAOPDO->GetTicketsbyShow($show->getId());
                        foreach($tickets as $ticket){
                            $show->addTickets($ticket);
                            $sold++;
                        }
                        if(!empty($show->getMovie())){
                            $unsold+=$room->getCapacity()-count($tickets);
                            $exist=false;
                            for($x=0;$x<count($moviesStats['movie']);$x++){
                                if($moviesStats['movie'][$x]->getId()==$show->getMovie()->getId()){
                                    $exist=true;
                                    $moviesStats['sold'][$x]+=count($tickets);
                                    $moviesStats['unsold'][$x]+=$room->getCapacity()-count($tickets);
                                }
                            }
                            if($exist==false){
                                array_push($moviesStats['movie'],$show->getMovie());
                                array_push($moviesStats['sold'],count($tickets));
                                array_push($moviesStats['unsold'],$room->getCapacity()-count($tickets));
                            }
                           
                        }
                    }
                }

                array_push($cinesStats['cine'],$cine);
                array_push($cinesStats['sold'],$sold);
                array_push($cinesStats['unsold'],$unsold);
            }
            $result=array($moviesStats,$cinesStats);
            return $result;
         }

         
        public function ShowPurchasesStats($date1,$date2){
            $date1=new DateTime($date1);
            $date2=new DateTime($date2);
            $cines= $this->CineDAOPDO->getAll();

            $result=$this->StatsShows($cines);
            $moviesStats=$result[0];
            $cinesStats=$result[1];

            $cinesHistory= $this->CineDAOPDO->GetAllHistory();
            $resultHistory=$this->StatsShows($cinesHistory);
            $moviesStatsHistory=$resultHistory[0];
            $cinesStatsHistory=$resultHistory[1];

            $CinesXMoney=$this->getAllPurchasesForCine($date1,$date2);
            $MoviesXMoney=$this->getAllPurchasesForMovie($date1,$date2);
            
            require_once(VIEWS_PATH."indexAdmin.php");
        }

        private function getAllPurchasesForCine($date1,$date2){
            $ResultCine=$this->PurchaseDAOPDO->getAllPurchasesForCine($date1,$date2);
            $CinesXMoney=array();
            $CinesXMoney['cine']=array();
            $CinesXMoney['value']=array();
            
            foreach($ResultCine as $CineXMoney){
                array_push($CinesXMoney['cine'],$this->CineDAOPDO->GetById($CineXMoney['Cine']));
                array_push($CinesXMoney['value'],$CineXMoney['Value']);
            }
            return $CinesXMoney;
        }

        private function getAllPurchasesForMovie($date1,$date2){
            $ResultMovie=$this->PurchaseDAOPDO->getAllPurchasesForMovie($date1,$date2);
            $MoviesXMoney=array();
            $MoviesXMoney['movie']=array();
            $MoviesXMoney['value']=array();
            foreach($ResultMovie as $MovieXMoney){
                array_push($MoviesXMoney['movie'],$this->BillboardDAOPDO->GetMovieById($MovieXMoney['Movie']));
                array_push($MoviesXMoney['value'],$MovieXMoney['Value']);
            }
            return $MoviesXMoney;
        }
    }
?>