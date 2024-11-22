<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login-page.php");
    exit();
}

// Retrieve the product ID from the POST request
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Prepare statement to delete the product by ID
$stmt = mysqli_prepare($conn, "DELETE FROM products_registry WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $product_id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: deleteProduct.php?message=Product removed successfully");
} else {
    echo "Error deleting product: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();
