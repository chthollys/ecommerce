<?php
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $message[] = 'Passwords do not match!';
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the user already exists
        $stmt = mysqli_prepare($conn, "SELECT id FROM `user` WHERE email = ?");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $message[] = 'User already has an account, please login.';
        } else {
            // Insert the new user
            $insert_stmt = mysqli_prepare($conn, "INSERT INTO `user` (name, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($insert_stmt, 'sss', $name, $email, $hashed_password);

            if (mysqli_stmt_execute($insert_stmt)) {
                $message[] = 'Registered successfully!';
                header('Location: login.php');
                exit(); // Ensure no further code is executed
            } else {
                $message[] = 'Registration failed. Please try again.';
            }
        }

        // Close statements
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($insert_stmt);
    }
}
mysqli_close($conn);
?>
