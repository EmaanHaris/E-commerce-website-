<?php
session_start();
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
          <div class="shop" id="cartShop">
                <i class="bx bx-shopping-bag"></i>
            </div>
            <?php
            if(!isset($_SESSION['customer_email'])){
                echo "<div class='loginToggle' id='loginToggle'>
                <i class='bx bx-user'></i>
                </div>";
            }
            else{
                 echo "<div class='shop'>
                <p><a href='logout.php' style='text-decoration:none; color:var(--title-color)'>Logout</a></p>
                </div>";
            }
            

            ?>
            <div class="navToggle" id="navToggle">
                <i class="bx bx-grid-alt"></i>
            </div>
          </div>
         </nav>
        </header>
        <!--cart-->
        <div class="cart " id="cart">
            <i class="bx bx-x cartClose" id="cartClose"></i>
            <h2 class="cartTitle-center">My Cart</h2>
            <div class="cartCont">
            <?php
                    $ip_add=getIPAddress();
                    $total=0;
                    $sel_price="select * from cart where ip_add='$ip_add'";
                    $run_price=mysqli_query($con, $sel_price); 
                    echo "<form method='POST' action='shop.php'>";
                    while($record=mysqli_fetch_array($run_price)){
                        $pro_id=$record['p_id'];
                        $pro_price="select * from products where product_id='$pro_id'";
                        $run_pro_price=mysqli_query($con,$pro_price);
                        while($p_price=mysqli_fetch_array($run_pro_price)){
                            $product_price=array($p_price['product_price']);
                            $product_title=$p_price['product_title'];
                            $product_image=$p_price['product_img1'];
                            $values=array_sum($product_price);
                            $only_price=$p_price['product_price'];
                            $total+=$values;
                        
                    
                    /*if(isset($_POST['remove'])){
                        foreach($_POST['remove'] as $remove_id){
                 
                         $delete_products="delete from cart where p_id='$remove_id'";
                         $run_delete=mysqli_query($con,$delete_products);
                         if($run_delete){
                             echo "<script>window.open('shop.php,_self')</script>";
                         }
                 
                        }
                     }*/
                  echo "  <article class='cartCard'>
                        <div class='cartBox'>
                            <img class='cartImg' alt='cart' src='images/$product_image'>
                        </div>
                        <div class='cartDetails'>
                            <h3 class='cartTitle'> $product_title</h3>
                            <span class='cartPrice'>$$only_price</span>
                            <div class='cartAmount'>
                                <div class='cartAmount-content'>
                                    <i class='cartAmount-box'>
                                        <i class='bx bx-minus'></i>
                                    </i>
                                    <span class='cartAmount-num'>1</span>
                                    <i class='cartAmount-box'>
                                        <i class='bx bx-plus'></i>
                                    </i>
                                </div>
                                
                                <button class='cartAmount-trash' name='remove' value='$pro_id'>
                               <i class='bx bx-trash-alt cartAmount-trash'></i></button>
                            </div>
                        </div>
                       </article>";
                    }
                }
                echo "
                <div class='cartCheckout'>
                      <button class='btn checkout'><a href='shop.php'>Check Out</a></button>
                </div>";
                 echo" </form>";

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
                        $remove_id = $_POST['remove'];
                        $delete_products = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip_add'";
                        $run_delete = mysqli_query($con, $delete_products);
                        
                        if ($run_delete) {
                            echo "<script>window.open('shop.php', '_self')</script>";
                        }
                    }
                  ?>
            </div>

            <div class="cartPrices">
                <span class="cartPrices-item">3 items</span>
                <span class="cartPrices-total">$35</span>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $('.cartAmount-trash').on('click', function() {
                var form = $(this).closest('form');
                form.submit();
            });
        });
      </script>
        <!--login-->
        <div class="login" id="login">
                <i class="bx bx-x closeLogin" id="closeLogin"></i>
                <h2 class="loginTitle-center">Login</h2>
                <form action="shop.php" method="POST" class="loginForm grid">
                    <div class="loginContent">
                        <label for="" class="loginLabel">Email</label>
                        <input type="email" class="loginInput" name="c_email" value="enter your email">
                    </div>
                    <div class="loginContent">
                        <label for="" class="loginLabel">Password</label>
                        <input type="password" class="loginInput" name="c_pass">
                    </div>
                    <div>
                        <input type="submit" class="btn" name="c_login" value="login"/>
                    </div>
                    <div>
                        <p class="signUp">Not a member? <a href="register.php">Sign Up</a></p>
                    </div>
                </form>
        </div>
        <main class="main">
            <section class="home container">
                <div class="swiper home-swiper">
                    <div class="swiper-wrapper">

                        <section class="swiper-slide">
                            <div class="homeContent grid">
                                <div class="homeGroup">
                                    <img src="images/simple headphone.jpg" alt="" class="homeImg">
                                    <div class="homeInd"></div>
                                    <div class="homeDetails-img">
                                        <h4 class="homeDetails-title">The "Headphone"</h4>
                                        <span class="homeDetails-subtitle">Wireless</span>
                                    </div>
                                </div>

                                <div class="homeData">
                                    <h3 class="home-subtitle">#1 TRENDING</h3>
                                    <h1 class="home-title">ORIGNAL<br>IS<br>NEVER<br>FINISHED!</h1>
                                    <p class="home-des">A speacialist brand making electronic essentials.
                                        Ethically crafted with an unwavering commitment to exceptional quality.
                                    </p>

                                    <div class="homeBtn">
                                        <a href="details.html" class="btn">Buy Now</a>
                                        <a href="details.html" class="btnLink btnFlex">View Details <i class="bx bx-right-arrow-alt btnIcon"></i></a>
                                    </div>

                                </div>
                            </div>
                        </section>

                        <section class="swiper-slide">
                            <div class="homeContent grid">
                                <div class="homeGroup">
                                    <img src="images/earbuds.jpg" alt="" class="homeImg">
                                    <div class="homeInd"></div>
                                    <div class="homeDetails-img">
                                        <h4 class="homeDetails-title">Earbuds</h4>
                                        <span class="homeDetails-subtitle">Black</span>
                                    </div>
                                </div>

                                <div class="homeData">
                                    <h3 class="home-subtitle">#2 top best DUO</h3>
                                    <h1 class="home-title">ELEVVATE<br>YOUR<br>AUDIO<br>EXPERIANCE!</h1>
                                    <p class="home-des">Introducing our latest innovation in audio technology: our premium earbuds, now on sale! 
                                        Immerse yourself in a world of crystal-clear sound and unparalleled comfort with our state-of-the-art earbuds.
                                    </p>

                                    <div class="homeBtn">
                                        <a href="details.html" class="btn">Buy Now</a>
                                        <a href="details.html" class="btnLink btnFlex">View Details <i class="bx bx-right-arrow-alt btnIcon"></i></a>
                                    </div>

                                </div>
                            </div>
                        </section>

                        <section class="swiper-slide">
                            <div class="homeContent grid">
                                <div class="homeGroup">
                                    <img src="images/speaker.jfif" alt="" class="homeImg">
                                    <div class="homeInd"></div>
                                    <div class="homeDetails-img">
                                        <h4 class="homeDetails-title">SPEAKER</h4>
                                        <span class="homeDetails-subtitle">Wireless</span>
                                    </div>
                                </div>

                                <div class="homeData">
                                    <h3 class="home-subtitle">#3 TRENDING ITEM</h3>
                                    <h1 class="home-title">UNLEASH<br>THE<br>SOUND<br>OF<br>FREEDOM!</h1>
                                    <p class="home-des">Featuring advanced Bluetooth technology, you can effortlessly connect your 
                                                        devices and stream your favorite music from anywhere in the room. 
                                    </p>

                                    <div class="homeBtn">
                                        <a href="details.html" class="btn">Buy Now</a>
                                        <a href="details.html" class="btnLink btnFlex">View Details <i class="bx bx-right-arrow-alt btnIcon"></i></a>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </section>

            <section class="discount section">
                <div class="disContainer container grid">
                    <img src="images/mouse.jpg" alt="mouse" class="disImg">
                    <div class="disData">
                        <h2 class="disTitle">50% off on<br>New items</h2>
                        <a href="" class="btn">Go to new</a>
                    </div>
                </div>
            </section>

            <section class="new section">
                <h2 class="section__title">New Arrival</h2>
                <div class="newContainer container">
                   <div class="swiper new-swiper"> 
                        <div class="swiper-wrapper">

                           <div class="newContent swiper-slide">
                            <div class="newTag">New</div>
                            <img src="images/keyboard.jfif" alt="keyboard" class="newImg">
                            <h3 class="newTitle">Keyboard</h3>
                            <span class="newSubtitle">Mechanical</span>
                            <div class="newPrices">
                                <span class="newPrice">$25</span>
                                <span class="newDis">$30</span>
                            </div>
                            <a href="details.html" class="btn newbtn">
                                <i class="bx bx-cart-alt newIcon"></i>
                            </a>
                           </div>

                           <div class="newContent swiper-slide">
                            <div class="newTag">New</div>
                            <img src="images/keyboard1.jpg" alt="keyboard" class="newImg">
                            <h3 class="newTitle">Keyboard</h3>
                            <span class="newSubtitle">Gaming</span>
                            <div class="newPrices">
                                <span class="newPrice">$30</span>
                                <span class="newDis">$32</span>
                            </div>
                            <a href="details.html" class="btn newbtn">
                                <i class="bx bx-cart-alt newIcon"></i>
                            </a>
                           </div>

                           <div class="newContent swiper-slide">
                            <div class="newTag">New</div>
                            <img src="images/earphones.jpg" alt="earphones" class="newImg">
                            <h3 class="newTitle">Earphones</h3>
                            <span class="newSubtitle">Accessory</span>
                            <div class="newPrices">
                                <span class="newPrice">$9</span>
                                <span class="newDis">$11</span>
                            </div>
                            <a href="details.html" class="btn newbtn">
                                <i class="bx bx-cart-alt newIcon"></i>
                            </a>
                           </div>

                           <div class="newContent swiper-slide">
                            <div class="newTag">New</div>
                            <img src="images/earphones1.webp" alt="earphones" class="newImg">
                            <h3 class="newTitle">Keyboard</h3>
                            <span class="newSubtitle">Mechanical</span>
                            <div class="newPrices">
                                <span class="newPrice">$14</span>
                                <span class="newDis">$16</span>
                            </div>
                            <a href="details.html" class="btn newbtn">
                                <i class="bx bx-cart-alt newIcon"></i>
                            </a>
                           </div>

                           <div class="newContent swiper-slide">
                            <div class="newTag">New</div>
                            <img src="images/cable.jpg" alt="cable" class="newImg">
                            <h3 class="newTitle">Cable</h3>
                            <span class="newSubtitle">c-type</span>
                            <div class="newPrices">
                                <span class="newPrice">$12</span>
                                <span class="newDis">$15</span>
                            </div>
                            <a href="details.html" class="btn newbtn">
                                <i class="bx bx-cart-alt newIcon"></i>
                            </a>
                           </div>

                           <div class="newContent swiper-slide">
                            <div class="newTag">New</div>
                            <img src="images/speaker1.jpg" alt="speaker" class="newImg">
                            <h3 class="newTitle">Speaker</h3>
                            <span class="newSubtitle">Wireless</span>
                            <div class="newPrices">
                                <span class="newPrice">$50</span>
                                <span class="newDis">$52</span>
                            </div>
                            <a href="details.html" class="btn newbtn">
                                <i class="bx bx-cart-alt newIcon"></i>
                            </a>
                           </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="steps section container">
                <div class="stepsBg">
                    <h2 class="section__title">How to order <br> from e-shopper</h2>
                    <div class="stepsCont grid">

                        <div class="stepsCard">
                            <div class="stepsCardNum">1</div>
                            <h3 class="stepsCardTitle">Choose Product</h3>
                            <p class="stepsCard-desc">we have many products to choose from.</p>
                        </div>
                        <div class="stepsCard">
                            <div class="stepsCardNum">2</div>
                            <h3 class="stepsCardTitle">Place order</h3>
                            <p class="stepsCard-desc">check the product and its amount before shipping.</p>
                        </div>
                        <div class="stepsCard">
                            <div class="stepsCardNum">3</div>
                            <h3 class="stepsCardTitle">get delivery</h3>
                            <p class="stepsCard-desc">You will recieve the order directly to your home.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="newsletter section">
                <div class="newsCont container">
                    <h2 class="section__title">Our Newsletter</h2>
                    <p class="newsDesc">
                        Promotion new products and sales. Dirctly to your inbox
                    </p>
                    <form action="" class="newsForm">
                        <input type="text" placeholder="Enter your email" class="newsInput">
                        <button class="btn">Subscribe</button>
                    </form>
                </div>
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
<?php
// Handling login functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['c_login'])) {
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];
    $sel_customer = "SELECT * FROM customers WHERE customer_email='$customer_email' AND customer_pass='$customer_pass'";
    $run_customer = mysqli_query($con, $sel_customer);
    $check_customer=mysqli_num_rows($run_customer);
    $get_ip= getIPAddress();
    $sel_cart="select * from cart where ip_add='$get_ip'";
    $run_cart=mysqli_query($con,$sel_cart);
    $check_cart=mysqli_num_rows($run_cart);
    if($check_customer==0){
        echo "<script>alert('password or email incorrect')</script>";
        exit();
    }
    if($check_customer==1 AND $check_cart==0){
        $_SESSION['customer_email']=$customer_email;
        echo "<script>window.open('welcome.php','_self')</script>";
    }
    else{
        $_SESSION['customer_email']=$customer_email;
        echo "<script>window.open('payment_options.php','_self')</script>";
    }

}
?>