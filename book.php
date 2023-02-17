<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>

    <!--swipper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!--font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

<!--font google-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Andika:ital@0;1&family=Lato:ital@0;1&family=Roboto:ital,wght@0,400;1,500&display=swap" rel="stylesheet">

<!--custom css file link-->
<link rel="stylesheet" href="css/Style.css">


</head>
<body>

    <!-- header section starts -->
    <section class="header">
        <a href="home.php" class="logo">Gahas Braiding Creativity</a>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="services.php">Services</a>
            <a href="products_home.php">Products</a>
            <a href="about.php">About</a>
            <a href="book.php">Book</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars">
            
        </div>
    </section>
    <!-- header section ends -->

    <div class="heading"style="background:url(images/header-bg-gahas-karura.png) no-repeat">
        <h1>Book Now</h1>
    </div>

    <!-- booking section starts -->

    <section class="booking">

        <h1 class="heading-title">book your Appointment</h1>

        <form action="book_form.php" method="post" class="book-form">

            <div class="flex">
                <div class="inputBox">
                    <span>name:</span>
                    <input type="text" placeholder="enter your name" name="name">
                </div>

                <div class="inputBox">
                    <span>email:</span>
                    <input type="email" placeholder="enter your email" name="email">
                </div>

                <div class="inputBox">
                    <span>phone number:</span>
                    <input type="number" placeholder="eg. 0123456789" name="phone">
                </div>

                <div class="inputBox">
                    <span>Service to book:</span>
                    <input type="text" placeholder="service to book" name="service">
                </div>

                <div class="inputBox">
                    <span>Prefered length:</span>
                    <input type="text" placeholder="length of the braids/plaiting" name="length">
                </div>

                <div class="inputBox">
                    <span>Arrival time:</span>
                    <input type="datetime-local" name="arrival">
                </div>
            </div>

            <input type="submit" value="submit" class="btn" name="submitted">
        </form>
    </section>
    
    
    
    
    
    
    
    
    
    <!-- booking section starts -->






    <!-- footer section starts -->
    <section class="footer">

        <div class="box-container">
            
            <div class="box">
                <h3>Quick Links</h3>
                <a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
                <a href="services.php"> <i class="fas fa-angle-right"></i> Services</a>
                <a href="products_home.php"> <i class="fas fa-angle-right"></i> Products</a>
                <a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
                <a href="book.php"> <i class="fas fa-angle-right"></i> Book</a>
            </div>

            <div class="box">
                <h3>Extra Links</h3>
                <a href="#"> <i class="fas fa-angle-right"></i> Ask questions</a>
                <a href="#"> <i class="fas fa-angle-right"></i> About us</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Privacy Policy</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Terms of Use</a>
            </div>

            <div class="box">
                <h3>Contact Info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +254 740 403756 </a>
                <a href="#"> <i class="fas fa-phone"></i> +254 772 868174 </a>
                <a href="#"> <i class="fas fa-envelope"></i> gahasbraidingcreativity@gmail.com </a>
                <a href="#"> <i class="fas fa-map"></i> kenyatta road, Juja </a>
            </div>

            <div class="box">
                <h3>Follow Us</h3>
                <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            </div>

        </div>

        <div class="credit"> created by <span>Grace Muigai aka Gahas</span>  |  all rights reserved! </div>
    </section>
    <!-- footer section ends -->

  


    <!-- swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <!-- custom js file link -->
     <script src="js/Script.js"></script>
    
</body>
</html>