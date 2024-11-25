<?php

include '../config/openConn.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];

    if ($password !== $confirm_password) {
        $_SESSION['message'] = 'Passwords do not match!';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "SELECT id FROM `user` WHERE email = ?");
        if (!$stmt) {
            die("Query preparation failed: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $_SESSION['message'] = 'User already has an account, please login.';
        } else {
            $insert_stmt = mysqli_prepare($conn, "INSERT INTO `user` (name, email, password) VALUES (?, ?, ?)");
            if (!$insert_stmt) {
                die("Insert statement preparation failed: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($insert_stmt, 'sss', $name, $email, $hashed_password);

            if (mysqli_stmt_execute($insert_stmt)) {
                $_SESSION['message'] = 'Registered successfully!';
                header('Location: ../public/login-page.php');
                exit();
            } else {
                $_SESSION['message'] = 'Registration failed. Please try again.';
            }

            mysqli_stmt_close($insert_stmt);
        }

        mysqli_stmt_close($stmt);
    }
}

include '../config/openConn.php';
?>
