<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Raw password (not yet hashed)

    // Prepare statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT id, password FROM `user` WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header('Location: index.php');
            exit(); // Stop further script execution
        } else {
            $message[] = 'Incorrect password or email!';
        }
    } else {
        $message[] = 'Incorrect password or email!';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
