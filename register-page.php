<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php
session_start();
if(isset($_SESSION['message'])){
   echo '<div class="message" onclick="this.remove();">'.$_SESSION['message'].'</div>';
   unset($_SESSION['message']);
}
?>

<div class="form-container">
   <form action="registerProcess.php" method="post">
      <h3>Register Now</h3>
      <input type="text" name="name" required placeholder="Enter username" class="box">
      <input type="email" name="email" required placeholder="Enter email" class="box">
      <input type="password" name="password" required placeholder="Enter password" class="box">
      <input type="password" name="cpassword" required placeholder="Confirm password" class="box">
      <input type="submit" name="submit" class="btn" value="Register Now">
      <p>Already have an account? <a href="login-page.php">Login now</a></p>
   </form>
</div>

</body>
</html>
