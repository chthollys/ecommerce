<?php

include '../config/sessionInfo.php'; // for $user_id info

// Create connection
include '../config/openConn.php';

$stmt = mysqli_prepare($conn, "SELECT a.* , b.name AS customer_name, c.variation_name
                               FROM order_status AS a
                               JOIN user AS b
                               ON a.customer_id = b.id
                               JOIN product_variations AS c
                               ON a.variation_id = c.variation_id
                               WHERE seller_id = ? 
                               ORDER BY date DESC");
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize an empty array for storing products
$status_products = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $status_products[] = $row;
    }
} else {
    echo "No products found in your order list.";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>

