<?php
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id, password, is_admin, profile_img FROM `user` WHERE email = ?");
    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            if($row['is_admin'] == 1) {
                $_SESSION['is_admin'] = true;
            }
            header('Location: home-page.php');
            exit(); // Stop further script execution
        } else {
            $_SESSION['message'] = 'Incorrect password or email !';
        }
    } else {
        $_SESSION['message'] = 'Please make an account !';
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
