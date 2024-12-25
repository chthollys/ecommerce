<?php
include '../config/sessionInfo.php';
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

include '../config/openConn.php';
// Fetch the product details from the database
$stmt = mysqli_prepare($conn, "SELECT name, price, image, stocks, description, category FROM products_registry WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);
if (!$product) {
    echo "Product not found.";
    exit();
}

$query2 ="SELECT a.*, b.profile_img AS profile_img , b.name AS reviewer_name
          FROM reviews AS a 
          JOIN user AS b 
          ON a.reviewer_id = b.id
          WHERE a.product_id = ?";
$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, 'i', $product_id);
mysqli_stmt_execute($stmt2);
$review_list = mysqli_stmt_get_result($stmt2);
$reviews = [];

if($review_list) {
    while($row = mysqli_fetch_assoc($review_list)) {
        $reviews[] = $row;
    }
}

mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt2);
include '../config/closeConn.php';
?>