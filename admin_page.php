<?php

@include 'config.php';

session_start();

if(isset($_SESSION) && isset($_GET['logout'])){
    session_unset();
    session_destroy(); 
    header('location:index.php');
    exit();
}


?>

<?php 
 @include 'config.php';

 if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_stock = $_POST['product_stock'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;

    if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_stock)){
        $message[] = 'Please fill out all';
    }else{
        $insert = "INSERT INTO products(name, price, stock, image) VALUES('$product_name', '$product_price', '$product_stock', '$product_image')";
        $upload = mysqli_query($conn,$insert);
        if($upload){
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'New Product added';
        }else{
            $message[] = 'could not add the product';
        }
    }
 };

 if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:admin_page.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>

<?php
if(isset($message)){
    foreach ($message as $message) {
        echo "<span class='message'>.$message.</span>";
    }
}
?>
               <a href="register_form.php?register" class="btn" style="background-color:#4f4aa6; width:18%; border-radius:25px; margin-left:50px;"><i class="fas fa-register">Manage Admins</i></a>

<div class="container-fluid">
    <div class="row">
        <div class="col-6">
        <div class="container">
        <div class="admin-product-form-container">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
             <h3>Add New Product</h3>
            <input type="text" placeholder="enter product name" name="product_name" class="box">
            <input type="number" placeholder="enter product price" name="product_price" class="box">
            <input type="number" placeholder="enter stock" name="product_stock" class="box">
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="submit" class="btn" name="add_product" value="Add Product">
            <a href="logout.php?logout" class="btn"><i class="fas fa-logout">Logout</i></a>
            </form>
        </div>
        
        <?php 
        
        $select = mysqli_query($conn, "SELECT * FROM products");
        
        ?>
        <div class="product-display">
            <table class="product-display-table">
                <thead>
                    <tr>
                        <td>product image</td>
                        <td>product name</td>
                        <td>product price</td>
                        <td>stock</td>
                        <td>action</td>
                    </tr>
                </thead>

                <?php 
                while($row = mysqli_fetch_assoc($select)){
                ?>

                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>Rs. <?php echo $row['price']; ?></td>
                        <td> <?php echo $row['stock']; ?></td>
                        <td>
                            <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"><i class="fas fa-edit">edit</i></a>
                            <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"><i class="fas fa-trash">delete</i></a>
                        </td>
                    </tr>


                <?php }; ?>

            </table>
        </div>

    </div>
        </div>
    </div>
</div>


    
</body>
</html>