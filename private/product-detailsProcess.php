<?php
session_start();

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

include '../config/openConn.php';
// Fetch the product details from the database
$stmt = mysqli_prepare($conn, "SELECT name, price, image, stocks, description, category FROM products_registry WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found.";
    exit();
}

mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>