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

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
// $user_id = $_SESSION['user_id'] ?? 0;

// Fetching Profile Image
$profile_image = isset($_SESSION['profile_img']) ? $_SESSION['profile_img'] : 0;

// Query to fetch products
$sql = "SELECT id, name, price, image FROM products_registry"; // Ensure this matches your table

$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>
