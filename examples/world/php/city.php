<?php
/**
 * Author:      Agnoletto Matteo (EPMatt)
 * Date:        11/02/2019
 * ORM Examples - World Database - City DO Class
 */
class City {
    // Fields in the relation
    private $id;
    private $name;
    private $countryCode;
    private $district;
    private $population;

    /**
     * Construct an instance with the given values
     * @param id city identifier
     * @param name city name
     * @param countryCode code of the country the city belongs to
     * @param district city district
     * @param population city population
     */
    public function __construct($id, $name, $countryCode, $district, $population) {
        //edit accordingly to table definition
        $this->id = $id;
        $this->name = $name;
        $this->countryCode = $countryCode;
        $this->district = $district;
        $this->population = $population;
    }

    /**
     * Construct an instance from a record
     * @param fields associative array corresponding to a record in the table
     * @return do the Data Object instance corresponding to the given array
     */
    public static function fromArray($fields) {
        //edit accordingly to table definition
        return new City($fields['ID'], $fields['Name'], $fields['CountryCode'], $fields['District'], $fields['Population']);
    }

    /**
     * Get the value of id
     * @return id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of name
     * @return name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get the value of countryCode
     * @return countryCode
     */
    public function getCountryCode() {
        return $this->countryCode;
    }

    /**
     * Get the value of district
     * @return district
     */
    public function getDistrict() {
        return $this->district;
    }

    /**
     * Get the value of population
     * @return population
     */
    public function getPopulation() {
        return $this->population;
    }
}
?>