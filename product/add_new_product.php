<?php
session_start();
include '../db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:".APP_URL."/login.php");
} else {
    // include '../db.config.php';
    //add new product
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!empty($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
            $product_category = $_POST['product_category'];
            $product_price = $_POST['price'];
            $product_price_discount = $_POST['price_discount'];
            $product_height = $_POST['product_height'];
            $product_weight = $_POST['product_weight'];
            $product_quantity = $_POST['quantity'];
            $product_desc = $_POST['product_description'];
            $created_by = $_SESSION['username'];

            // if condition if slug value is not defined

            if (empty($_POST['product_slug'])) {
                $product_slug = str_replace(' ', '-', $product_name);
            } else {
                $product_slug = $_GET['product_slug'];
            }
            

            // upload product images 

          
            foreach($_FILES['image']['tmp_name'] as $key=>$val){
            $filename = $_FILES['image']['name'][$key];
            $tempname = $_FILES['image']['tmp_name'][$key];
            $folder = "../assets/img/product_images/".$_FILES['image']['name'][$key];
            $q_image = "INSERT INTO `products_images`( `product_name`, `category_name`, `image_path`, `image_name`) VALUES
                                                     ('$product_name','product_category','assest/img/product_images/','$filename')";  
            mysqli_query($conn, $q_image);     
            
            move_uploaded_file($tempname, $folder);
        
        }
            

          
            // echo $product_name,$product_slug,$product_category,$product_desc,$product_height,$product_weight,$product_price,$product_price_discount;
            // echo $images;
            $q= "INSERT INTO `products_tables` ( `product_name`, `product_slug`,`category`,`product_price`, `product_price_discount`, `product_weight`, `product_height`, `quantity`, `description`,  `created_by`)
                                 VALUES ('$product_name', '$product_slug','$product_category','$product_price','$product_price_discount', '$product_weight','$product_height','$product_quantity' ,'$product_desc','$created_by')";

            mysqli_query($conn, $q);
            header("location:".APP_URL."/product/all_products.php");
            header("location:all_products.php");
        }
    }




?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Add Product</title>

    </head>

    <body id="page-top">
        <?php include '../header.php' ?>
        <div class="container">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <fieldset>

                   
                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                        <div class="col-md-4">
                            <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text">

                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_slug">PRODUCT SLUG</label>
                        <div class="col-md-4">
                            <input id="product_slug" name="product_slug" placeholder="PRODUCT SLUG" class="form-control input-md"  type="text">

                        </div>
                    </div>



                    <!-- Select Basic -->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_category">PRODUCT CATEGORY</label>
                        <div class="col-md-4">
                            <select id="product_category" name="product_category" class="form-control">
                                <?php
                                $q = mysqli_query($conn, "select category_name from category_table");

                                $category = [];
                                while ($data =  mysqli_fetch_assoc($q)) {
                                    $category[] = $data['category_name'];
                                }


                                foreach ($category  as $category) { ?>
                                    <option value="<?= $category ?>"><?= $category ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                      <!-- Text input-->
                      <div class="form-group row">
                        <label class="col-md-4 control-label" for="price">Price</label>
                        <div class="col-md-4">
                            <input id="price" name="price" placeholder="price" class="form-control input-md" required="" type="text">

                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group row">
                        <label class="col-md-4 control-label" for="price_discount">Discount Price</label>
                        <div class="col-md-4">
                            <input id="price_discount" name="price_discount" placeholder="DISCOUNT" class="form-control input-md" required="" type="text">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="available_quantity">QUANTITY</label>
                        <div class="col-md-4">
                            <input id="available_quantity" name="quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_weight">PRODUCT WEIGHT</label>
                        <div class="col-md-4">
                            <input id="product_weight" name="product_weight" placeholder="PRODUCT WEIGHT" class="form-control input-md" required="" type="text">

                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_height">PRODUCT HEIGHT</label>
                        <div class="col-md-4">
                            <input id="product_height" name="product_height" placeholder="PRODUCT HEIGHT" class="form-control input-md" required="" type="text">

                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="product_description" name="product_description"></textarea>
                        </div>
                    </div>


                  

                    <!-- File Button -->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="filebutton">Images</label>
                        <div class="col-md-4">
                            <input id="file" name="image[]" class="input-file" type="file" multiple>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group row ">


                        <button id="singlebutton" type="submit" name="singlebutton" class="btn btn-primary">Add Product</button>

                    </div>

                </fieldset>
            </form>

        </div>

        </div>
        <?php include '../footer.php' ?>
    </body>

    </html>

<?php }
?>