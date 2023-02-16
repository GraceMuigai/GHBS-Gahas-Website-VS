<?php

include '../components/connect.php';

session_start(); 

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
    $delete_admin->execute([$delete_id]);
    header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admins accounts</title>

    
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

<!-- admins account section starts -->

<section class="accounts">

    <h1 class="heading">admins accounts</h1>

    <div class="box-container">


        <div class="box">
            <p>register new admin</p>
            <a href="register_admin.php" class="option-btn">register</a>
        </div>

        <?php
            $select_accounts = $conn->prepare("SELECT * FROM `admins`");
            $select_accounts->execute();
            if($select_accounts->rowCount() > 0){
                while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){
      
        ?>
        <div class="box">
            <p> admin id : <span><?= $fetch_accounts['id']; ?></span></p>
            <p> username : <span><?= $fetch_accounts['name']; ?></span></p>
            <div class="flex-btn">
            <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick= "return confirm('delete this account?');">delete</a>
            <?php
                if($fetch_accounts['id'] == $admin_id){
                    echo '<a href="update_profile.php" class="option-btn">update</a>';
                }
            ?>
            </div>
        </div>

        <?php
                }
            }else{
                echo '<p class="empty">no available accounts!</p>';
            }
        ?>
    </div>
</section>

<!-- admins account section ends -->











<!-- custom js file -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>