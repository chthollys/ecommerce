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
$sql = "SELECT product_name, price, image FROM cart"; // Ensure this matches your table
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}


$carted_products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carted_products[] = $row;
    }
}

$conn->close();
?>
