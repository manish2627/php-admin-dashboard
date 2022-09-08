<?php
session_start();
include '../db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    //add new catagory 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            if (!empty($_POST['cat_name'])) {
                $cat_name = $_POST['cat_name'];
                $user_name = $_SESSION['username'];

                // if condition if slug value is not defined

                if (empty($_POST['cat_slug'])) {
                    $cat_slug = str_replace(' ', '-', $cat_name);
                } else {
                    $cat_slug = $_GET['cat_slug'];
                }
                include 'db.config.php';
                $add_query = "INSERT INTO `category_table` ( `category_name`, `category_slug`,`created_by`) VALUES ('$cat_name','$cat_slug','$user_name')";
                mysqli_query($conn, $add_query);

                header("location:".APP_URL."/category/all_category.php");
            }
        }
    



?>
    <!DOCTYPE html>
    <html>

    <head>
        
        <title>Add category</title>
        
    </head>

    <body id="page-top">
        <?php include '../header.php'?>
                    <div class="container">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="category_name">category name</label>
                                <input type="text" name="cat_name" class="form-control" id="exampleInputEmail1" value="">
                            </div>
                            <div class="form-group">
                                <label for="category_slug">category slug</label>
                                <input type="text" name="cat_slug" class="form-control" id="exampleInputEmail1" value="">
                            </div>



                            <button type="submit" class="btn btn-primary" name="add_new_category">Submit</button>
                        </form>

                    </div>

                </div>
               <?php include'../footer.php'?>
    </body>

    </html>

<?php }
?>