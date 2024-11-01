<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Retrieve product information
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = $_POST['price'];
    $product_description = mysqli_real_escape_string($conn, $_POST['description']);
    $product_stocks = mysqli_real_escape_string($conn, $_POST['stocks']);

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
        $target_dir = 'styles-images/img/' . $new_file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_tmp, $target_dir)) {
            // Insert product into the database with the image path
            $insert_stmt = mysqli_prepare($conn, "INSERT INTO `products_registry` (name, price, image, stocks, description) VALUES (?, ?, ?, ?, ?)");
            if (!$insert_stmt) {
                die("Insert statement preparation failed: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($insert_stmt, 'sdsis', $product_name, $product_price, $target_dir, $product_stocks, $product_description);

            if (mysqli_stmt_execute($insert_stmt)) {
                $_SESSION['messageA'] = 'Product Registered successfully!';
                header('Location: adminProduct.php?success=1'); // Redirect to adminProduct.php with success flag
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

mysqli_close($conn);
?>
