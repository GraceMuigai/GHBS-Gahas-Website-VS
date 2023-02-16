<?php

include '../components/connect.php';

session_start(); 

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
    $delete_message->execute([$delete_id]);
    header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>

    
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

<!-- messages section starts -->

<section class="messages">

    <h1 class="heading">New Messages</h1>

    <div class="box-container">

        <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            if($select_messages->rowCount() > 0){
                while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
        ?>

        <div class="box">
            <p> user id : <span><?= $fetch_messages['user_id'] ?></span></p>
            <p> username : <span><?= $fetch_messages['name'] ?></span></p>
            <p> phone number : <span><?= $fetch_messages['number'] ?></span></p>
            <p> email : <span><?= $fetch_messages['email'] ?></span></p>
            <p> messages : <span><?= $fetch_messages['message'] ?></span></p>
            <a href="messages.php?delete=<?= $fetch_messages['id']; ?>" class="delete-btn" onclick= "return confirm('delete this message?');">delete</a>
        </div>

        <?php
                }
            }else{
                echo '<p class="empty">you have no messages!</p>';
            }
        ?>
    </div>
</section>

<!-- messages section ends -->











<!-- custom js file -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>