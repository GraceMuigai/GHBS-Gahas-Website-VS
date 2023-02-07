<?php

include '../components/connect.php';

session_start(); 

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $cpassword = $_POST['cpassword'];
    $cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
    $select_admin->execute([$name]);
    $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
    
    if ($select_admin->rowCount() > 0){
        $message[] = 'username already exists!';
    }else{
        if($password != $cpassword){
            $message[] = 'confirm password does not match!';
        }else{
            $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
            $insert_admin->execute([$name, $cpassword]);
            $message[] = 'new admin registered!';
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
    <title>register</title>

    
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

<?php include '../components/admin_header.php'; ?>

    <!-- register admin section starts -->

    <section class="form-container">
            <form action="" method="post">
                <h3>register new</h3>
                <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
                <input type="password" name="password" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
                <input type="password" name="cpassword" maxlength="20" required placeholder="confirm your password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
                <input type="submit" value="register now" name="submit" class="btn">
            </form>
        </section>


    <!-- register admin section ends -->











<!-- custom js file -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>