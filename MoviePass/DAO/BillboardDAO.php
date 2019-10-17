<?php namespace DAO;

use DAO\IBilldboardDAO as IBilldboardDAO;
use Models\Billdboard as Billdboard;
use DAO\Connection as Connection;
use \Exception as Exception;

class BilldboardDAOPDO implements IBilldboardDAO{

  
    private $connection;


    
    public function GetAll()
        {
            try
            {
                $BilldboardList = array();

                $query = "SELECT * FROM "."Billdboards;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Billdboard = new Billdboard();
                    
                    $Billdboard->setId($row["Id"]);
                    $Billdboard->setName($row["name_Billdboard"]);
                    $Billdboard->setAddress($row["address_Billdboard"]);
                    $Billdboard->setCapacity($row["capacity"]);
                    $Billdboard->setValue($row["value"]);
                    

                    array_push($BilldboardList, $Billdboard);
                }


                usort($BilldboardList,function ($a, $b){
                    if($a == $b) {
                        return 0;
                    }
                    return ($a < $b) ? -1 : 1;
                });


                return $BilldboardList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    

   

    public function GetById($id)
    {
        try
        {
           

            $query = "SELECT * FROM Billdboards WHERE Billdboards.Id =".$id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $BilldboardSearch=null;
            foreach ($resultSet as $row)
            {                
                $BilldboardSearch = new Billdboard();
                $BilldboardSearch->setId($row['Id']);
                $BilldboardSearch->setName($row["name_Billdboard"]);
                $BilldboardSearch->setAddress($row["address_Billdboard"]);
                $BilldboardSearch->setCapacity($row["capacity"]);
                $BilldboardSearch->setValue($row["value"]);
                

                
            }
            
  
            return $BilldboardSearch;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function ModifyBilldboard($Billdboard)
        {
            try
            {
               
                $query = "UPDATE Billdboards SET name_Billdboard= "."'".$Billdboard->getName()."'"." ,address_Billdboard= "."'".$Billdboard->getAddress()."'"." ,capacity= ".$Billdboard->getCapacity()." ,value= ".$Billdboard->getValue()." WHERE Id= ".$Billdboard->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveBilldboard($Billdboard)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Billdboards WHERE Id="."'".$Billdboard->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Billdboard)
        {
            try
            {
               

                $query = "INSERT INTO Billdboards (name_Billdboard, address_Billdboard, capacity,value) VALUES (:name_Billdboard, :address_Billdboard, :capacity, :value);";
                
                $parameters["name_Billdboard"] = $Billdboard->getName();
                $parameters["address_Billdboard"] = $Billdboard->getAddress();
                $parameters["capacity"] = $Billdboard->getCapacity();
                $parameters["value"] = $Billdboard->getValue();
               
                $this->connection = Connection::GetInstance();                
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            }
            catch(Exception $ex)
            {
                var_dump($ex);
            }
        }
 } 

?>

