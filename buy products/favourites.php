<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:user_login.php');
}

include 'components/favourites_cart.php';

if(isset($_POST['delete'])){
    $favourites_id = $_POST['favourites_id'];
    $delete_favourites = $conn->prepare("DELETE FROM `favourites` WHERE id = ?");
    $delete_favourites->execute([$favourites_id]);
    $message[] = 'Removed from favourites!';
}

if(isset($_GET['delete_id'])){
    $delete_all = $_GET['delete_all'];
    $delete_all_favourites = $conn->prepare("DELETE FROM `favourites` WHERE user_id = ?");
    $delete_all_favourites->execute([$user_id]);
    header('location:favourites.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>favourites</title>

    
    <!--swipper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!--font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!--font google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andika:ital@0;1&family=Lato:ital@0;1&family=Roboto:ital,wght@0,400;1,500&display=swap" rel="stylesheet">

    <!-- custom css file -->
    <link rel="stylesheet" href="../buy products/css/product_style.css">
    


</head>
<body>
<?php include 'components/user_header.php'?>

<!-- favourites section starts -->

<section class="products">

    <h1 class="heading">your favourites</h1>

    <div class="box-container">

        <?php
            $grand_total = 0;
            $select_favourites = $conn->prepare("SELECT * FROM `favourites` WHERE user_id = ?");
            $select_favourites->execute([$user_id]);
            if($select_favourites->rowCount() > 0){
                while($fetch_favourites = $select_favourites->fetch(PDO::FETCH_ASSOC)){
                    $grand_total += $fetch_favourites['price'];
        ?>

        <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_favourites['pid']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_favourites['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_favourites['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_favourites['image']; ?>">
            <input type="hidden" name="favourites_id" value="<?= $fetch_favourites['id']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_favourites['pid']; ?>" class="fas fa-eye"></a>
            <img src="hair_products_img/<?= $fetch_favourites['image']; ?>" class="image" alt="">
            <div class="name"><?= $fetch_favourites['name']; ?></div>
            <div class="flex">
                <div class="price">Ksh<span><?= $fetch_favourites['price']; ?></span>/=</div>
                <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
            </div>
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                <input type="submit" value="remove item" onclick="return confirm('Remove this product from favourites?');" name="delete" class="delete-btn">
        </form>

        <?php
                }
            }else{
                echo '<p class="empty">your favourites is empty</p>';
            }
        ?>
    </div>
    <div class="grand-total">

            <p>grand total:  <span>Ksh<?= $grand_total ?>/=</span></p>
            <a href="shop.php" class="option-btn">Continue Shopping</a>
            <a href="favourites.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Remove all products from favourites?');">Remove All</a>

    </div>
</section>

<!-- favourites section ends -->


























<?php include 'components/footer.php';?>


<!-- swiper js link -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file -->
<script src="../buy products/js/product_script.js"></script>

</body>
</html>