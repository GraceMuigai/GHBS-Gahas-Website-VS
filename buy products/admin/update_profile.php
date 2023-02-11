<?php

include '../components/connect.php';

session_start(); 

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
    $update_name->execute([$name, $admin_id]);

    $empty_password = '';
    $select_old_password = $conn->prepare("SELECT password FROM `admins` WHERE id = ?");
    $select_old_password->execute([$admin_id]);
    $fetch_prev_password = $select_old_password->fetch(PDO::FETCH_ASSOC);
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
        if($new_password !=$empty_password){
            $update_password = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
            $update_password->execute([$confirm_password, $admin_id]);
            $message[] = 'password updated successfully!';
        }else{
            $message[] = 'please enter the new password!';
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
    <title>profile update</title>

    
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

<?php include '../components/admin_header.php'?>

<!-- admin profile update section starts -->

        <section class="form-container">
            <form action="" method="post">
                <h3>update profile</h3>
                <input type="hidden" name="prev_password" value="<?= $fetch_profile['password']; ?>">
                <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value= this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name']; ?>">
                <input type="password" name="old_password" maxlength="20" placeholder="enter your old password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
                <input type="password" name="new_password" maxlength="20" placeholder="enter your new password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
                <input type="password" name="confirm_password" maxlength="20" placeholder="confirm your new password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
                <input type="submit" value="update now" name="submit" class="btn">
            </form>
        </section>

<!-- admin profile update section ends -->










<!-- custom js file -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>