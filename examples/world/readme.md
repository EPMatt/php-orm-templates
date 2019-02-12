# Example - World Database
A simple web app based on the [World Database](http://downloads.mysql.com/docs/world.sql.zip), which provides basic search capabilities on the list of cities stored in the database. The ORM pattern has been applied to the `city` table.

The `php` folder contains:
- `cities.php` which defines the DAO class for the table;
- `city.php` which defines the DO class for the table.

As the application only reads data from the database, methods for inserting, updating or deleting records have been deleted.

The website uses [Bootstrap](https://getbootstrap.com/) for elements styling and responsive resizing.