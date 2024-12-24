<?php
include '../config/sessionInfo.php';
include '../config/openConn.php'; 

if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

    $payment_method = $_POST['payment'];
    // Retrieve items from the cart
    $query = "SELECT * FROM cart WHERE user_id = ? AND status = 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cartItems = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while (mysqli_fetch_assoc($result)) {
            $cartItems = $result;
        }
    } else {
        echo "No product info was found.";
    }
    mysqli_stmt_close($stmt);

    // Insert items into the orderstatus table
    
    foreach ($cartItems as $item) {
        $orderStmt = mysqli_prepare($conn, "INSERT INTO order_status (customer_id, product_id, product_name, status, quantity, price, payment_method) VALUES (?, ?, ?, 0, ?, ?, ?)");
        if (!$orderStmt) {
            echo "Order preparation failed: " . mysqli_error($conn);
        } else {
            echo "Order prepared successfully.<br>";
        }
        mysqli_stmt_bind_param(
            $orderStmt,
            'iisiis',
            $user_id,
            $item['product_id'],
            $item['product_name'],
            $item['quantity'],
            $item['price'],
            $payment_method
        );
        mysqli_stmt_execute($orderStmt);
        mysqli_stmt_close($orderStmt);
    }
    

    // Delete items from the cart
    $deleteQuery = "DELETE FROM cart WHERE user_id = ? AND status = 1";
    $deleteStmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($deleteStmt, 'i', $user_id);
    mysqli_stmt_execute($deleteStmt);
    mysqli_stmt_close($deleteStmt);


    echo "Checkout successful. Your order has been placed!";
    header('Location: ../views/thank-you.php');
    exit();
}
include '../config/closeConn.php';
?>