<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Templates - Data Access Object Class Template
 */

//edit accordingly to your folder structure
require_once "dbconnector.php";
require_once "do.php";

class DataAccessObject {
    // Constants
    const CLASS_CONST_1 = 1;
    const CLASS_CONST_2 = 2;
    //Connection instance and name of the table mapped by this class
    private $conn;
    private $tableName;

    /**
     * Constructor with parameters
     * @param conn the connection instance which will be used to interface with the table
     * @param tableName the name of the table mapped by this class
     */
    public function __construct(DBConnector $conn, $tableName) {
        $this->conn = $conn;
        $this->tableName = $tableName;
    }

    /**
     * Insert the given Data Object instance in the DB
     * @param do the Data Object instance to be inserted in the DB
     */
    public function insert(DataObject $do) {
        //edit options accordingly to table definition
        $opt['field1'] = $do->getField1();
        $opt['field2'] = $do->getField2();
        //edit query accordingly to table definition
        $this->conn->execute("INSERT INTO $this->tableName VALUES(:field1,:field2)", $opt);
    }

    /**
     * Delete the row with the given id
     * @param id the primary key of the table, to change accordingly to the table definition
     */
    public function delete($id) {
        //edit options accordingly to the primary key
        $opt['id'] = $id;
        //edit query accordingly to the primary key
        $this->conn->execute("DELETE FROM $this->tableName WHERE id=:id", $opt);
    }

    /**
     * Update the row with the given id (in the Data Object instance) with the given Data Object instance
     * @param do the Data Object which contains updated data
     */
    public function update(DataObject $do) {
        //edit options accordingly to table definition
        $opt['field1'] = $do->getField1();
        $opt['field2'] = $do->getField2();
        //edit query accordingly to table definition
        $this->conn->execute("UPDATE $this->tableName SET field1=:field1 WHERE field2=:field2", $opt);
    }

    /**
     * Return the number of rows in the table
     * @return cnt the number of rows in the corresponding table
     */
    public function count() {
        return $this->conn->execute("SELECT COUNT(*) AS cnt FROM $this->tableName", $opt)[0]['cnt'];
    }

    /**
     * Return a Data Object instance corresponding to the row with the given id in the table
     * @param id the primary key of the table, to change accordingly to the table definition
     * @return do the data object corresponding to the retrieved record, or null if no record was found
     */
    public function getFromId($id) {
        //edit options accordingly to the primary key
        $opt['id'] = $id;
        //edit query accordingly to the primary key
        $rs = $this->conn->execute("SELECT * FROM $this->tableName WHERE id=:id", $opt)[0];
        //edit accordingly to the respective DataObject class definition
        if ($rs != null) {
            return DataObject::fromArray($rs);
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
                $dos[$i]=DataObject::fromArray($rs[$i]);
            }
            return $dos;
        }
        return null;
    }
}
?>