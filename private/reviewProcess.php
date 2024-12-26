<?php
session_start();

// Ensure user is logged in
include '../config/sessionInfo.php';

// Establish database connection
include '../config/openConn.php';

// Retrieve the info required from the POST request
$order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : -1;
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : -1;
$variation_id = isset($_POST['variation_id']) ? (int)$_POST['variation_id'] : -1;
$review_text = isset($_POST['review']) ? stripslashes(mysqli_real_escape_string($conn, $_POST['review'])) : '';

$rating = isset($_POST['rating']) ? $_POST['rating'] : -1;
// Prepare statement to update the product review by validate whether its pre-exist

$validateQuery = "SELECT * from reviews WHERE order_id = ?";
$validateStmt = mysqli_prepare($conn, $validateQuery);
mysqli_stmt_bind_param($validateStmt, 'i', $order_id);
mysqli_stmt_execute($validateStmt);
$result = mysqli_stmt_get_result($validateStmt);
$existReview = mysqli_fetch_assoc($result);

if(!$existReview) { 
    // add review
    $query = "INSERT INTO reviews (order_id, product_id, variation_id, reviewer_id, text, rating) VALUE (?, ?, ?, ?, ?, ?)";
    $bindparam = 'iiiisd';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, $bindparam, $order_id, $product_id, $variation_id, $user_id, $review_text, $rating);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ../views/orderdetails-page.php?order_id=$order_id");
    } else {
        echo "Error in review input: " . mysqli_error($conn);
    }
} else { 
    // update review
    $query = "UPDATE reviews SET text = ?, rating = ?, variation_id = ?
              WHERE order_id = ?";
    $bindparam = 'sdii';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, $bindparam, $review_text, $rating, $variation_id, $order_id);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ../views/orderdetails-page.php?order_id=$order_id");
    } else {
        echo "Error in review update: " . mysqli_error($conn);
    }
}

include '../config/closeConn.php';
exit();
?>