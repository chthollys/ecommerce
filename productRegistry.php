<?php

// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($conn, "SELECT id, name, price, image FROM products_registry");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize an empty array for storing products
$registered_products = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $registered_products[] = $row;
    }
} else {
    echo "No products found in your registry.";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>