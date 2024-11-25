<?php
session_start();

include '../config/sessionInfo.php';

include '../config/openConn.php';

$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

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
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    $total_price = $product_price * $quantity;

    // Insert product into the cart or update quantity if already present
    $stmt = mysqli_prepare($conn, "INSERT INTO cart (user_id, product_id, product_name, quantity, price, total_price, image) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
    mysqli_stmt_bind_param($stmt, 'iisiddsi', $user_id, $product_id, $product_name, $quantity, $product_price, $total_price, $product_image, $quantity);
    mysqli_stmt_execute($stmt);

    // Redirect back to the product details page with a success message
    header("Location: ../public/product-details.php?added=true&id=$product_id");
    exit();
} else {
    echo "Product not found.";
}

mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>
