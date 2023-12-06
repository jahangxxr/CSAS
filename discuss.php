<?php

@include 'config.php';


$conn = mysqli_connect("localhost", "root", "", "cart_db");

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $date = date('F d Y, h:i:s A');
  $reply_id = $_POST["reply_id"];

  $query = "INSERT INTO chat VALUES('', '$name', '$comment', '$date', '$reply_id')";
  mysqli_query($conn, $query);
}
// if (isset($_POST['edit_comment'])) {
//     $comment_id = $_POST['comment_id'];
// }
// if (isset($_POST['delete_comment'])) {
//     $comment_id = $_POST['comment_id'];

//         mysqli_query($conn, "DELETE FROM chat WHERE id = $comment_id");
//         header('location:discuss.php');
//      }

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Discussion</title>
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
   </head>
   <style>
    
    *{
      margin: 0px;
      padding: 0px;
    }
    body{

      background: black;
      font-family: sans-serif;
      color: white;
    }
    #title{
        font-size: 2rem;
        font-family: sans-serif;
        color: white;
    }
    .leave{
        margin-top: 150px;
        justify-content: center;
    }
    .reply-name{
        color: white;
    }
    .reply-date{
        font-size: 10px;
        color: grey;
    }
    .reply-comment{
        font-size: 15px ;
    }
    .comment-name{
        font-size: 20px;
        color: white;
    }
    .comment-comment{
        font-size: 25px;
    }
    .comment-date{
        color: grey;
    }
    .container{
      background: white;
      width: 700px;
      margin: 0 auto;
      padding-top: 1px;
      padding-bottom: 5px;
    }
    .comment, .reply{
      margin-top: 5px;
      padding: 10px;
      border-bottom: 1px solid black;
    }
    .reply{
      border: 2px solid #cccc;
      border-radius: 30px;
    }

    p{
      margin-top: 5px;
      margin-bottom: 5px;
    }

    form{
      margin: 10px;
    }
    form h3{
      margin-bottom: 5px;
    }
    form input, form textarea{
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }
    form button.submit, button{
      background: #48ca95;
      color: white;
      border: none;
      cursor: pointer;
      padding: 10px 20px;
      width: 100%;
      border-radius: 35px;
    }
    button.reply{
      background: #4843a3;
      width: 100px;
      border-radius: 25px;
    }
    .edit_comment button{
      width: 50px;
    }

  </style>
   <!-- body -->
   <body class="main-layout inner_posituong computer_page">
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
                              <li class="nav-item active">
                                 <a class="nav-link" href="discuss.php">Discussions</a>
                              </li>
                              <li class="nav-item">
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

      <!-- start body -->

<div class="container-fluid">
    <div class="row">

<div class="col-4 leave">
<form action = "" method = "post">
        <h3 id = "title">Dicuss your Query</h3>
        <input type="hidden" name="reply_id" id="reply_id">
        <input type="text" name="name" placeholder="Your name" required>
        <textarea name="comment" placeholder="Your comment" required></textarea>
        <button class = "submit" type="submit" name="submit">Submit</button>
      </form>
</div>


<div class="col-8 chat">
      <?php
      $datas = mysqli_query($conn, "SELECT * FROM chat WHERE reply_id = 0"); // only select comment and not select reply
      foreach($datas as $data) {
        require 'comment.php';
      }
      
      ?>
    </div>     
    </div>
</div>



      <!-- end body -->
      <script>
      function reply(id, name){
        title = document.getElementById('title');
        title.innerHTML = "Reply to " + name;
        document.getElementById('reply_id').value = id;
      }
    </script>

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

   </body>
</html>

