<?php
session_start(); // Start the session here
include 'registerProcess.php'; // Include the registration logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../public/styles/login-register.css">
</head>
<body>

<?php
if (isset($_SESSION['message'])) {
    echo '<div class="message" onclick="this.remove();">' . htmlspecialchars($_SESSION['message']) . '</div>';
    unset($_SESSION['message']); // Clear message after displaying
}
?>

<div class="form-container">
    <form action="" method="post">
        <h3>Register Now</h3>
        <input type="text" name="name" required placeholder="Enter Username" class="box">
        <input type="email" name="email" required placeholder="Enter Email" class="box">
        <input type="password" name="password" required placeholder="Enter Password" class="box">
        <input type="password" name="cpassword" required placeholder="Confirm Password" class="box">
        <input type="submit" name="submit" class="btn" value="Register Now">
        <p>Already have an account? <a href="../views/login-page.php">Login Now</a></p>
    </form>
</div>

</body>
</html>
