<?php
include '../config/sessionInfo.php';
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

include '../config/openConn.php';
// Fetch the product details from the database
$stmt = mysqli_prepare($conn, "SELECT a.*, b.name AS seller_name, b.profile_img AS seller_img
                               FROM products_registry AS a
                               JOIN user AS b
                               ON a.id_admin = b.id
                               WHERE a.id = ?");
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);
if (!$product) {
    echo "Product not found.";
    exit();
}

$query2 ="SELECT a.*, b.profile_img AS profile_img ,
          b.name AS reviewer_name, c.variation_name AS variation_name
          FROM reviews AS a 
          JOIN user AS b 
          ON a.reviewer_id = b.id
          JOIN product_variations AS c
          ON a.variation_id = c.variation_id
          WHERE a.product_id = ?
          ORDER BY a.review_date DESC";
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

$query3 ="SELECT COUNT(*) AS review_count, 
          AVG(rating) AS average_rating,
          b.sold_qty AS sold_count
          from reviews AS a 
          JOIN products_registry AS b
          ON a.product_id = b.id
          WHERE product_id = ?";
$stmt3 = mysqli_prepare($conn, $query3);

mysqli_stmt_bind_param($stmt3, 'i', $product_id);
mysqli_stmt_execute($stmt3);
$review_stat = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt3));
 
if($review_stat['average_rating'] == NULL) {
    $review_stat['average_rating'] = 0;
}

$query4 ="SELECT variation_id, variation_name, stocks AS variation_stock
          from product_variations
          WHERE product_id = ?";
$stmt4 = mysqli_prepare($conn, $query4);

mysqli_stmt_bind_param($stmt4, 'i', $product_id);
mysqli_stmt_execute($stmt4);
$variation_raw = mysqli_stmt_get_result($stmt4);
$variation_list = [];

if($variation_raw) {
    while($row = mysqli_fetch_assoc($variation_raw)) {
        $variation_list[] = $row;
    }
}

mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt2);
mysqli_stmt_close($stmt3);
mysqli_stmt_close($stmt4);
include '../config/closeConn.php';
?>