<?php

use Database\MySQLWrapper;

$mysqli = new MySQLWrapper();

/*
|--------------------------------------------------------------------------
| Create cars table
|--------------------------------------------------------------------------
*/

$result = $mysqli->query(
    file_get_contents(__DIR__ . '/Examples/cars-setup.sql')
);



/*
|--------------------------------------------------------------------------
| Create car_parts table
|--------------------------------------------------------------------------
*/
$result = $mysqli->query("
    CREATE TABLE IF NOT EXISTS car_parts (
        id INT PRIMARY KEY AUTO_INCREMENT,
        carID INT NOT NULL,
        name VARCHAR(255),
        description TEXT,
        price FLOAT,
        quantityInStock INT,
        FOREIGN KEY (carID) REFERENCES cars(id) 
    );
");

if($result === false) throw new Exception('Could not execute query.');
else print("Successfully ran all SQL setup queries.".PHP_EOL);
