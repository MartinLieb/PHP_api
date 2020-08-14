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

function readProduct($id)
{
    $connection = getConn();
    echo $connection ? "success <br>" : "failed <br>";

    if (isset($id)) {
        $stmt = $connection->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["description"]. " " . $row["price"]. " " . $row["updated_at"]. " " . $row["created_at"]. "<br>";
            }
        } else {
            echo "0 results";
        }
        $stmt->close();
    }

    $result = $connection->query("SELECT * FROM products");

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["description"]. " " . $row["price"]. " " . $row["updated_at"]. " " . $row["created_at"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    $connection->close();
}
