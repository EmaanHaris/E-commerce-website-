<?php
include("db.php");
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
        <link rel="stylesheet" href="color-1.css">
        
        
        <title>e-commerce website</title>
    </head>
    <body>
       <div id="insert">
            <form method="post" action="insert_product.php" enctype="multipart/form-data">
            <table width="700" align="center">
                <tr>
                    <td><h2>Insert New Product:</h2></td>
                </tr>
                <tr>
                    <td><input type="text" name="product_title" placeholder="Enter product title"></td>
                </tr>
                <tr>
                    <td><select name="product_cat">
                        <option>select category</option>
                        <?php
                                $get_cats="select * from categories";
                                $run_cats=mysqli_query($con,$get_cats);
                                while($row_cats=mysqli_fetch_array($run_cats)){
                                    $cat_id=$row_cats['cat_id'];
                                    $cat_title=$row_cats['cat_title'];
                                    echo "<option value='$cat_id'>$cat_title</option>";
                                }
                        ?>
                    </select></td>
                </tr>
                <tr>
                <td><select name="product_brand">
                        <option>select brand</option>
                        <?php
                                $get_brands="select * from brands";
                                $run_brands=mysqli_query($con,$get_brands);
                                while($row_brands=mysqli_fetch_array($run_brands)){
                                    $brand_id=$row_brands['brand_id'];
                                    $brand_title=$row_brands['brand_title'];
                                    echo "<option value='$brand_id'>$brand_title</option>";
                                }
                         ?>
                    </select></td>
                </tr>
                <tr>
                    <td><input type="file" name="product_img1" ></td>
                </tr>
                <tr>
                    <td><input type="file" name="product_img2"></td>
                </tr>
                <tr>
                    <td><input type="file" name="product_img3"></td>
                </tr>
                <tr>
                    <td><input type="text" name="product_price" placeholder="Enter price"></td>
                </tr>
                <tr>
                    <td><input type="text" name="product_desc" placeholder="Enter product description"></td>
                </tr>
                <tr>
                    <td><input type="text" name="product_keywords" placeholder="Enter product keywords"></td>
                </tr>
            </table>
            <button type="submit" name="insert_product" value="Insert Product">submit</button>
          </form>
       </div> 
    </body>
</html>
<?php
//text data
  if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $product_cat=$_POST['product_cat'];
    $product_brand=$_POST['product_brand'];
    $product_price=$_POST['product_price'];
    $product_desc=$_POST['product_desc'];
    $status='on';
    $product_keywords=$_POST['product_keywords'];

    //img
    $product_img1=$_FILES['product_img1']['name'];
    $product_img2=$_FILES['product_img2']['name'];
    $product_img3=$_FILES['product_img3']['name'];

    //img temp name
    $temp_name1=$_FILES['product_img1']['tmp_name'];
    $temp_name2=$_FILES['product_img2']['tmp_name'];
    $temp_name3=$_FILES['product_img3']['tmp_name'];

    if($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_price==''OR $product_desc=='' OR $product_keywords=='' OR $product_img1==''){
        echo "<script>alert('please fill all fields!')</script>";
        exit();
    }
    else{
        //move uploaded images to its folder
        move_uploaded_file($temp_name1,"images/$product_img1");
        move_uploaded_file($temp_name2,"images/$product_img2");
        move_uploaded_file($temp_name3,"images/$product_img3");
    $insert_product="insert into products (cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,status) values ('$product_cat',' $product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc',' $status')";
    $run_product=mysqli_query($con,$insert_product);
    if($run_product){
        echo "<script>alert('product inserted successfully')</script>";
    }
    }
  }
?>