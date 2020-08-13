<?php
include 'database\connection.db.php';

// CRUD for products

// create

function createProduct($name, $description, $price)
{
    $connection = getConn();
    echo $connection ? "success <br>" : "failed <br>";

    // prepare and bind
    $stmt = $connection->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $price);

    // set parameters and execute
    $stmt->execute();

    echo "New records created successfully";

    $stmt->close();
    $connection->close();
}

function readProduct ($id){

    $connection = getConn();
    echo $connection ? "success <br>" : "failed <br>";

    if (isset($id)){
        
    }

}
