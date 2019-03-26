<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Templates - Data Object Class
 */
abstract class DataObject {
 
    /**
     * Get an associative array representing the object
     * @return array the associative array corresponding to the current DataObject instance
     */
    abstract public function getArray();
    

    /**
     * Get an associative array containing the primary key of the object
     * @return array the associative array corresponding to the current DataObject instance primary key
     */
    abstract public function getPrimaryKey();


    /**
     * Get an associative array containing the fields of the object (primary key excluded)
     * @return array the associative array corresponding to the current DataObject instance fields, primary key excluded
     */
    abstract public function getFields();

     /**
     * Construct an instance from a record
     * @param array $fields associative array corresponding to a record in the table
     * @return DataObject $do the Data Object instance corresponding to the given array
     */
    abstract public static function fromArray(array $fields);


}
?>