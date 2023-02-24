<?php
    $conn = mysqli_connect('localhost','root','','shop_db');

    if(isset($_POST['submitted'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $service = $_POST['service'];
        $length = $_POST['length'];
        $arrival = $_POST['arrival'];

        $_REQUEST = " insert into book_form(name, email, phone, service, length, arrival) 
        value('$name', '$email', '$phone', '$service', '$length', '$arrival')"; 

        mysqli_query($conn, $_REQUEST);

        header('location:book.php');

    }else{
        echo 'something went wrong try again';
    }
?>