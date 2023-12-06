<?php 

@include 'config.php';

$id = $_GET['edit'];

 if(isset($_POST['update_product'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_stock = $_POST['product_stock'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;

    if(empty($product_name) || empty($product_price) || empty($product_stock) || empty($product_image)){
        $message[] = 'Please fill out all';
    }else{
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=?, image=? WHERE id = ?");
        $stmt->bind_param("ssisi", $product_name, $product_price, $product_stock, $product_image, $id);
        if($stmt->execute()){
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            header("location:admin_page.php");
        }else{
            $message[] = 'could not add the product';
        }
    }
 };

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
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

<div class="container">

    <div class="admin-product-form-container centered">
 
    <?php 
    
    $select = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    if ($select && mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
    } else {
        // Handle the case when the query doesn't return any results
        $message[] = 'No product found with the provided ID.';
        $row = []; // Initializing an empty array to avoid further errors
    
    ?>

    <?php }; ?>
 
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
             <h3>Update Products</h3>
            <input type="text" placeholder="enter product name" value="<?php echo htmlspecialchars($row['name']); ?>" name="product_name" class="box">
            <input type="number" placeholder="enter product price" value="<?php echo htmlspecialchars($row['price']); ?>" name="product_price" class="box">
            <input type="number" placeholder="enter stock" value="<?php echo htmlspecialchars($row['stock']); ?>" name="product_stock" class="box">
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="submit" class="btn" name="update_product" value="Update Product">
            <a href="admin_page.php" class="btn">Go back</a>
        </form>
    </div>

</div>
    
</body>
</html>