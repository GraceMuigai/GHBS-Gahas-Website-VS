<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:site_products.php');
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $email, $user_id]);

    $empty_password = '';
    $select_prev_password = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
    $select_prev_password->execute([$user_id]);
    $fetch_prev_password = $select_prev_password->fetch(PDO::FETCH_ASSOC);
    $prev_password = $fetch_prev_password['password'];
    $old_password = $_POST['old_password'];
    $old_password = filter_var($old_password, FILTER_SANITIZE_STRING);
    $new_password = $_POST['new_password'];
    $new_password = filter_var($new_password, FILTER_SANITIZE_STRING);
    $confirm_password = $_POST['confirm_password'];
    $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);

    if($old_password == $empty_password){
        $message[] = 'please enter old password!';
    }elseif($old_password != $prev_password){
        $message[] = 'old password not matched!';
    }elseif($new_password != $confirm_password){
        $message[] = 'confirm password not matched!';
    }else{
        if($new_password != $empty_password){
            $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_password->execute([$confirm_password, $user_id]);
            $message[] = 'Successful password update!';
        }else{
            $message[] = 'please enter new password!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>

    
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

<!-- user update section starts -->

<section class="form-container">

    <form action="" method="POST">
        <h3>Update Profile</h3>
        <input type="text" required maxlength="20" name="name" placeholder="enter you name" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name']; ?>">
        <input type="email" required maxlength="50" name="email" placeholder="enter you email" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['email']; ?>">
        <input type="password" maxlength="20" name="old_password" placeholder="enter your old password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" maxlength="20" name="new_password" placeholder="enter new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" maxlength="20" name="confirm_password" placeholder="confirm new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="update now" class="btn" name="submit">
    </form>
</section>




<!-- user update section ends -->

























<?php include 'components/footer.php';?>


<!-- custom js file -->
<script src="../buy products/js/product_script.js"></script>

</body>
</html>