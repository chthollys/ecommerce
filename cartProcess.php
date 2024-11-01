<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login-page.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch the product price and image
$stmt = mysqli_prepare($conn, "SELECT name, price, image FROM products_registry WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);



if ($product) {
    $product_price = $product['price'];
    $product_image = $product['image'];
    $product_name = $product['name'];

    // Insert product into the cart or update quantity if already present
    $stmt = mysqli_prepare($conn, "INSERT INTO cart (user_id, product_id, product_name, quantity, price, image) VALUES (?, ?, ?, 1, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    mysqli_stmt_bind_param($stmt, 'iisds', $user_id, $product_id, $product_name, $product_price, $product_image);
    mysqli_stmt_execute($stmt);

    // Redirect back to the product details page with a success message
    header("Location: product-details.php?added=true&id=$product_id");
    exit();
} else {
    echo "Product not found.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
