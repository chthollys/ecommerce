<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];

   if($pass !== $cpass){
      $_SESSION['message'] = 'Password and Confirm Password do not match!';
      header('Location: register-page.php');
      exit;
   } else {
      $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

      $stmt = $conn->prepare("SELECT * FROM `user_form` WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows > 0){
         $_SESSION['message'] = 'User already exists!';
         header('Location: register-page.php');
         exit;
      } else {
         $stmt = $conn->prepare("INSERT INTO `user_form` (name, email, password) VALUES (?, ?, ?)");
         $stmt->bind_param("sss", $name, $email, $hashed_pass);
         if($stmt->execute()){
            $_SESSION['message'] = 'Registered successfully!';
            header('Location: login-page.php');
            exit;
         } else {
            $_SESSION['message'] = 'Registration failed!';
            header('Location: register-page.php');
            exit;
         }
      }
      $stmt->close();
   }

} else {
   header('Location: register-page.php');
   exit;
}

