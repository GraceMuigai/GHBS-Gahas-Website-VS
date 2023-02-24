<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    
}else{
    $user_id = '';
    header('location:user_login.php');
}

if(isset($_POST['order'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['address'].', '.$_POST['street'].', '.$_POST['city'].' - '.$_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_products = filter_var($total_products, FILTER_SANITIZE_STRING);
    $total_price = $_POST['total_price'];
    $total_price = filter_var($total_price, FILTER_SANITIZE_STRING);

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if($check_cart->rowCount() > 0){
        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
        
        $message[] = 'Successfully placed order!';

        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);

    }else{
        $message[] = 'your cart is empty!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    
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

<!-- checkout section starts -->

<section class="checkout">

    <h1 class="heading">Your Orders</h1>

    <div class="display-orders">

        <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                    $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                    $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['quantity'].') - ';
                    $total_products = implode($cart_items);
        ?>
        <p> <?= $fetch_cart['name']; ?> <span>Ksh<?= $fetch_cart['price']; ?>/= x <?= $fetch_cart['quantity']; ?></span> </p>

        <?php
                }
            }else{
                echo '<p class="empty">your cart is empty</p>';
            }
        ?>

        
        <p class="grand-total">grand total:  <span>Ksh<?= $grand_total ?>/=</span></p>

        <form action="" method="post">

        <h1 class="heading">Place Your Order</h1>

        <input type="hidden" name="total_products" value="<?= $total_products; ?>">
        <input type="hidden" name="total_price" value="<?= $grand_total; ?>">

            <div class="flex">
                <div class="inputBox">
                    <span>Your Name: </span>
                    <input type="text" name="name" maxlength="50" placeholder="enter your name" required class="box">
                </div>
                <div class="inputBox">
                    <span>Phone Number: </span>
                    <input type="number" name="number" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" placeholder="enter your phone number" required class="box">
                </div>
                <div class="inputBox">
                    <span>Your Email: </span>
                    <input type="email" name="email" maxlength="50" placeholder="enter your email" required class="box">
                </div>
                <div class="inputBox">
                    <span>payment method: </span>
                    <select name="method" class="box">
                        <option value="cash on delivery">cash on delivery</option>
                        <option value="mpesa">mpesa</option>
                        <option value="paypal">paypal</option>
                        <option value="credit card">credit card</option>

                    </select>
                </div>
                <div class="inputBox">
                    <span>address: </span>
                    <input type="text" name="address" maxlength="50" placeholder="your delivery address" required class="box">
                </div>
                <div class="inputBox">
                    <span>address line: </span>
                    <input type="text" name="street" maxlength="50" placeholder="your delivery street name" required class="box">
                </div>
                <div class="inputBox">
                    <span>city: </span>
                    <input type="text" name="city" maxlength="50" placeholder="eg. Nairobi" required class="box">
                </div>
                <div class="inputBox">
                    <span>pin code: </span>
                    <input type="number" name="pin_code" min="50" max="999999" onkeypress="if(this.value.length == 6) return false;" placeholder="eg. 123456" required class="box">
                </div>
            </div>
            <input type="submit" name="order" value="place order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">
        </form>
    </div>
</section>



<!-- checkout section ends -->


























<?php include 'components/footer.php';?>


<!-- swiper js link -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file -->
<script src="../buy products/js/product_script.js"></script>

</body>
</html>