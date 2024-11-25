<?php
session_start();

include '../config/openConn.php';
include '../config/sessionInfo.php';

if(isset($_POST['submit'])) {
    // Retrieve the product ID from the POST request
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $qty_remove = (int)$_POST['qty_remove'];
    // Establish database connection

    // Prepare statement to delete the product by ID
    $stmt = mysqli_prepare($conn, "SELECT quantity, price FROM `cart` WHERE product_id = ? AND user_id = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $product_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $quantityInCart = $row['quantity'];
        $priceInCart = $row['price'];
    } else {
        echo "No products found in your cart.";
    }

    if ($qty_remove < $quantityInCart) {
        $stmt2 = mysqli_prepare($conn, "UPDATE `cart` SET quantity = quantity - ?, total_price = total_price - (? * ?) WHERE product_id = ? AND user_id = ? ");
        mysqli_stmt_bind_param($stmt2, 'iiiii', $qty_remove, $qty_remove, $priceInCart, $product_id, $user_id);
        mysqli_stmt_execute($stmt2);
        header('Location: ../public/cart.php');
    } else if ($qty_remove == $quantityInCart) {
        $stmt2 = mysqli_prepare($conn, "DELETE FROM `cart` WHERE product_id = ? AND user_id = ? ");
        mysqli_stmt_bind_param($stmt2, 'ii', $product_id, $user_id);
        mysqli_stmt_execute($stmt2);
        header('Location: ../public/cart.php');
    } else {
        echo "Error in quantitiy removal attempt.";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);

} else {
    echo "Form didnt get submit.";
    exit();
}

include '../config/closeConn.php';
?>