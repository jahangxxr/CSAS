<header class="header">
   

   <div class="flex">
                           <div class="logo">
                              <a href="index.php"><img src="images/logo2.png" alt="#" /></a>
                           </div>

      <nav class="navbar">
      <a class="nav-link" href="index.php">Home</a>
      <a class="nav-link" href="about.php">About</a>
      <a class="nav-link" href="discuss.php">Discussions</a>
      <a href="product.php">Products</a>
      <a class="nav-link" href="contact.php">Contact Us</a>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>
      <a class="nav-link" href="login_form.php">Admin?</a>
      <div id="menu-btn" class="fas fa-bars"></div>

      </nav> 
   </div>

</header>