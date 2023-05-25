<?php 
include "../db/connect.php";

$flight_prices = "CREATE TABLE flight_prices(
    id INT NOT NULL AUTO_INCREMENT,
    airline VARCHAR(255) NULL,
    source VARCHAR(255) NULL,
    destination VARCHAR(255) NULL,
    routes VARCHAR(255) NULL,
    dep_time VARCHAR(255) NULL,
    arr_time VARCHAR(255) NULL,
    duration VARCHAR(255) NULL,
    total_stops VARCHAR(255) NULL,
    additional_info VARCHAR(255) NULL,
    price VARCHAR(255) NULL,
    PRIMARY KEY(id)
    )";

//mysqli_query($conn,$flight_prices);

$users = "CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NULL,
    password VARCHAR(255) NULL,
    full_name VARCHAR(255) NULL,
    created DATE NOT NULL,
    PRIMARY KEY(id)
    )";

//mysqli_query($conn,$users);

$orders = "CREATE TABLE orders(
    id INT NOT NULL AUTO_INCREMENT,
    customer_id VARCHAR(255) NULL,
    customer_name VARCHAR(255) NULL,
    flight_no VARCHAR(255) NULL,
    departure VARCHAR(255) NULL,
    destination VARCHAR(255) NULL,
    departure_date VARCHAR(255) NULL,
    return_date VARCHAR(255) NULL,
    created DATE NOT NULL,
    PRIMARY KEY(id)
    )";

//mysqli_query($conn,$orders);
?>