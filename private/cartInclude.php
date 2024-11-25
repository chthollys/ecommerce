<?php

// Create connection
include '../config/openConn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['status'])) {
        $status = (int)$_POST['status'];
        echo "Status: " . $status;
    } else {
        echo "Status not set in form submission.";
    }

    // echo "<pre>";
    // print_r($_POST); // Check if 'status' and 'product_id' are submitted
    // echo "</pre>";
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];

    $stmt = mysqli_prepare($conn, "UPDATE cart SET status = ? WHERE user_id = ? AND product_id = ? ");
    mysqli_stmt_bind_param($stmt, 'iii', $status, $user_id, $product_id);
    if ($stmt->execute()) {
        echo "Status updated successfully.";
        header('Location: ../public/cart.php');
    } else {
        echo "Failed to update status: " . $stmt->error;
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);

} else {
    echo "Server method can't be detected";
}
include '../config/closeConn.php';
exit();
?>