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

// Query to fetch products
$sql = "SELECT id, name, price, image FROM products_registry"; // Ensure this matches your table
$sql2 = "SELECT profile_img FROM user WHERE id = $user_id";

$result = $conn->query($sql);
$result2 = $conn->query($sql2);

$products = [];
$profile_img = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $profile_img[] = $row;
    }
}

$conn->close();
?>
