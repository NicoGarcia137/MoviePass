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
                $cineList = array();

                $query = "SELECT * FROM "."cines;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cine = new Cine();
                    
                    $cine->setId($row["Id"]);
                    $cine->setName($row["name_cine"]);
                    $cine->setAddress($row["address_cine"]);
                    $cine->setCapacity($row["capacity"]);
                    $cine->setValue($row["value"]);
                    

                    array_push($cineList, $cine);
                }

                return $cineList;
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
           

            $query = "SELECT * FROM cines WHERE cines.Id =".$id.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $cineSearch=null;
            foreach ($resultSet as $row)
            {                
                $cineSearch = new Cine();
                $cineSearch->setId($row['Id']);
                $cineSearch->setName($row["name_cine"]);
                $cineSearch->setAddress($row["address_cine"]);
                $cineSearch->setCapacity($row["capacity"]);
                $cineSearch->setValue($row["value"]);
                

                
            }
            
  
            return $cineSearch;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function ModifyCine($cine)
        {
            try
            {
               
                $query = "UPDATE cines SET name_cine= "."'".$cine->getName()."'"." ,address_cine= "."'".$cine->getAddress()."'"." ,capacity= ".$cine->getCapacity()." ,value= ".$cine->getValue()." WHERE Id= ".$cine->getId().";";

                $this->connection = Connection::GetInstance();
                echo "<script>if(confirm('echo $query'));</script>";
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveCine($cine)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM cines WHERE Id="."'".$cine->getId()."'".";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add($cine)
        {
            try
            {
               

                $query = "INSERT INTO cines (name_cine, address_cine, capacity,value) VALUES (:name_cine, :address_cine, :capacity, :value);";
                
                $parameters["name_cine"] = $cine->getName();
                $parameters["address_cine"] = $cine->getAddress();
                $parameters["capacity"] = $cine->getCapacity();
                $parameters["value"] = $cine->getValue();
               
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

