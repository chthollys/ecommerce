<?php
session_start(); // Start the session only once here

include '../private/loginProcess.php'; // Include the login logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="../styles-images/login-register.css">
</head>
<body>

<?php
// Display the session message and clear it after displaying
if (isset($_SESSION['message'])) {
    echo '<div class="message" onclick="this.remove();">' . htmlspecialchars($_SESSION['message']) . '</div>';
    unset($_SESSION['message']); // Clear message after displaying
}
?>

<div class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <input type="email" name="email" required placeholder="Enter Email" class="box">
      <input type="password" name="password" required placeholder="Enter Password" class="box">
      <input type="submit" name="submit" class="btn" value="Login Now">
      <p>Don't have an account? <a href="../public/register-page.php">Register Now</a></p>
   </form>
</div>

</body>
</html>
