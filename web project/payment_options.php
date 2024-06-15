<?php
session_start();
include("db.php");
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="1stcolor.css">
    <title>e-commerce website</title>
</head>
<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="homePage.html" class="nav__logo">
                <i class="bx bxs-shopping-bags nav__logo-icon"></i>e-shopper
            </a>
            <div class="nav__menu" id="nav_menu">
                <ul class="unlist">
                    <li class="item"><a href="homePage.html" class="nav__link active-link">Home</a></li>
                    <li class="item"><a href="shop.php" class="nav__link">Shop</a></li>
                    <li class="item"><a href="#" class="nav__link">Sign up</a></li>
                    <li class="item"><a href="blog.html" class="nav__link">Blog</a></li>
                    <li class="item"><a href="About.php" class="nav__link">About</a></li>
                    <li class="item"><a href="contact.html" class="nav__link">Contact</a></li>
                </ul>
                <div class="nav__close" id="nav-close">
                    <i class="bx bx-x"></i>
                </div>
            </div>
            <div class="navBtns">
                <div class="shop" id="cartShop">
                    <i class="bx bx-shopping-bag"></i>
                </div>
                <?php if(!isset($_SESSION['customer_email'])): ?>
                    <div class='loginToggle' id='loginToggle'>
                        <i class='bx bx-user'></i>
                    </div>
                <?php else: ?>
                    <div class='shop'>
                        <p><a href='logout.php' style='text-decoration:none; color:var(--title-color)'>Logout</a></p>
                    </div>
                <?php endif; ?>
                <div class="navToggle" id="navToggle">
                    <i class="bx bx-grid-alt"></i>
                </div>
            </div>
        </nav>
    </header>

    <main class="main">
        <section class="payment-section">
            <h2>Payment Options</h2>
            <img src="images/safe-checkout.webp" alt="Payment Options">
            <p>or <a href="">offline</a> payment options</p>
        </section>
    </main>

    <footer class="footer section">
        <div class="footerCont container grid">
            <div class="footerContent">
                <a href="#" class="footerLogo">
                    <i class="bx bxs-shopping-bags footerLogo-icon"></i>e-shopper
                </a>
                <p class="footerDesc">Enjoy the biggest sale <br>of your life </p>
                <div class="footerSocial">
                    <a href="#" class="footerSocial-link"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="footerSocial-link"><i class="bx bxl-instagram-alt"></i></a>
                    <a href="#" class="footerSocial-link"><i class="bx bxl-twitter"></i></a>
                </div>
            </div>
            <div class="footerContent">
                <h3 class="footerTitle">About</h3>
                <ul class="footerLinks">
                    <li><a href="" class="footerLink">About Us</a></li>
                    <li><a href="" class="footerLink">Customer Support</a></li>
                    <li><a href="" class="footerLink">Support Center</a></li>
                </ul>
            </div>
            <div class="footerContent">
                <h3 class="footerTitle">Our Services</h3>
                <ul class="footerLinks">
                    <li><a href="" class="footerLink">Shop</a></li>
                    <li><a href="" class="footerLink">Discount</a></li>
                    <li><a href="" class="footerLink">Shipping mode</a></li>
                </ul>
            </div>
            <div class="footerContent">
                <h3 class="footerTitle">Our Company</h3>
                <ul class="footerLinks">
                    <li><a href="" class="footerLink">About Us</a></li>
                    <li><a href="" class="footerLink">Register</a></li>
                    <li><a href="" class="footerLink">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <span class="footerCopy">&#169; Criptical coder. All rights reserved</span>
    </footer>

    <a href="" class="scrollup" id="scrollup">
        <i class="bx bx-up-arrow-alt scrollupIcon"></i>
    </a>
    <script src="swiper-bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
