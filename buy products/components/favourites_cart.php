<?php

if(isset($_POST['add_to_favourites'])){

    if($user_id == ''){
        header('location:user_login.php');
    }else{
        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $image = $_POST['image'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);

        $check_favourites_numbers = $conn->prepare("SELECT * FROM `favourites` WHERE name = ? AND user_id = ?");
        $check_favourites_numbers->execute([$name, $user_id]);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$name, $user_id]);
        
        if($check_favourites_numbers->rowCount() > 0){
            $message[] = 'already added to favourites!';
        }elseif($check_cart_numbers->rowCount() > 0){
            $message[] = 'already added to cart!';
        }else{
            $insert_favourites = $conn->prepare("INSERT INTO `favourites`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
            $insert_favourites->execute([$user_id, $pid, $name, $price, $image]);
            $message[] = 'added to favourites!';
        }
        
    }
}


if(isset($_POST['add_to_cart'])){

    if($user_id == ''){
        header('location:user_login.php');
    }else{
        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $image = $_POST['image'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);


        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$name, $user_id]);
        
        if($check_cart_numbers->rowCount() > 0){
            $message[] = 'already added to cart!';
        }else{

            $check_favourites_numbers = $conn->prepare("SELECT * FROM `favourites` WHERE name = ? AND user_id = ?");
            $check_favourites_numbers->execute([$name, $user_id]);

            if($check_favourites_numbers->rowCount() > 0){
                $delete_favourites = $conn->prepare("DELETE FROM `favourites` WHERE name = ? AND user_id = ?");
                $delete_favourites->execute([$name, $user_id]);
            }

            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
            $message[] = 'added to cart!';
        }
        
    }
}

?>