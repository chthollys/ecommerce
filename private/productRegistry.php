<?php

// Create connection
include "../config/sessionInfo.php";
include '../config/openConn.php';

$admin_id = $user['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM products_registry WHERE id_admin = ?");
mysqli_stmt_bind_param($stmt, "i", $admin_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize an empty array for storing products
$registered_products = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $registered_products[] = $row;
    }
} else {
    echo "No products found in your registry.";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>