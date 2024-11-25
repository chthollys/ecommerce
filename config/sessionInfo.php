<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Gateaway information from loginProcess.php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: login-page.php");
    exit();
}

// Create connection
include '../config/openConn.php';

$statement = mysqli_prepare($conn, "SELECT * FROM user WHERE id = ?");
mysqli_stmt_bind_param($statement, 'i', $user_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

// Initialize an empty array for storing user's info
$user = [];
if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else if ($result && mysqli_num_rows($result) > 1) {
    echo "Multiple user with same corresponding id was found, please check to the related database.";
} else {
    echo "No user was found.";
}

// Close the statement and connection
mysqli_stmt_close($statement);
include '../config/closeConn.php';
?>