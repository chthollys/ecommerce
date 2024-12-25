<?php
session_start();
include "../config/sessionInfo.php";

// Database connection
include '../config/openConn.php';

if (isset($_POST['submit'])) {
    // Retrieve product information
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_description = mysqli_real_escape_string($conn, str_replace(["\r\n", "\r"], "<br>", $_POST['description']));
    
    $category_id = $_POST['category'];
    $extract_category = mysqli_prepare($conn, "SELECT name from categories WHERE id = ?");
    mysqli_stmt_bind_param($extract_category, "i", $category_id);
    mysqli_stmt_execute($extract_category);
    $category_result = mysqli_stmt_get_result($extract_category);
    $product_cat = mysqli_fetch_assoc($category_result);
    $product_category = $product_cat['name'];
    
    // Process image upload
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $file = $_FILES['image'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // Extract file extension
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_extensions)) {
        // Define the target directory and unique file name
        $new_file_name = uniqid('', true) . '.' . $file_ext;
        $target_dir = '../public/img/' . $new_file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_tmp, $target_dir)) {
            // Insert product into the database with the image path
            $insert_stmt = mysqli_prepare($conn, "INSERT INTO `products_registry` (name, id_admin, price, image, description, category) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$insert_stmt) {
                die("Insert statement preparation failed: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($insert_stmt, 'sidsss', $product_name, $user['id'], $product_price, $target_dir, $product_description, $product_category);

            if (mysqli_stmt_execute($insert_stmt)) {
                $_SESSION['messageA'] = 'Product Registered successfully!';
                header('Location: ../views/adminProduct.php?success=1'); // Redirect to adminProduct.php with success flag
                exit();
            } else {
                $_SESSION['messageA'] = 'Registration failed. Please try again.';
            }

            mysqli_stmt_close($insert_stmt);
        } else {
            $_SESSION['messageA'] = 'Error uploading image.';
        }
    } else {
        $_SESSION['messageA'] = 'Invalid file type. Only JPG, JPEG, and PNG are allowed.';
    }
}

include '../config/closeConn.php';
?>
