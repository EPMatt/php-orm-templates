<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Examples - World Database - City DAO Class
 */

require_once("city.php");
require_once(__DIR__."/../../../sources/dao.php");
class Cities extends DataAccessObject{

    /**
     * Constructor with parameters
     * @param DBConnector $conn the connection instance which will be used to interface with the table
     * @param string $tableName the name of the table mapped by this class
     */
    public function __construct(DBConnector $conn,string $tableName) {
        parent::__construct($conn,$tableName,City::class);
    }

     /**
     * Return a collection of data selected from the table, filtered by name
     * @param string $name the filter which should be applied to the query 
     * @return array|false an indexed array of City instances corresponding to the retrieved records, or false if an error occurred
     */
    public function selectByNameLike(string $name) {
        $opt['Name']="%$name%";
        $rs= $this->conn->execute("SELECT * FROM $this->tableName WHERE Name LIKE :Name",$opt);
        if($rs===false) return false;
        return $this->fromArray($rs);
   }

     /**
     * Return all cities in the table
     * @return array an indexed array of City instances corresponding to the retrieved records, or null if no record was found
     */
    public function selectAll() {
        return $this->selectByFilter([]);
    }

}
?>