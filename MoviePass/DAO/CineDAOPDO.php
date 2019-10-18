<?php namespace DAO;

use DAO\ICineDAO as ICineDAO;
use Models\Cine as Cine;
use DAO\Connection as Connection;
use \Exception as Exception;

class CineDAOPDO implements ICineDAO{

  
    private $connection;


    
    public function GetAll()
        {
            try
            {
                $CineList = array();

                $query = "SELECT * FROM "."Cines;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Cine = new Cine();
                    
                    $Cine->setId($row["Id"]);
                    $Cine->setName($row["Name"]);
                    $Cine->setAddress($row["Address"]);
                    $Cine->setCapacity($row["Capacity"]);
                    $Cine->setValue($row["Value"]);
                    

                    array_push($CineList, $Cine);
                }


                usort($CineList,function ($a, $b){
                    if($a == $b) {
                        return 0;
                    }
                    return ($a < $b) ? -1 : 1;
                });


                return $CineList;
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
           

            $query = "SELECT * FROM Cines WHERE Cines.Id =".$id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $CineSearch=null;
            foreach ($resultSet as $row)
            {                
                $CineSearch = new Cine();
                $CineSearch->setId($row['Id']);
                $CineSearch->setName($row["Name"]);
                $CineSearch->setAddress($row["Address"]);
                $CineSearch->setCapacity($row["Capacity"]);
                $CineSearch->setValue($row["Value"]);
                

                
            }
            
  
            return $CineSearch;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function ModifyCine($Cine)
        {
            try
            {
               
                $query = "UPDATE Cines SET Name= "."'".$Cine->getName()."'"." ,Address= "."'".$Cine->getAddress()."'"." ,Capacity= ".$Cine->getCapacity()." ,Value= ".$Cine->getValue()." WHERE Id= ".$Cine->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveCine($Cine)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM Cines WHERE Id="."'".$Cine->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($Cine)
        {
            try
            {
               

                $query = "INSERT INTO Cines (Name, Address, Capacity,Value) ValueS (:Name, :Address, :Capacity, :Value);";
                
                $parameters["Name"] = $Cine->getName();
                $parameters["Address"] = $Cine->getAddress();
                $parameters["Capacity"] = $Cine->getCapacity();
                $parameters["Value"] = $Cine->getValue();
               
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

