<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Custom CSS File -->
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<div class="message" onclick="this.remove();">' . htmlspecialchars($msg) . '</div>';
    }
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
        <p>Already have an account? <a href="./login.php">Login now</a></p>
    </form>
</div>

</body>
</html>
