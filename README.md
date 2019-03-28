# Food House Unipr

The purpose of the project is the development of a database
that allows the management of a restaurant system
for home deliveries.

The choice of room can be made between 6 kitchens
different (Italian, Chinese, Mexican, Japanese,
Indian, Greek). 

Each restaurant is characterized by
a name, an opening and closing time and from a
address.


The database must allow the management of several
categories of products with their respective
features (product name, price, description).


To access this portal, every customer needs
register by entering your data (username, password,
name, surname, e-mail address, telephone number).


Each customer can make one or more orders and per
each of them must be specified: date of
purchase and total order price.


For every order placed, which exceeds 20 euros of expense,
a 5% discount voucher is issued.


For the purposes of the project, consider that the database is
available through a website visited by around 1000
people / day. 

The pages of the site include:

* A description of the site

* A list of the premises

* The user profile

## DEMO Online
You can see it online at this [link](https://goprojectunipr.altervista.org/).

## Installation

You have to install simply software like XAMPP to run local server and web space. 
Create database's tables as shown in this [file](https://github.com/GiuseppeLG/Food-House-Unipr/blob/master/Database%20Structure%20and%20Design/create%20table.sql). 

## Usage
You have to edit "db_con.php":
```php
<?php
$servername = "";
$username = "goprojectunipr";
$password = "";
$dbname = "my_goprojectunipr"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
This software is free.
[GPL](http://www.gnu.org/licenses/gpl.html)
