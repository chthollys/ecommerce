<?php
session_start();

// Ensure user is logged in
include '../config/sessionInfo.php';

// Establish database connection
include '../config/openConn.php';

// Retrieve the order ID and status value from the POST request
$status_update = $_POST['status'];
$order_id = $_POST['order_id'];

// Prepare statement to delete the product by ID
$stmt = mysqli_prepare($conn, "UPDATE order_status SET status = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'ii', $status_update, $order_id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../views/manageOrder-page.php");
} else {
    echo "Error updating product status: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
include '../config/closeConn.php';
exit();
