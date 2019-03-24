<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * DBConnector - Class to handle db connections
 */

class DBConnector {
    private $db;
    private $st;

    /**
     * Constructor for the db connector class
     * @param string $ini path to a configuration file, which must contain:
     *  -username
     *  -password
     *  -host
     *  -port
     *  -dbname
     */
    public function __construct(string $ini) {
        $options=parse_ini_file($ini);
        $username = $options['username'];
        $password = $options['password'];
        $host = $options['host'];
        $port = $options['port'];
        $dbname = $options['dbname'];
        $this->db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    }

    /**
     * execute a query on the db, and return the result
     * @param string $query the query to be executed, it can contain also placeholders for parameters (whose values must be contained in the following argument)
     * @param array $params the parameters for the query as an associative array with key = placeholder in the query
     * @return array|false an indexed array of associative arrays with the query result, or false if an error occurred when executing the query
     */
    public function execute(string $query, array $params = null) {
        $rs = "";
        $this->st = $this->db->prepare($query);
        if ($params != null) {
            //bind values
            foreach ($params as $key => $param) {
                $this->st->bindValue(':' . $key, $param);
            }
        }
        //execute and fetch
        if($this->st->execute()===true) return $this->st->fetchAll(PDO::FETCH_ASSOC);
        return false;
    }

    /**
     * get the number of affected rows for the last executed query
     * @return int the number of affected rows for the last executed query
     */
    public function lastAffectedRows(){
        if($this->st===null) return 0;
        return $this->st->rowCount();
    }
}
?>