<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_header</title>

    
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

<header class="header">

    <section class="flex">
        <a href="../admin/dashboard.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a href="../admin/dashboard.php">home</a>
            <a href="../admin/products.php">products</a>
            <a href="../admin/placed_orders.php">orders</a>
            <a href="../admin/admin_accounts.php">admin accounts</a>
            <a href="../admin/users_accounts.php">users accounts</a>
            <a href="../admin/messages.php">messages</a>
            <a href="../../book_form.php">Bookings</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile"> <!--problem-->
            <?php 
                $select_profile = $conn->prepare("SELECT * FROM 'admins' WHERE id = ?"); 
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <P><?= $fetch_profile['name']; ?></P> <!--problem-->
            <a href="update_profile.php" class="btn">update profile</a>
            <div class="flex-btn">
                <a href="admin_login.php" class="option-btn">login</a>
                <a href="register_admin.php" class="option-btn">register</a>
            </div>
            <a href="../components/admin_logout.php" class="delete-btn">logout</a>
        </div>
        
    </section>

    
</header>

</body>
</html>