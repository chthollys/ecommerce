<?php

include '../config/sessionInfo.php'; // for $user_id info

// Create connection
include '../config/openConn.php';

$stmt = mysqli_prepare($conn, "SELECT a.*, b.variation_name AS variation_name
                               FROM order_status AS a
                               JOIN product_variations AS b
                               ON a.variation_id = b.variation_id
                               WHERE customer_id = ?
                               ORDER BY a.date DESC");
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize an empty array for storing products
$ordered_products = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ordered_products[] = $row;
    }
}


// Close the statement and connection
mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>