<?php
session_start();

include '../config/sessionInfo.php';
include '../config/openConn.php';

// Get user inputs
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Fetch product details
$stmt = mysqli_prepare($conn, "SELECT * FROM products_registry WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if ($product) {
    $product_price = $product['price'];
    $product_name = $product['name'];
    $product_image = $product['image'];
    $seller_id = $product['id_admin'];
    $total_price = $product_price * $quantity;

    // Check if product already exists in the cart
    $stmt_check = mysqli_prepare($conn, "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
    mysqli_stmt_bind_param($stmt_check, 'ii', $user_id, $product_id);
    mysqli_stmt_execute($stmt_check);
    $check_result = mysqli_stmt_get_result($stmt_check);

    if ($row = mysqli_fetch_assoc($check_result)) {
        // Product exists, update quantity
        $new_quantity = $row['quantity'] + $quantity;
        $new_total_price = $new_quantity * $product_price; // Pre-compute the total price
        $stmt_update = mysqli_prepare($conn, "UPDATE cart SET quantity = ?, total_price = ? WHERE user_id = ? AND product_id = ?");
        mysqli_stmt_bind_param($stmt_update, 'diii', $new_quantity, $new_total_price, $user_id, $product_id);
        mysqli_stmt_execute($stmt_update);
    } else {
        // Product does not exist, insert new row
        $stmt_insert = mysqli_prepare($conn, "INSERT INTO cart (user_id, seller_id, product_id, product_name, quantity, price, total_price, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt_insert, 'iiisdids', $user_id, $seller_id, $product_id, $product_name, $quantity, $product_price, $total_price, $product_image);
        mysqli_stmt_execute($stmt_insert);
    }

    // Redirect to the product details page with a success message
    header("Location: ../views/product-details.php?added=true&id=$product_id");
    exit();
} else {
    echo "Product not found.";
}

mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>
