<?php 
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
?>

<header class="header">

    <section class="flex">
        <a href="../home.php" class="logo"><span>G</span>ahas <span>B</span>raiding <span>C</span>reativity</a>

        <nav class="navbar">
            <a href="../home.php">home</a>
            <a href="../services.php">services</a>
            <a href="../products_home.php">products</a>
            <a href="../about.php">about</a>
            <a href="../book.php">book</a>
            <a href="orders.php">orders</a>
            <a href="shop.php">shop</a>
            <a href="contact.php">contact</a>
        </nav>

        <div class="icons">
            <?php
                $count_favourite_items = $conn->prepare("SELECT * FROM `favourites` WHERE user_id = ?");
                $count_favourite_items->execute([$user_id]);
                $total_favourite_items = $count_favourite_items->rowCount();

                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_items = $count_cart_items->rowCount();
            ?>
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="buy products/search_page.php"><i class="fas fa-search"></i></a>
            <a href="buy products/favourites.php"><i class="fas fa-heart"></i><span>(<?= $total_favourite_items; ?>)</span></a>
            <a href="buy products/cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile"> 
            <?php 
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?"); 
                $select_profile->execute([$user_id]);
                if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                
            ?>
            <P><?= $fetch_profile['name']; ?></P> 
            <a href="../admin/update_profile.php" class="btn">update profile</a>
            <div class="flex-btn">
                <a href="../admin/admin_login.php" class="option-btn">login</a>
                <a href="../admin/register_admin.php" class="option-btn">register</a>
            </div>
            <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
            <?php
                }else{

                
            ?>
            <p>Please login!</p>
            <div class="flex-btn">
                <a href="../admin/admin_login.php" class="option-btn">login</a>
                <a href="../admin/register_admin.php" class="option-btn">register</a>
            </div>
            <?php
                }
            ?>
        </div>
        
    </section>

    
</header>