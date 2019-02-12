<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Examples - World Database - City DAO Class
 */

require_once(__DIR__."/../../../sources/dbconnector.php");
require_once("city.php");

class Cities {
    //Connection instance and name of the table mapped by this class
    private $conn;
    private $tableName;

    /**
     * Constructor with parameters
     * @param conn the connection instance which will be used to interface with the table
     * @param tableName the name of the table mapped by this class
     */
    public function __construct(DBConnector $conn,$tableName) {
        $this->conn = $conn;
        $this->tableName = $tableName;
    }

    /**
     * Return the number of rows in the table
     * @return cnt the number of rows in the corresponding table
     */
    public function count() {
        $opt['tableName']=$this->tableName;
        return $this->conn->execute("SELECT COUNT(*) AS cnt FROM $this->tableName",$opt)[0]['cnt'];
    }

    /**
     * Return a Data Object instance corresponding to the row with the given id in the table
     * @param id the primary key of the table
     * @return do the data object corresponding to the retrieved record, or null if no record was found
     */
    public function getFromId($id) {
        $opt['tableName']=$this->tableName;
        $opt['ID']=$id;
        $rs= $this->conn->execute("SELECT * FROM $this->tableName WHERE ID=:id",$opt)[0];
        if($rs!=null) return City::fromArray($rs);
        return null;
    }

     /**
     * Return a collection of data selected from the table, filtered by name
     * @param name the filter which should be applied to the query 
     * @return dos an indexed array of City instances corresponding to the retrieved records, or null if no record was found
     */
    public function selectByNameLike($name) {
        $opt['Name']="%$name%";
        $rs= $this->conn->execute("SELECT * FROM $this->tableName WHERE Name LIKE :Name",$opt);
        if($rs!=null){
           $dos;
           for ($i=0; $i < count($rs); $i++) { 
               $dos[$i]=City::fromArray($rs[$i]);
           }
           return $dos;
        }
        return null;
   }

     /**
     * Return all cities in the table
     * @return dos an indexed array of City instances corresponding to the retrieved records, or null if no record was found
     */
    public function selectAll() {
         $rs= $this->conn->execute("SELECT * FROM $this->tableName");
         if($rs!=null){
            $dos;
            for ($i=0; $i < count($rs); $i++) { 
                $dos[$i]=City::fromArray($rs[$i]);
            }
            return $dos;
         }
         return null;
    }

    /**
     * Return a collection of data selected from the table, filtered by the given parameter
     * @param filter associative array of filters to be applied to the query
     * @return dos an indexed array of DataObject instances corresponding to the retrieved records, or null if no record was found
     */
    public function selectByFilter($filter) {
        $conditions="";
        foreach ($filter as $key => $fil) {
            $opt[$key] = $fil;
            $conditions.= " $key=:$key AND";
        }
        $conditions=substr($conditions,0,strrpos($conditions,"AND"));
        $rs = $this->conn->execute("SELECT * FROM $this->tableName WHERE $conditions", $opt);
        if ($rs != null) {
            $dos;
            for ($i = 0; $i < count($rs); $i++) {
                $dos[$i]=City::fromArray($rs[$i]);
            }
            return $dos;
        }
        return null;
    }
}
?>