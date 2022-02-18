<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/foodwebsite/style.css">

</head>
<body>
    
<!-- header section starts  -->

<header>

    <a href="#" class="logo"><i class="fas fa-utensils"></i><?= $banner; ?></a>

    <div id="menu-bar" class="fas fa-bars"></div>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#popular">Popular</a>
        <a href="#menu">Menu</a>
        <a href="#review">review</a>
        <a href="#order">order</a>
    </nav>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <h3>ResRim</h3>
        <p>Kami dari pihak Restoran Rimba, menyajikan makanan yang kelihatan mahal tapi sebenarnya tidak mahal.<br>
        Silahkan login sebelum pesan makanan.</p>
        <a href="<?= base_url('/login'); ?>" class="btn">Login</a>
    </div>

    <div class="image">
        <img src="<?= base_url(); ?>/assets/foodwebsite/images/home-img.png" alt="">
    </div>

</section>

<!-- home section ends -->

<!-- speciality section starts  -->

<?= $this->renderSection('front_page_contennt'); ?>

<!-- review section ends -->

<!-- order section starts  -->

<!-- <section class="order" id="order">

    <h1 class="heading"> <span>order</span> now </h1>

    <div class="row">
        
        <div class="image">
            <img src="<?= base_url(); ?>/assets/foodwebsite/images/order-img.jpg" alt="">
        </div>

        <form action="">

            <div class="inputBox">
                <input type="text" placeholder="name">
                <input type="email" placeholder="email">
            </div>

            <div class="inputBox">
                <input type="number" placeholder="number">
                <input type="text" placeholder="food name">
            </div>

            <textarea placeholder="address" name="" id="" cols="30" rows="10"></textarea>

            <input type="submit" value="order now" class="btn">

        </form>

    </div>

</section> -->

<!-- order section ends -->

<!-- footer section  -->

<section class="footer">

    <div class="share">
        <a href="#" class="btn">facebook</a>
        <a href="#" class="btn">twitter</a>
        <a href="#" class="btn">instagram</a>
        <a href="#" class="btn">pinterest</a>
        <a href="#" class="btn">linkedin</a>
    </div>

    <h1 class="credit"> created by <span> mr. web designer </span> | all rights reserved! </h1>

</section>

<!-- scroll top button  -->
<a href="#home" class="fas fa-angle-up" id="scroll-top"></a>

<!-- loader 
<div class="loader-container">
    <img src="<?= base_url(); ?>/assets/foodwebsite/images/loader.gif" alt="">
</div> -->

<!-- custom js file link  -->
<script src="<?= base_url(); ?>/assets/foodwebsite/script.js"></script>


</body>
</html>