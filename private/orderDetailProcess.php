<?php
include '../config/sessionInfo.php';

$order_id = $_GET['order_id'];

include '../config/openConn.php';
// Fetch the order details from the database
$query = "SELECT a.*, b.description AS description, b.category AS category, c.text AS review_text, c.rating AS review_rating
          FROM order_status AS a 
          JOIN products_registry AS b 
          ON a.product_id = b.id 
          JOIN reviews AS c
          ON a.id = c.order_id
          WHERE a.customer_id = ? AND a.id = ?";   
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    // Check if the statement preparation failed
    die("Failed to prepare statement: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, 'ii', $user['id'], $order_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    echo "Order not found.";
    exit();
}

mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>