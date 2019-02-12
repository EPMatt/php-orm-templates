# ORM Templates
## Concepts
**ORM (Object Relational Mapping)** is an Object Oriented software design pattern which implies the mapping of database relations (tables) into classes.

With ORM two other design patterns are often used:
- **DO (Data Object)**: definition of a class which provides mapping of a relation instance (record) into an object instance;
- **DAO (Data Access Object)**: definition of a class to interact with a given relation (table), which encapsulates the querying process, providing the user a complete Object Oriented interface, using Data Object instances and collections.

More about ORM on [Wikipedia](https://en.wikipedia.org/wiki/Object-relational_mapping).

This repository contains templates for DO and DAO classes + DBConnector, a class used to ease the interaction with MySQL for basic PHP applications.
You can edit these templates to fit your project needs (if you need help, check the examples folder). You'll get a much more organized code by including the ORM pattern in your application.

## Content
- **sources**: a folder containing ORM templates and DBConnector, the class to connect to a MySQL database;
- **examples**: a folder containing a few usage examples of these templates; check out `readme.md` within each example folder.
