<?php
session_start();
include 'db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    // check edit request 
    // if (!isset($_GET['cat_update'])) {
    //     header("location:dashbord.php");
    // } else {
       
        $query = "SELECT * FROM products_tables where product_id =".$_GET['product_update_id'];

        $update_product =  mysqli_fetch_assoc( mysqli_query($conn, $query));


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // update the category details 
          
                $update_id = $_POST["cat_update_id"];
                $update_name = $_POST["cat_update_name"];
                $update_slug = $_POST["cat_update_slug"];
                $update_status = $_POST["cat_update_status"];
               
                $update_time = date('m/d/Y h:i:s ', time());
                

                // echo $update_id,$update_name,$update_slug,$update_status,$update_time,$update_user_id;
                $update_query = " UPDATE `category_table` SET `category_name`='$update_name',`category_slug`='$update_slug',`status`='$update_status',`updated_on`=CURRENT_TIMESTAMP() WHERE id = '$update_id'";
                mysqli_query($conn, $update_query);
                $_SESSION['crud_msg'] = "your category has been updated...!!";
                header('location:dashbord.php');
            
        }



?>

        <head><title>update</title></head>

        <body id="page-top">
           <?php include 'header.php'?>
                        <div class="container">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <fieldset>

                   
                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                        <div class="col-md-4">
                            <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text" value="<?= $update_product['product_name']?>">

                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_slug">PRODUCT SLUG</label>
                        <div class="col-md-4">
                            <input id="product_slug" name="product_slug" placeholder="PRODUCT SLUG" class="form-control input-md"  type="text"  value="<?= $update_product['product_slug']?>">

                        </div>
                    </div>



                    <!-- Select Basic -->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_category">PRODUCT CATEGORY</label>
                        <div class="col-md-4">
                            <select id="product_category" name="product_category" class="form-control"  value="<?= $update_product['category']?>">
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
                            <input id="price" name="price" placeholder="price" class="form-control input-md" required="" type="text"  value="<?= $update_product['product_price']?>">

                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group row">
                        <label class="col-md-4 control-label" for="price_discount">Discount Price</label>
                        <div class="col-md-4">
                            <input id="price_discount" name="price_discount" placeholder="DISCOUNT" class="form-control input-md" required="" type="text"  value="<?= $update_product['product_price_discount']?>">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="available_quantity">QUANTITY</label>
                        <div class="col-md-4">
                            <input id="available_quantity" name="quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text"  value="<?= $update_product['quantity']?>">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_weight">PRODUCT WEIGHT</label>
                        <div class="col-md-4">
                            <input id="product_weight" name="product_weight" placeholder="PRODUCT WEIGHT" class="form-control input-md" required="" type="text"  value="<?= $update_product['product_weight']?>">

                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_height">PRODUCT HEIGHT</label>
                        <div class="col-md-4">
                            <input id="product_height" name="product_height" placeholder="PRODUCT HEIGHT" class="form-control input-md" required="" type="text"  value="<?= $update_product['product_height']?>">

                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group row ">
                        <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
                        <div class="col-md-8 ">
                            
                            <textarea  class="form-control" id="product_description" name="product_description"  style="height: 150px;"><?= $update_product['description']?></textarea>
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
                    <?php include 'footer.php'?>
        </body>

        </html>

<?php }
?>