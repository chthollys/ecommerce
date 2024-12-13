<?php

// Create connection
include "../config/sessionInfo.php";
include '../config/openConn.php';

$stmt = mysqli_prepare($conn, "SELECT * FROM categories");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize an empty array for storing products
$registered_categories = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $registered_categories[] = $row;
    }
} else {
    echo "No category found in your registry.";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
include '../config/closeConn.php';
?>