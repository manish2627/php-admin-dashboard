<?php
session_start();
include '../db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("../location:login.php");
} else {
    // check edit request 
    // if (!isset($_GET['cat_update'])) {
    //     header("location:dashbord.php");
    // } else {

    $query = "SELECT * FROM users where user_id =" . $_GET['user_id'];

    $update_product =  mysqli_fetch_assoc(mysqli_query($conn, $query));
   
   


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // update the category details 
        $product_id = $_GET['product_update_id'];
        $product_name = $_POST['product_name'];
        $product_slug = $_POST['product_slug'];
        $product_category = $_POST['product_category'];
        $product_price = $_POST['price'];
        $product_price_discount = $_POST['price_discount'];
        $product_height = $_POST['product_height'];
        $product_weight = $_POST['product_weight'];
        $product_quantity = $_POST['quantity'];
        $product_desc = $_POST['product_description'];  
        
        $images = explode(",",$update_product['product_images']);
        foreach($_FILES['new_image']['tmp_name'] as $key=>$val){
            $filename = $_FILES['new_image']['name'][$key];
            $tempname = $_FILES['new_image']['tmp_name'][$key];
            $folder = "assets/img/product_images/" . $_FILES['new_image']['name'][$key];
            $new_images[] = $filename;
            move_uploaded_file($tempname, $folder);
        }
           
        $images = array_merge($images, $new_images);
           
        $images = implode(",",$images);
            
            

        // echo $update_id,$update_name,$update_slug,$update_status,$update_time,$update_user_id;
        $update_query = " UPDATE `products_tables` SET  `product_name`='$product_name',`product_slug`='$product_slug',`category`='$product_category',`product_price`='$product_price',`product_price_discount`='$product_price_discount',`product_weight`='$product_weight',`product_height`='$product_height',`quantity`='$product_quantity',`description`='$product_desc',`product_images`='$images'WHERE `product_id`='$product_id'";
        mysqli_query($conn, $update_query);
        $_SESSION['crud_msg'] = "your product details updated...!!";
        header('location:all_products.php');
    }



?>

    <head>
        <title>update</title>
    </head>

    <body id="page-top">
        <?php include '../header.php' ?>
        <div class="container">
           
        </div>

        </div>
        <?php include '../footer.php' ?>
    </body>

    </html>

<?php }
?>