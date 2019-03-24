<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Examples - World Database - City DO Class
 */
require_once(__DIR__."/../../../sources/do.php");

class City extends DataObject{
    // Fields in the relation
    private $id;
    private $name;
    private $countryCode;
    private $district;
    private $population;

    /**
     * Construct an instance with the given values
     * @param $id city identifier
     * @param string $name city name
     * @param string $countryCode code of the country the city belongs to
     * @param string $district city district
     * @param int $population city population
     */
    public function __construct($id, string $name, string $countryCode, string $district, int $population) {
        $this->id = $id;
        $this->name = $name;
        $this->countryCode = $countryCode;
        $this->district = $district;
        $this->population = $population;
    }

    /**
     * Construct an instance from a record
     * @param array $fields associative array corresponding to a record in the table
     * @return City the City instance corresponding to the given array
     */
    public static function fromArray(array $fields) {
        return new City($fields['ID'], $fields['Name'], $fields['CountryCode'], $fields['District'], $fields['Population']);
    }

    /**
     * Get the value of id
     * @return int id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of name
     * @return string name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get the value of countryCode
     * @return string countryCode
     */
    public function getCountryCode() {
        return $this->countryCode;
    }

    /**
     * Get the value of district
     * @return string district
     */
    public function getDistrict() {
        return $this->district;
    }

    /**
     * Get the value of population
     * @return int population
     */
    public function getPopulation() {
        return $this->population;
    }

     /**
     * Get an associative array representing the object
     * @return array the associative array corresponding to the current City instance
     */
    public function getArray() {
        return [
            "ID"=>$this->getId(),
            "Name"=>$this->getName(),
            "CountryCode"=>$this->getCountryCode(),
            "District"=>$this->getDistrict(),
            "Population"=>$this->getPopulation()
        ];
    }

     /**
     * Get an associative array containing the primary key of the object
     * @return array the associative array corresponding to the current City instance primary key
     */
    public function getPrimaryKey(){
        return [
            "ID"=>$this->getId()
        ];
    }
    
      /**
     * Get an associative array containing the fields of the object (primary key excluded)
     * @return array the associative array corresponding to the current City instance fields, primary key excluded
     */
    public function getFields(){
        return [
            "Name"=>$this->getName(),
            "CountryCode"=>$this->getCountryCode(),
            "District"=>$this->getDistrict(),
            "Population"=>$this->getPopulation()
        ];
    }

}
?>