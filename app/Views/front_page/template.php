<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/foodwebsite/style.css">
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/assets/foodwebsite/images/home-img.png" />

</head>

<body>

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


    <section class="home" id="home">

        <div class="content">
            <h3>ResRim</h3>
            <p>Kami dari pihak Restoran Rimba, <br>menyajikan makanan yang kelihatan mahal <br>tapi sebenarnya tidak mahal.<br>
                <b>Silahkan login sebelum pesan makanan.</b>
            </p>
            <a href="<?= base_url('/login'); ?>" class="btn">Login</a>
        </div>

        <div class="image">
            <img src="<?= base_url(); ?>/assets/foodwebsite/images/home-img.png" alt="">
        </div>

    </section>

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

        <!-- <div class="share">
            <a href="#" class="btn">facebook</a>
            <a href="#" class="btn">twitter</a>
            <a href="#" class="btn">instagram</a>
            <a href="#" class="btn">pinterest</a>
            <a href="#" class="btn">linkedin</a>
        </div> -->

        <h1 class="credit"> created by <span> <a href="http://www.rimbadirgantara.github.io" style="color: orangered;">Rimba Dirgantara</a> </span> | all rights reserved! </h1>

    </section>

    <!-- scroll top button  -->
    <a href="#home" class="fas fa-angle-up" id="scroll-top"></a>

    <!-- loader  -->
    <div class="loader-container">
        <img src="<?= base_url(); ?>/assets/foodwebsite/images/loader.gif" alt="">
    </div>

    <!-- custom js file link  -->
    <script src="<?= base_url(); ?>/assets/foodwebsite/script.js"></script>


</body>

</html>