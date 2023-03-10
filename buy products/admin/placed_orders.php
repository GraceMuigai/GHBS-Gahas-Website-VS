<?php

include '../components/connect.php';

session_start(); 

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_status->execute([$payment_status, $order_id]);
    $message[] = 'payment status updated!';
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>placed orders</title>

    
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

<!-- placed orders section starts -->

<section class="placed-orders">
    <h1 class="heading">placed orders</h1>

    <div class="box-container">
        
        <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if($select_orders->rowCount() > 0){
                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){

        ?>

        <div class="box">
            <p>user id: <span><?= $fetch_orders['user_id']; ?></span></p>
            <p>placed on: <span><?= $fetch_orders['placed_on']; ?></span></p>
            <p>name: <span><?= $fetch_orders['name']; ?></span></p>
            <p>email: <span><?= $fetch_orders['email']; ?></span></p>
            <p>number: <span><?= $fetch_orders['number']; ?></span></p>
            <p>address: <span><?= $fetch_orders['address']; ?></span></p>
            <p>total products: <span><?= $fetch_orders['total_products']; ?></span></p>
            <p>total price: <span>Ksh<?= $fetch_orders['total_price']; ?>/=</span></p>
            <p>paying method: <span><?= $fetch_orders['method']; ?></span></p>

            <form action="" method="POST">
                <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                <select name="payment_status" class="drop-down">
                    <option value="" selected disabled><?= $fetch_orders['payment_status'] ?></option>
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                </select>
                <div class="flex-btn">
                    <input type="submit" value="update" class="btn" name="update_payment">
                    <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick= "return confirm('delete this order?');">delete</a>
                </div>
            </form>

        </div>

        <?php
            }
        }else{
            echo '<p class="empty">no orders placed yet!</p>';
        }
        ?>
    </div>

</section>

<!-- placed orders section ends -->










<!-- custom js file -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>