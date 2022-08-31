<?php
session_start();
include 'db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    // check edit request 
    if (!isset($_GET['cat_update'])) {
        header("location:dashbord.php");
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // update the category details 
          
                $update_id = $_POST["cat_update_id"];
                $update_name = $_POST["cat_update_name"];
                $update_slug = $_POST["cat_update_slug"];
                $update_status = $_POST["cat_update_status"];
               
                $update_time = date('m/d/Y h:i:s ', time());
                $update_user_id = $_SESSION['user_data']['user'];

                // echo $update_id,$update_name,$update_slug,$update_status,$update_time,$update_user_id;
                $update_query = " UPDATE `category_table` SET `category_name`='$update_name',`category_slug`='$update_slug',`status`='$update_status',`updated_on`=CURRENT_TIMESTAMP(),`user_id`='$update_user_id' WHERE id = '$update_id'";
                mysqli_query($conn, $update_query);
                header('location:dashbord.php');
            
        }



?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <title>update</title>
            <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
            <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        </head>

        <body id="page-top">
            <div id="wrapper">
                <?php include 'sidenavbar.php' ?>
                <div class="d-flex flex-column" id="content-wrapper">
                    <div id="content">
                        <?php include 'topnavbar.php' ?>
                        <div class="container">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <!-- <label for="category_id">category id</label> -->
                                    <input type="hidden" name="cat_update_id" class="form-control" id="exampleInputEmail1" value="<?= $_GET['cat_update_id'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="category_name">category name</label>
                                    <input type="text" name="cat_update_name" class="form-control" id="exampleInputEmail1" value="<?= $_GET['cat_update_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="category_slug">category slug</label>
                                    <input type="text" name="cat_update_slug" class="form-control" id="exampleInputEmail1" value="<?= $_GET['cat_update_slug'] ?>">
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
                    <footer class="bg-white sticky-footer">
                        <div class="container my-auto">
                            <div class="text-center my-auto copyright"><span>Copyright © Brand 2022</span></div>
                        </div>
                    </footer>
                </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            <script src="assets/js/bs-init.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
            <script src="assets/js/theme.js"></script>
        </body>

        </html>

<?php }
} ?>