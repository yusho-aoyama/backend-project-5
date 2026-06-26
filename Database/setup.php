<?php

use Database\MySQLWrapper;

$mysqli = new MySQLWrapper();

/*
|--------------------------------------------------------------------------
| Create cars table
|--------------------------------------------------------------------------
*/
$result = $mysqli->query("
    CREATE TABLE IF NOT EXISTS cars (
      id INT PRIMARY KEY AUTO_INCREMENT,
      make VARCHAR(50),
      model VARCHAR(50),
      year INT,
      color VARCHAR(20),
      price FLOAT,
      mileage FLOAT,
      transmission VARCHAR(20),
      engine VARCHAR(20),
      status VARCHAR(10)
    );
");

if ($result === false) {
    throw new Exception('Could not create cars table.');
}

/*
|--------------------------------------------------------------------------
| Create car_parts table
|--------------------------------------------------------------------------
*/
$result = $mysqli->query("
    CREATE TABLE IF NOT EXISTS car_parts (
        id INT PRIMARY KEY AUTO_INCRFEMENT,
        carID INT NOT NULL,
        name VARCHAR(255),
        description TEXT,
        price FLOAT,
        quantityInStock INT.
        FOREIGN KEY (carID) REFERENCES cars(id) 
    );
");

if ($result === false) {
    throw new Exception ('Could not create car_parts table');
}

print("Successfully ran all SQL setup queries." . PHP_EOL);