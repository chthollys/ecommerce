<?php
// Database connection details
include '../config/sessionInfo.php';

include '../config/openConn.php';

// Query to fetch products
$stmt = mysqli_prepare($conn, "SELECT id, name, price, image FROM products_registry" ); // Ensure this matches your table
if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($conn));
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$products = [];
if ($result && mysqli_num_rows($result) > 0) {
    while (mysqli_fetch_assoc($result)) {
        $products = $result;
    }
} else {
    echo "No product info was found.";
}
mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>
