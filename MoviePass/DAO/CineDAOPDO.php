<?php namespace DAO;

use DAO\ICineDAO as ICineDAO;
use Models\Cine as Cine;
use DAO\Connection as Connection;
class CineDAO implements ICineDAO{

  
    private $connection;
    private $tableName ="cines";


    
    public function GetAll()
        {
            try
            {
                $cineList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cine = new Cine();
                    $cine->setName($row["name_cine"]);
                    $cine->set($row["address_cine"]);
                    $cine->set($row["capacity"]);
                    $cine->set($row["value"]);
                    

                    array_push($cineList, $cine);
                }

                return $cineList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    

   

    public function SearchByName(Cine $cine)
    {
        try
        {
           

            $query = "SELECT * FROM ".$this->tableName ."WHERE".$this->tableName .".name_cine =".$cine->getName().";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {                
                $cineSearch = new Cine();
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
    
    public function ModifiyCine(Cine $cine)
        {
            try
            {
                $query = "UPDATE ".$this->tableName."SET"."name_cine=".$cine->getName().",address_cine=".$cine->getAddress().",capacity=".$cine->getCapacity().",value=".$cine->getValue()."WHERE name_cine=".$cine->getName().";";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function RemoveCine(Cine $cine)
    {
        try
        { //FIJARSE EL NOMBRE DE LA TABLA POR TABLENAME
            
            $query = "DELETE FROM".$this->tableName."WHERE"."id_cine=".$cine->getIdCine()."LIMIT 1;";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
    public function Add(Cine $cine)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name_cine, address_cine, capacity,value) VALUES (:name_cine, :address_cine, :capacity, :value);";
                
                $parameters["name_cine"] = $cine->getName();
                $parameters["address_cine"] = $cine->getAddress();
                $parameters["capacity"] = $cine->getCapacity();
                $parameters["value"] = $cine->getValue();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
 } 

?>

