<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Templates - Data Object Class Template
 */
class DataObject {
    // Constants
    const CLASS_CONST_1 = 1;
    const CLASS_CONST_2 = 2;
    // Fields in the relation, edit accordingly to table definition
    private $field1;
    private $field2;

    /**
     * Construct an instance with the given values
     * @param field1 value of field1
     * @param field2 value of field2
     */
    public function __construct($field1 = null, $field2 = null) {
        //edit accordingly to table definition
        $this->$field1 = $field1;
        $this->$field2 = $field2;
    }

    /**
     * Construct an instance from a record
     * @param fields associative array corresponding to a record in the table
     * @return do the Data Object instance corresponding to the given array
     */
    public static function fromArray($fields) {
        //edit accordingly to table definition
        return new DataObject($fields['field1'], $fields['field2']);
    }

    /**
     * Get the value of field1
     * @return field1 the current value of field1
     */
    public function getField1() {
        return $this->field1;
    }

    /**
     * Get the value of field2
     * @return field2 the current value of field2
     */
    public function getField2() {
        return $this->field2;
    }

    /**
     * Set the value of field1
     *
     * @return  self
     */
    public function setField1($field1) {
        $this->field1 = $field1;
        return $this;
    }

    /**
     * Set the value of field2
     *
     * @return  self
     */
    public function setField2($field2) {
        $this->field2 = $field2;
        return $this;
    }
}
?>