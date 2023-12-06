<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
      $row = mysqli_fetch_array($select);
      if ($row['user_type'] === 'user') {
          $_SESSION['user_id'] = $row['id'];
          header('location: product.php');
      } else {
          $message[] = "This login form is only for Users not Admins.";
      }
  } else {
      $message[] = 'Incorrect password or email!';
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form User</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylelogin.css">
   <link rel="stylesheet" href="css/stylecart.css">
   <link rel="stylesheet" href="css/styleadmindisplay.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login user</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<span class="error-msg">'.$message.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">

      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form_user.php">register now</a></p>
   </form>

</div>

</body>
</html>