<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}  

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = ($_POST['password']);
   $cpass = ($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:register_form.php');
      }
   }

};
?>

<?php  

$fetch_admins_query = "SELECT * FROM user_form WHERE user_type='admin'";
$admins_result = mysqli_query($conn, $fetch_admins_query);

if (!$admins_result) {
    die('Query failed: ' . mysqli_error($conn));
}

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM user_form WHERE id = $id");
   header('location:register_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylelogin.css">
   <link rel="stylesheet" href="css/stylecart.css">
   <link rel="stylesheet" href="css/styleadmindisplay.css">

</head>
<body>
<!-- <?php @include 'header.php';?> -->
   
<div class="form-container">

   <form action="" method="post">
      <h3>register new admin</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="admin">admin</option>
         <!-- <option value="user">user</option> -->
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <!-- <p>already have an account? <a href="login_form.php">login now</a></p> -->
   </form>


   <div class="admin-display">
            <table class="admin-display-table">
                <thead>
                    <tr>
                        <td>Admin name</td>
                        <td>email</td>
                        <td>password</td>
                        <td>action</td>
                    </tr>
                </thead>

                <?php while ($row = mysqli_fetch_assoc($admins_result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td>
                            <a href="register_form.php?delete=<?php echo $row['id']; ?>" class="btn"><i class="fas fa-trash">delete</i></a>
                    </td>
                </tr>
                <?php } ?>


            </table>
        </div>


</div>

</body>
</html>