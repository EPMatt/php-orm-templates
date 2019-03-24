# ORM Templates
## Concepts
**ORM (Object Relational Mapping)** is an Object Oriented software design pattern which implies the mapping of database relations (tables) into classes.

With ORM two other design patterns are often used:
- **DO (Data Object)**: definition of a class which provides mapping of a relation instance (record) into an object instance;
- **DAO (Data Access Object)**: definition of a class to interact with a given relation (table), which encapsulates the querying process, providing the user a complete Object Oriented interface, using Data Object instances and collections.

More about ORM on [Wikipedia](https://en.wikipedia.org/wiki/Object-relational_mapping).

## Usage

This repository contains DO and DAO classes + `DBConnector`, a class used to ease the interaction with MySQL for basic PHP applications.<br>
The `DBConnector` class must be used to instantiate a database connection.<br>
You can define Data Object and Data Access Object classes for your own application data by extending the `DataObject` and `DataAccessObject` classes.<br>**Your Data Object** class must redefine a few methods like so:

```
class  MyDataObject extends DataObject{
    private $field1;
    private $field2;

    public function __construct($field1,$field2){
        //your ctor code here
    }

    public static function fromArray(array $fields) {
        //return a MyDataObject instance constructed from an associative array
    }

    public function getField1(){
        //getter code here
    }

    public function setField1($field1){
        //setter code here
    }

    public function getArray() {
        //return an associative array representing the MyDataObject instance
    }

    public function getPrimaryKey(){
        //return an associative array corresponding to the current MyDataObject instance primary key
    }
    
    public function getFields(){
       //return an associative array corresponding to the current MyDataObject instance fields, primary key excluded
    }

}
```
Your **Data Access Object** class must be defined as follows:
```
class MyDataAccessObject extends DataAccessObject{

    public function __construct(DBConnector $conn,$tableName) {
        //pass your custom Data Object class to the DataAccessObject constructor
        parent::__construct($conn,$tableName,MyDataObject::class);
    }

    //custom methods here

}
```
Methods for `INSERT`, `UPDATE`, `DELETE` and generic `SELECT` with basic `WHERE...AND...` filter are already implemented in the `DataAccessObject` class. To perform **advanced queries on the DB** (such as `SELECT` with `LIKE` or `BETWEEN...AND...`) define the methods you need in your Data Access Object Class.

These classes are designed to achieve the **maximum isolation** between the DB structure and your application, as the table definition is contained in the custom Data Object class and nowhere else. Moreover you don't need to copy/paste code for basic operations with multiple tables, just extend the provided classes and **define only what you need**. That's it!

Check the `examples` folder for further details on how to use these classes.
You'll get a much more organized code by including the ORM pattern in your application.

## Content
- **sources**: a folder containing ORM templates and DBConnector, the class to connect to a MySQL database;
- **examples**: a folder containing a few usage examples of these templates; check out `readme.md` within each example folder.
