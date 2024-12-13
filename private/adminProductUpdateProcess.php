<?php
include "../config/sessionInfo.php";

// Database connection
include '../config/openConn.php';
var_dump($_POST);
var_dump($_FILES);

if (isset($_POST['submit'])) {
    $product_id = $_POST['id'];
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = $_POST['price'];
    $product_stocks = mysqli_real_escape_string($conn, $_POST['stocks']);
    $product_description = mysqli_real_escape_string($conn, str_replace(["\r\n", "\r"], "<br>", $_POST['description']));

    $category_id = $_POST['category'];

    $extract_category = mysqli_prepare($conn, "SELECT name from categories WHERE id = ?");
    mysqli_stmt_bind_param($extract_category, "i", $category_id);
    mysqli_stmt_execute($extract_category);
    $category_result = mysqli_stmt_get_result($extract_category);
    $product_cat = mysqli_fetch_assoc($category_result);
    $product_category = $product_cat['name'];

    // Handle image upload
    $file = $_FILES['image'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_error = $file['error'];
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

    if (!empty($file_name)) {
        // A new image is uploaded
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (in_array($file_ext, $allowed_extensions)) {
            $new_file_name = uniqid('', true) . '.' . $file_ext;
            $target_dir = '../public/img/' . $new_file_name;

            if (move_uploaded_file($file_tmp, $target_dir)) {
                $image_path = $target_dir; // Use the new image path
            } else {
                die("Error uploading the new image.");
            }
        } else {
            die("Invalid file type. Only JPG, JPEG, and PNG are allowed.");
        }
    } else {
        // No new image uploaded, keep the current image
        $image_path = $_POST['current_image'];
    }

    // Update the database
    $update_stmt = mysqli_prepare($conn, "UPDATE `products_registry` SET name = ?, price = ?, stocks = ?, description = ?, category = ?, image = ? WHERE id = ?");
    if (!$update_stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($update_stmt, 'sdisssi', $product_name, $product_price, $product_stocks, $product_description, $product_category, $image_path, $product_id);

    if (mysqli_stmt_execute($update_stmt)) {
        $_SESSION['messageA'] = 'Product updated successfully!';
        header('Location: ../views/editProduct.php');
        exit();
    } else {
        die("Update failed: " . mysqli_stmt_error($update_stmt));
    }
}

include '../config/closeConn.php';
?>
