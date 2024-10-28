<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];

   $stmt = $conn->prepare("SELECT * FROM `user_form` WHERE email = ?");
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $result = $stmt->get_result();

   if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      if(password_verify($pass, $row['password'])){
         $_SESSION['user_id'] = $row['id'];
         header('Location: index.php');
         exit;
      } else {
         $_SESSION['message'] = 'Incorrect password or email!';
         header('Location: login-page.php');
         exit;
      }
   } else {
      $_SESSION['message'] = 'Incorrect password or email!';
      header('Location: login-page.php');
      exit;
   }
}
?>
