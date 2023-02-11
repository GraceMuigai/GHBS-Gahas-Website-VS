<?php

include '../components/connect.php';

session_start(); 

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    
    <!--swipper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!--font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!--font google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andika:ital@0;1&family=Lato:ital@0;1&family=Roboto:ital,wght@0,400;1,500&display=swap" rel="stylesheet">

    <!-- custom css file -->
    <link rel="stylesheet" href="../css/admin_style.css">
    


</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts -->

<section class="add-products">

    <h1 class="heading">add product</h1>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="flex">
            <div class="inputBox">
                <span>product name (required)</span>
                <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
            </div>
            <div class="inputBox">
                <span>product price (required)</span>
                <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
            </div>
            <div class="inputBox">
                <span>image 01 (required)</span>
                <input type="file" name="image_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <div class="inputBox">
                <span>image 02 (required)</span>
                <input type="file" name="image_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <div class="inputBox">
                <span>image 03 (required)</span>
                <input type="file" name="image_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <div class="inputBox">
                <span>product details</span>
                <textarea name="details" class="box" placeholder="enter product details" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
            <input type="submit" value="add product" name="add_product" class="btn">
        </div>
    </form>

</section>

<!-- add products section ends -->









<!-- custom js file -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>