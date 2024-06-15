<?php
include("db.php");
include("functions.php");
?>
<!DOCTYPE html>
<html>
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
                  <i class="bx bxs-shopping-bags nav__logo-icon"></i>e-shopper</a>
                  <div class="nav__menu" id="nav_menu">
                      <ul class="unlist">
                          <li class="item"><a href="homePage.php" class="nav__link active-link">Home</a></li>
                     
                          <li class="item"><a href="shop.php" class="nav__link">Shop</a></li>
                     
                          <li class="item"><a href="register.php" class="nav__link">Sign up</a></li>
                     
                          <li class="item"><a href="blog.php" class="nav__link">Blog</a></li>
                     
                          <li class="item"><a href="About.php" class="nav__link">About</a></li>
                  
                          <li class="item"><a href="contact.php" class="nav__link">Contact</a></li>
                      </ul>
                      <div class="nav__close" id="nav-close">
                          <i class="bx bx-x"></i>
                      </div>
                  </div>
            
            <div class="navBtns">
              <div class="loginToggle" id="loginToggle">
                  <i class="bx bx-user"></i>
              </div>
              <div class="shop" id="cartShop">
                  <i class="bx bx-shopping-bag"></i>
              </div>
              <div class="navToggle" id="navToggle">
                  <i class="bx bx-grid-alt"></i>
              </div>
            </div>
           </nav>
        </header>
        <main class="main">
            <section class="register">
                <h2 class="loginTitle-center">Create an Account</h2>
                <form action="register.php" method="post" class="register__form" onsubmit="return validateForm()">
                    <div class="register__field">
                        <label for="" class="register__label">Name</label>
                        <input type="text" class="register__input" name="c_name" placeholder="enter your name" id="name">
                    </div>
                    <div class="register__field">
                        <label for="" class="register__label">Email</label>
                        <input type="email" class="register__input" name="c_email" placeholder="enter your email" id="email">
                    </div>
                    <div class="register__field">
                        <label for="" class="register__label">Password</label>
                        <input type="password" class="register__input" name="c_pass" placeholder="enter password" id="password">
                    </div>
                    <div class="register__field">
                        <label for="" class="register__label">Contact</label>
                        <input type="text" class="register__input" name="c_contact" placeholder="enter contact number" id="contact">
                    </div>
                    <div class="register__field">
                        <label for="" class="register__label">Address</label>
                        <input type="text" class="register__input" name="c_address" placeholder="enter your address"id="address">
                    </div>
                    <div class="register__field">
                        <label for="" class="register__label">Country</label>
                        <select name="c_country" class="register__input" id="country">
                         <option>select country</option>
                         <option>Afghanistan</option>
                         <option>Pakistan</option>
                         <option>China</option>
                         <option>UAE</option>
                         <option>UK</option>
                         <option>US</option>

                        </select>
                    </div>
                    <div>
                        <input type="submit" class="btn" name="register" value="Sign up"/>
                    </div>

                </form>

            </section>
        </main>
    </body>
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
                    <h3 class="footerTitle"><b>About</b></h3>
                    <ul class="footerLinks">
                        <li><a href="" class="footerLink">About Us</a></li>
                        <li><a href="" class="footerLink">Customer Support</a></li>
                        <li><a href="" class="footerLink">Support Center</a></li>
                    </ul>
                </div>
                <div class="footerContent">
                    <h3 class="footerTitle"><b>Our Services</b></h3>
                    <ul class="footerLinks">
                        <li><a href="" class="footerLink">Shop</a></li>
                        <li><a href="" class="footerLink">Discount</a></li>
                        <li><a href="" class="footerLink">Shipping mode</a></li>
                    </ul>
                </div>
                <div class="footerContent">
                    <h3 class="footerTitle"><b>Our Company</b></h3>
                    <ul class="footerLinks">
                        <li><a href="" class="footerLink">About Us</a></li>
                        <li><a href="" class="footerLink">Register</a></li>
                        <li><a href="" class="footerLink">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <span class="footerCopy">&#169; Criptical coder. All rights reserved</span>
        </footer>
    <script src="script.js"></script>
</html>
<?php 
if(isset($_POST['register'])){
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    $c_country=$_POST['c_country'];
    $c_ip= getIPAddress();

    $insert_customer="insert into customers (customer_name,customer_email,customer_pass,customer_contact,customer_address,customer_country,customer_ip) values('$c_name','$c_email','$c_pass','$c_contact','$c_address','$c_country','$c_ip')";
    $run_customer=mysqli_query($con,$insert_customer);
    $sel_cart="select * from cart where ip_add='$c_ip'";
    $run_cart=mysqli_query($con,$sel_cart);
    $check_cart=mysqli_num_rows($run_cart);
    if($check_cart>0){
        $_SESSION['customer_email']=$c_email;
        echo"<script>alert('Account created successfully')</script>";
        echo"<script>window.open('welcome.php','_self')</script>";
    }
    else{
        echo"<script>alert('Account created successfully')</script>";
        echo"<script>window.open('homePage.php','_self')</script>";
    }
}
?>