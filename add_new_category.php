<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    //add new catagory 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            if (!empty($_POST['cat_name'])) {
                $cat_name = $_POST['cat_name'];
                $user_id = $_SESSION['user_data']['user_id'];

                // if condition if slug value is not defined

                if (empty($_POST['cat_slug'])) {
                    $cat_slug = str_replace(' ', '_', $cat_name);
                } else {
                    $cat_slug = $_GET['cat_slug'];
                }
                include 'db.config.php';
                $add_query = "INSERT INTO `category_table` ( `category_name`, `category_slug`,`user_id`) VALUES ('$cat_name','$cat_slug','$user_id')";
                mysqli_query($conn, $add_query);

                header("location:dashbord.php");
            }
        }
    



?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Table - Brand</title>
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
?>