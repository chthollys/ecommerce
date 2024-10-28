<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
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
   <form action="loginProcess.php" method="post">
      <h3>Login Now</h3>
      <input type="email" name="email" required placeholder="Enter email" class="box">
      <input type="password" name="password" required placeholder="Enter password" class="box">
      <input type="submit" name="submit" class="btn" value="Login Now">
      <p>Don't have an account? <a href="register-page.php">Register Now</a></p>
   </form>
</div>

</body>
</html>
