<?php
session_start();

$user_id = $_SESSION['user_id'];

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve updated user information
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_number = mysqli_real_escape_string($conn, $_POST['number']);

    // Process image upload if a file is selected
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file = $_FILES['image'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_extensions)) {
            $new_file_name = uniqid('', true) . '.' . $file_ext;
            $target_dir = 'styles-images/img/' . $new_file_name;

            if (move_uploaded_file($file_tmp, $target_dir)) {
                $image_path = $target_dir;
            } else {
                $_SESSION['messageA'] = 'Error uploading image.';
                header('Location: profile-dashboard.php?error=1');
                exit();
            }
        } else {
            $_SESSION['messageA'] = 'Invalid file type. Only JPG, JPEG, and PNG are allowed.';
            header('Location: profile-dashboard.php?error=1');
            exit();
        }
    }

    // Prepare the UPDATE statement
    if ($image_path) {
        $update_stmt = mysqli_prepare($conn, "UPDATE user SET name = ?, email = ?, no_telp = ?, address = ?, profile_img = ? WHERE id = ?");
        mysqli_stmt_bind_param($update_stmt, 'sssssi', $user_name, $user_email, $user_number, $user_address, $image_path, $user_id);
    } else {
        // If no image is uploaded, only update other details
        $update_stmt = mysqli_prepare($conn, "UPDATE user SET name = ?, email = ?, no_telp = ?, address = ? WHERE id = ?");
        mysqli_stmt_bind_param($update_stmt, 'ssssi', $user_name, $user_email, $user_number, $user_address, $user_id);
    }

    if (mysqli_stmt_execute($update_stmt)) {
        $_SESSION['messageA'] = 'Profile updated successfully!';
        header('Location: profile-dashboard.php?success=1'); // Redirect to profile page with success flag
        exit();
    } else {
        $_SESSION['messageA'] = 'Update failed. Please try again.';
        header('Location: profile-dashboard.php?error=1');
        exit();
    }

    mysqli_stmt_close($update_stmt);
}

mysqli_close($conn);
?>
