<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products
$sql = "SELECT id, name, price, image FROM products_registry"; // Ensure this matches your table
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}


$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>
