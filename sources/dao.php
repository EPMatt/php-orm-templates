<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Templates - Data Access Object Class
 */

require_once "dbconnector.php";
require_once "do.php";

class DataAccessObject {
    //Connection instance and name of the table mapped by this class, DataObject class (which should extend DataObject)
    protected $conn;
    protected $tableName;
    protected $doc;

    /**
     * Constructor with parameters
     * @param DBConnector $conn the connection instance which will be used to interface with the table
     * @param string $tableName the name of the table mapped by this class
     * @param string $doc DataObject Class
     */
    public function __construct(DBConnector $conn, string $tableName, string $doc) {
        $this->conn = $conn;
        $this->tableName = $tableName;
        $this->doc = $doc;
    }

    /**
     * Insert the given Data Object instance in the DB
     * @param DataObject $do the DataObject instance to be inserted in the DB
     * @return bool true if the insert succeded, false if not
     */
    public function insert(DataObject $do) {
        $opt = $do->getArray();
        $params = "";
        foreach ($opt as $key => $option) {
            $params .= ":$key,";
        }
        $params = substr($params, 0, strlen($params) - 1);
        if ($this->conn->execute("INSERT INTO $this->tableName VALUES($params)", $opt) === false) return false;
        if($this->conn->lastAffectedRows()===0) return false;
        return true;
    }

    /**
     * Delete the row with the given id
     * @param DataObject $do the DataObject instance which should contain the primary key of the record to be deleted
     * @return bool true if the deletion succeeded, false if not
     */
    public function delete(DataObject $do) {
        $opt = $do->getPrimaryKey();
        $conditions = "";
        foreach ($opt as $key => $option) {
            $conditions .= "$key=:$key AND";
        }
        $conditions = substr($conditions, 0, strlen($conditions) - 3);
        if($this->conn->execute("DELETE FROM $this->tableName WHERE $conditions", $opt)===false)return false;
        if($this->conn->lastAffectedRows()===0) return false;
        return true;
    }

    /**
     * Update the row with the given id (in the Data Object instance) with the given Data Object instance
     * @param DataObject $do the Data Object which contains updated data
     * @return bool true if update succeeded, false if not
     */
    public function update(DataObject $do) {
        $opt = $do->getArray();
        $pks="";
        $flds="";
        foreach ($do->getPrimaryKey() as $key => $option) {
            $pks.="$key=:$key AND";
        }
        $pks = substr($pks, 0, strlen($pks) - 3);
        foreach ($do->getFields() as $key => $option) {
            $flds.="$key=:$key,";
        }
        $flds = substr($flds, 0, strlen($flds) - 1);
        if($this->conn->execute("UPDATE $this->tableName SET $flds WHERE $pks", $opt)===false)return false;
        if($this->conn->lastAffectedRows()===0) return false;
        return true;
    }

    /**
     * Return the number of rows in the table
     * @return int the number of rows in the corresponding table
     */
    public function count() {
        return $this->conn->execute("SELECT COUNT(*) AS cnt FROM $this->tableName")[0]['cnt'];
    }

    /**
     * Return a DataObject instance corresponding to the row with the given id in the table
     * @param int $id the primary key of the table, to change accordingly to the table definition
     * @return DataObject|null|false the DataObject corresponding to the retrieved record, null if no record was found or false if an error occurred
     */
    public function getFromId(DataObject $do) {
        $opt= $do->getPrimaryKey();
        $pks="";
        foreach ($do->getPrimaryKey() as $key => $option) {
            $pks.="$key=:$key AND";
        }
        $pks = substr($pks, 0, strlen($pks) - 3);
        $rs = $this->conn->execute("SELECT * FROM $this->tableName WHERE $pks", $opt);
        if($rs===false) return false;
        if(count($rs)===0) return null;
        return $this->class::fromArray($rs[0]);
    }

    /**
     * Return a collection of DataObject selected from the table, filtered by the given parameter
     * @param array $filter associative array of filters to be applied to the query
     * @return array|false an indexed array of DataObject instances corresponding to the retrieved records, or false if an error occurred
     */
    public function selectByFilter(array $filter) {
        $where = "";
        $opt=[];
        if(count($filter)!=0){
        $where.="WHERE ";
        foreach ($filter as $key => $fil) {
            $opt[$key] = $fil;
            $where .= " $key=:$key AND";
        }
        $where = substr($where, 0, strlen($where)-3);
        }
        $rs = $this->conn->execute("SELECT * FROM $this->tableName $where", $opt);
        if($rs===false)return false;
        return $this->fromArray($rs);
    }

    /**
     * Return a collection of DataObject instances from an indexed array of associative arrays
     * @param array $rs indexed array of associative arrays
     * @return array an indexed array of DataObject instances corresponding to the retrieved records
     */
    protected function fromArray(array $rs) {
        $dos = array();
        for ($i = 0; $i < count($rs); $i++) {
            $dos[$i] = $this->doc::fromArray($rs[$i]);
        }
        return $dos;
    }
}
?>
