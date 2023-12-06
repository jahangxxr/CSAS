<?php

@include 'config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
   header('location: login_form_user.php');
   exit();
}
// Fetch user details from the database to check the user_type
$user_id = $_SESSION['user_id'];
$user_query = mysqli_query($conn, "SELECT user_type FROM `user_form` WHERE id = $user_id");

if (mysqli_num_rows($user_query) > 0) {
    $user_data = mysqli_fetch_assoc($user_query);
    if ($user_data['user_type'] !== 'user') {
        header('location: login_form_user.php'); // Redirect if user_type is not 'user'
        exit();
    }
} else {
    header('location: login_form_user.php'); // Redirect if user_id doesn't exist in the database
    exit();
}

// $_SESSION['user_type'] = $user_type_from_database;
// var_dump($_SESSION['user_type']);
// var_dump($_SESSION['user_id']);

// if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
//    header('location: login_form_user.php');
//    exit(); // Stop further execution
// }

if(isset($_GET['logout'])){
   unset($user_id_from_database);
   session_destroy();
   header('location:index.php');
};
// if(!isset($_SESSION['user'])){
//    $message[] = 'This login form is only for Users!';
//    header('location: login_form_user.php');
// }

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_stock = $_POST['product_stock'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}


?>

<!DOCTYPE html>
<html lang="en">
   <head>

   <link rel="stylesheet" href="css/style2.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Products</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/stylechatbox.css">
      <script src="js/chatbotscript.js" defer></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

     <!-- custom css file link  -->
     <link rel="stylesheet" href="css/stylecart.css">
   </head>
   <!-- body -->
   <body class="main-layout inner_posituong">
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.php"><img src="images/logo2.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item">
                                 <a class="nav-link" href="index.php">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="about.php">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="discuss.php">Discussions</a>
                              </li>
                              <li class="nav-item active">
                                 <a class="nav-link" href="product.php">Products</a>
                              </li>
                              <li class="nav-item">
                              <!-- <?php
                                $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                                $row_count = mysqli_num_rows($select_rows);
                              ?> -->
                              <a href="cart.php" class="nav-link" >Cart</a>
                               <div id="menu-btn" class="fas fa-bars"></div>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contact Us</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="login_form_user.php">SignIn</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="logout.php">SignOut</a>
                              </li>
                              <li class="nav-item d_none">
                                 <a class="nav-link" href="login_form.php">Admin?</a>
                              </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->


      <!-- products -->
      <div  class="products">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Products</h2>

                     <?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

                     <div class="container">
                        <section class="products">


                        <div class="box-container">
                           <?php 
                           $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                                if(mysqli_num_rows($select_products) > 0){
                                   while($fetch_product = mysqli_fetch_assoc($select_products)){
                           ?>
                                <form action="" method="post">
                                   <div class="box">
                                       <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                                       <h3><?php echo $fetch_product['name']; ?></h3>
                                       <div class="price">Rs. <b><?php echo $fetch_product['price']; ?>/-</b></div>
                                       <div class="price">
                                        
                                          <?php 
                                          if($fetch_product['stock']  <= 10 && $fetch_product['stock']  >= 1){
                                            echo " Available:".'<b style="color:red;">' . $fetch_product['stock'] .'</b>';
                                            echo "<br>";
                                            echo "<p style='color:red'>Limited Stock!</p>";
                                          }elseif($fetch_product['stock'] == 0){
                                             echo '<b style="color:red;">'."out of Stock".'</b>';
                                             
                                          }else{
                                             echo " Available:".'<b>' . $fetch_product['stock'] .'</b>';
                                          }
                                          ?>
                                       </div>
                                       <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                       <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                       <input type="hidden" name="product_stock" value="<?php echo $fetch_product['stock']; ?>">
                                       <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                       <?php if($fetch_product['stock'] > 0) { ?>
                                          <input type="submit" class="btn enabled" value="add to cart" name="add_to_cart">
                                       <?php } else { ?>
                                          <input type="submit" class="btn disabled" value="add to cart" name="add_to_cart" disabled>
                                        <?php } ?>
                                   </div>
                                </form>

                           <?php
                               };
                              };
                           ?>
                        </div>

                        </section>
                     </div>

                     <div class="col-md-12">
                           <a class="read_more" href="#">See More</a>
                        </div>


                     <script src="js/script.js"></script>

                  </div>
               </div>
            </div>
           
            </div>
         </div>
      </div>
          
      <!-- end products -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <img class="logo1" src="images/logo2.png" alt="#"/>
                     <ul class="social_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <h3>About Us</h3>
                     <ul class="about_us">
                        <li>A computer selling and assistance system offering tailored solutions and expert guidance for technology.</li>
                     </ul>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <h3>Contact Us</h3>
                     <ul class="conta">
                        <li>+923361849907<br>muzaffarjahangeer@gmail.com<br>03331306924<br>alisiddu713@gmail.com</li>
                     </ul>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <form class="bottom_form">
                        <h3>Newsletter</h3>
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2023 All Rights Reserved. Design by MJ</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>


         <button class="chatbot-toggler">
      <span class="material-symbols-rounded">mode_comment</span>
      <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
      <header>
        <h2>Chatbot</h2>
        <span class="close-btn material-symbols-outlined">close</span>
      </header>
      <ul class="chatbox">
        <li class="chat incoming">
          <span class="material-symbols-outlined">smart_toy</span>
          <p>Hi there 👋<br>How can I help you today?</p>
        </li>
      </ul>
      <div class="chat-input">
        <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
        <span id="send-btn" class="material-symbols-rounded">send</span>
      </div>
    </div>

    
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>

