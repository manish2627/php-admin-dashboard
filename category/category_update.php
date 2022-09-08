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
       
        $query = "SELECT * FROM category_table where id =".$_GET['cat_update_id'];

        $update_category =  mysqli_fetch_assoc( mysqli_query($conn, $query));


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
                header("location:".APP_URL."/category/all_category.php");
            
        }



?>


        <head>
            
            <title>update Product</title>
           
        </head>

        <body id="page-top">
           <?php include 'header.php'?>
                        <div class="container">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <!-- <label for="category_id">category id</label> -->
                                    <input type="hidden" name="cat_update_id" class="form-control" id="exampleInputEmail1" value="<?= $_GET['cat_update_id'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="category_name">category name</label>
                                    <input type="text" name="cat_update_name" class="form-control" id="exampleInputEmail1" value="<?= $update_category['category_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="category_slug">category slug</label>
                                    <input type="text" name="cat_update_slug" class="form-control" id="exampleInputEmail1"  value="<?= $update_category['category_slug'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="category_status">category status</label><br>
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="cat_update_status">

                                        <option value="1">active</option>
                                        <option value="0">deactive</option>

                                    </select>

                                </div>


                                <button type="submit" href class="btn btn-primary" name="update">Update</button>
                            </form>

                        </div>

                    </div>
                    <?php include 'footer.php'?>
        </body>

        </html>

<?php }
?>