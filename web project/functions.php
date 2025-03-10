<?php
//database connection
$db=mysqli_connect("localhost","root","","ecommerce");

//to get ip address
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
    //whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

//getting products to display randomly
function getPro(){
    global $db;
    if(!isset($_GET['cat'])) {
          if(!isset($_GET['brand'])){
     
                            $get_products="select * from products order by rand() LIMIT 0,6";
                            $run_products=mysqli_query($db,$get_products);
                            while($row_products=mysqli_fetch_array($run_products)){
                                $pro_id=$row_products['product_id'];
                                $pro_title=$row_products['product_title'];
                                $pro_cat=$row_products['cat_id'];
                                $pro_brand=$row_products['brand_id'];
                                $pro_desc=$row_products['product_desc'];
                                $pro_price=$row_products['product_price'];
                                $pro_image=$row_products['product_img1'];
                            
                            echo "  
                        <div class='shop__content'>
                            <div class='shop__tag'>Sale</div>
                            <img src='images/$pro_image' class='shop__img' width='200' height='200'>
                            <h3 class='shop__title'>$pro_title</h3>
                            <span class='shop__subtitle'><a href='details.php?pro_id=$pro_id'>Details</a></span>
                            <div class='shop__prices'>
                                <span class='shop__price'>$$pro_price</span>
                            </div>
                            <a href='shop.php?add_cart=$pro_id' class='btn shop__button'>
                                <i class='bx bx-cart-alt shop__icon'></i>
                            </a>
                             
                        </div>";
                            }
            }
        }

}
//getting products to display by category
function getCatPro(){
    global $db;
    if(isset($_GET['cat'])) {

        $cat_id=$_GET['cat'];
          
     
                            $get_cat_pro="select * from products where cat_id='$cat_id'";
                            $run_cat_pro=mysqli_query($db,$get_cat_pro);
                            $count=mysqli_num_rows($run_cat_pro);
                            if($count==0){
                                echo "<h3>No products found in this category!</h3>";
                            }

                            while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
                                $pro_id=$row_cat_pro['product_id'];
                                $pro_title=$row_cat_pro['product_title'];
                                $pro_cat=$row_cat_pro['cat_id'];
                                $pro_brand=$row_cat_pro['brand_id'];
                                $pro_desc=$row_cat_pro['product_desc'];
                                $pro_price=$row_cat_pro['product_price'];
                                $pro_image=$row_cat_pro['product_img1'];
                            
                            echo "  
                        <div class='shop__content'>
                            <div class='shop__tag'>Sale</div>
                            <img src='images/$pro_image' class='shop__img' width='200' height='200'>
                            <h3 class='shop__title'>$pro_title</h3>
                            <span class='shop__subtitle'><a href='details.php?pro_id=$pro_id'>Details</a></span>
                            <div class='shop__prices'>
                                <span class='shop__price'>$$pro_price</span>
                            </div>
                            <a href='shop.php?add_cart=$pro_id' class='btn shop__button'>
                                <i class='bx bx-cart-alt shop__icon'></i>
                            </a>
                             
                        </div>";
                            }
            
    }

}
//getting products to display by brands
function getBrandPro(){
    global $db;
    if(isset($_GET['brand'])) {

        $brand_id=$_GET['brand'];
          
     
                            $get_brand_pro="select * from products where brand_id='$brand_id'";
                            $run_brand_pro=mysqli_query($db,$get_brand_pro);
                            $count=mysqli_num_rows($run_brand_pro);
                            if($count==0){
                                echo "<h3>No products found in this brand!</h3>";
                            }

                            while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
                                $pro_id=$row_brand_pro['product_id'];
                                $pro_title=$row_brand_pro['product_title'];
                                $pro_cat=$row_brand_pro['cat_id'];
                                $pro_brand=$row_brand_pro['brand_id'];
                                $pro_desc=$row_brand_pro['product_desc'];
                                $pro_price=$row_brand_pro['product_price'];
                                $pro_image=$row_brand_pro['product_img1'];
                            
                            echo "  
                        <div class='shop__content'>
                            <div class='shop__tag'>Sale</div>
                            <img src='images/$pro_image' class='shop__img' width='200' height='200'>
                            <h3 class='shop__title'>$pro_title</h3>
                            <span class='shop__subtitle'><a href='details.php?pro_id=$pro_id'>Details</a></span>
                            <div class='shop__prices'>
                                <span class='shop__price'>$$pro_price</span>
                            </div>
                            <a href='shop.php?add_cart=$pro_id' class='btn shop__button'>
                                <i class='bx bx-cart-alt shop__icon'></i>
                            </a>
                             
                        </div>";
                            }
            
    }

}
//getting brands to display
function getBrands(){
    global $db;
    $get_brands="select * from brands";
                                $run_brands=mysqli_query($db,$get_brands);
                                while($row_brands=mysqli_fetch_array($run_brands)){
                                    $brand_id=$row_brands['brand_id'];
                                    $brand_title=$row_brands['brand_title'];
                                    echo "<li><a href='shop.php?brand=$brand_id'>$brand_title</a></li>";
                                }
}
//getting categories to display
function getCats(){
    global $db;
    $get_cats="select * from categories";
    $run_cats=mysqli_query($db,$get_cats);
    while($row_cats=mysqli_fetch_array($run_cats)){
        $cat_id=$row_cats['cat_id'];
        $cat_title=$row_cats['cat_title'];
        echo "<li><a href='shop.php?cat=$cat_id'>$cat_title</a></li>";
    }
}
//add to cart
function cart(){
    global $db;
    if(isset($_GET['add_cart'])){
        $ip_add=getIPAddress();
        $p_id=$_GET['add_cart'];
        $check_pro="select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check=mysqli_query($db,$check_pro);
        if(mysqli_num_rows($run_check)>0){
            echo "";
        }
        else{
            $q="insert into cart (p_id,ip_add) values ('$p_id','$ip_add')";
            $run_q=mysqli_query($db,$q);
            echo "<script>window.open('shop.php','_self')</script>";
        }
    }
}
//getting number of items from cart
function items(){

    if(isset($_GET['add_cart'])){
    global $db;
    $ip_add=getIPAddress();
    $get_items="select * from cart where ip_add='$ip_add'";
    $run_items=mysqli_query($db,$get_items);
    $count_items=mysqli_num_rows($run_items);
    }
    else{
        global $db;
        $get_items="select * from cart where ip_add='$ip_add'";
    $run_items=mysqli_query($db,$get_items);
    $count_items=mysqli_num_rows($run_items);
    }
    echo $count_items;
}
//getting total price of the items
function total_price(){
    global $db;
    $ip_add=getIPAddress();
    $total=0;
    $sel_price="select * from cart where ip_add='::1'";
    $run_price=mysqli_query($db, $sel_price); 
    while($record=mysqli_fetch_array($run_price)){
        $pro_id=$record['p_id'];
        $pro_price="select * from products where product_id='::1'";
        $run_pro_price=mysqli_query($db,$pro_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            $product_price=array($p_price['product_price']);
            $values=array_sum($product_price);
            $total+=$values;
        }
    }
    echo "$".$total;
}
?>