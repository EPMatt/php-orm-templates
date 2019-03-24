<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Templates - Data Object Class
 */
class DataObject {

    /**
     * Construct an instance with the given values
     */
    public function __construct() {
    }

 
    /**
     * Get an associative array representing the object
     * @return array the associative array corresponding to the current DataObject instance
     */
    public function getArray(){
        return array();
    }
    

    /**
     * Get an associative array containing the primary key of the object
     * @return array the associative array corresponding to the current DataObject instance primary key
     */
    public function getPrimaryKey(){
        return array();
    }


    /**
     * Get an associative array containing the fields of the object (primary key excluded)
     * @return array the associative array corresponding to the current DataObject instance fields, primary key excluded
     */
    public function getFields(){
        return array();
    }

     /**
     * Construct an instance from a record
     * @param array $fields associative array corresponding to a record in the table
     * @return DataObject $do the Data Object instance corresponding to the given array
     */
    public static function fromArray(array $fields) {
        return new DataObject();
    }


}
?>