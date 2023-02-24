<?php
// include '../../book_form.php';
include '../components/connect.php';

session_start(); 

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_booking = $conn->prepare("DELETE FROM `book_form` WHERE id = ?");
    $delete_booking->execute([$delete_id]);
    header('location:booked_services.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookings</title>

    
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

<!-- booked services section starts -->

<section class="booked-services">

    <h1 class="heading">booked services</h1>

    <div class="box-container">


        <?php
            $select_booked_services = $conn->prepare("SELECT * FROM `book_form`");
            $select_booked_services->execute();
            if($select_booked_services->rowCount() > 0){
                while($fetch_booked_services = $select_booked_services->fetch(PDO::FETCH_ASSOC)){
      
        ?>
        <div class="box">
            <p> id : <span><?= $fetch_booked_services['id']; ?></span></p>
            <p> username : <span><?= $fetch_booked_services['name']; ?></span></p>
            <p> email : <span><?= $fetch_booked_services['email']; ?></span></p>
            <p> phone number : <span><?= $fetch_booked_services['phone']; ?></span></p>
            <p> service : <span><?= $fetch_booked_services['service']; ?></span></p>
            <p> length : <span><?= $fetch_booked_services['length']; ?></span></p>
            <p> arrival : <span><?= $fetch_booked_services['arrival']; ?></span></p>
            <a href="booked_services.php?delete=<?= $fetch_booked_services['id']; ?>" class="delete-btn" onclick= "return confirm('delete this booked service?');">delete</a>
        </div>

        <?php
                }
            }else{
                echo '<p class="empty">no available booked services!</p>';
            }
        ?>
    </div>
</section>

<!-- booked services section ends -->











<!-- custom js file -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>