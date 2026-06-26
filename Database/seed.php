<?php
use Database\MySQLWrapper;

$mysqli = new MySQLWrapper();

$car_insert_query = "
    INSERT INTO Car (make, model, year, color, price, mileage, transmission, engine, status)
    VALUES ('Toyota', 'Corolla', 2020, 'Blue', 20000, 1500, 'Automatic', 'Gasoline', 'Available'),
           ('Honda', 'Civic', 2019, 'Red', 18500, 1200, 'Manual', 'Gasoline', 'Sold');
";

$result = $mysqli->query($car_insert_query);
if($result === false) throw new Exception('Could not execute car insertion query.');

$part_insert_query = "
    INSERT INTO Part (name, description, price, quantityInStock)
    VALUES ('Brake Pad', 'High Quality Brake Pad', 45.99, 100),
           ('Oil Filter', 'Long-lasting Oil Filter', 10.99, 200);
";

$result = $mysqli->query($part_insert_query);
if($result === false) throw new Exception('Could not execute part insertion query.');

$car_part_insert_query = "
    INSERT INTO CarPart (carID, partID, quantity)
    VALUES (1, 1, 4),
           (1, 2, 1);
";

$result = $mysqli->query($car_part_insert_query);
if($result === false) throw new Exception('Could not execute car-part insertion query.');

echo "Data insertion successful.";

$mysqli->close();