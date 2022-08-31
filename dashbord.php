<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    $aleart_msg = [];


    include 'db.config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        

        // delete a category 
        if (isset($_POST['delete_category'])) {
            $id  = $_POST['cat_delete'];
            $delete_query = "DELETE FROM `category_table` WHERE id='$id'";
            mysqli_query($conn, $delete_query);
            $aleart_msg[] = "your category is deleted";
        }

        
    }

    //  for contact us messages 
    $messages = [];
    $msg_query = mysqli_query($conn, "SELECT * FROM messages ");
    while ($msg_result = mysqli_fetch_assoc($msg_query)) {
        $messages[] = $msg_result;
    }
    $messages = array_reverse($messages);


    //Get catgory details
    $result = mysqli_query($conn, "select * from category_table");
    $user_query = mysqli_query($conn, "SELECT * FROM USERS ");

    $users = [];
    while ($user =  mysqli_fetch_assoc($user_query)) {
        $users[] = $user;
    }

    $category_data = [];
    while ($data =  mysqli_fetch_assoc($result)) {
        $category_data[] = $data;
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Dashboard</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    </head>

    <body id="page-top">
    <?php foreach($aleart_msg as $errmsg) {
        echo '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>message: </strong> ' . $errmsg . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    ?>


        <div id="wrapper">
            <?php include 'sidenavbar.php' ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <?php include 'topnavbar.php' ?>
                    
                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Dashboard</h3>
                            <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
                        </div>


                        <div class="container-fluid">

                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">Category Info</p>
                                </div>
                                
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>

                                                    <th scope="col">Id</th>
                                                    <th scope="col">Category Name </th>
                                                    <th scope="col">Category Slug</th>
                                                    <th scope="col">Created on</th>
                                                    <th scope="col">Updated on</th>
                                                    <th scope="col">created by</th>
                                                    <th scope="col">Status</th>
                                                    <!-- <th scope="col">User Id</th> -->
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0;
                                                foreach ($category_data as $data) {
                                                    $i += 1 ?>
                                                    <tr>

                                                        <td class="counterCell"><?= $i ?></td>
                                                        <td><?php echo $data['category_name']; ?></td>
                                                        <td><?php echo $data['category_slug']; ?></td>
                                                        <td><?php echo $data['created_on']; ?></td>
                                                        <td><?php echo $data['updated_on']; ?></td>
                                                        <td><?php foreach ($users as $user) {
                                                                if ($user['user_id'] == $data['user_id']) {
                                                                    echo $user['first_name'];
                                                                }
                                                            } ?></td>
                                                        <td><?php if ($data['status'] == 1) {
                                                                echo "active";
                                                            } else {
                                                                echo "deactive";
                                                            } ?></td>

                                                        <td>
                                                            <div class="row">
                                                                <!-- Button trigger modal for update form-->
                                                                <form id="form" action="update.php" method="GET">
                                                                    <input type="hidden" name="cat_update_id" value="<?php echo $data['id']; ?>">
                                                                    <input type="hidden" name="cat_update_name" value="<?php echo $data['category_name']; ?>">
                                                                    <input type="hidden" name="cat_update_slug" value="<?php echo $data['category_slug']; ?>">
                                                                    <button type="submit" class="btn-sm btn-primary " name="cat_update" data-toggle="modal" data-target="#cat_update_Modal"> edit</button>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <input type="hidden" name="cat_delete" value="<?= $data['id']; ?>">
                                                                    <button type="submit" class="btn-sm btn-primary mx-1" name='delete_category'>Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                        <!-- new category add form start here  -->


                                        <!-- Modal -->

                                        <div class="modal fade" id="add_cat_Modal" tabindex="-1" aria-labelledby="add_cat_ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="add_cat_ModalLabel">Add catgory</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <div class="form-group">
                                                                <label for="category_name">category name</label>
                                                                <input type="text" name="cat_name" class="form-control" id="exampleInputEmail1" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="category_slug">category slug</label>
                                                                <input type="text" name="cat_slug" class="form-control" id="exampleInputEmail1" value="">
                                                            </div>
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="cat_status" value="">
                                                                <label class="form-check-label" for="exampleCheck1">Check me if category status is true</label>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary" name="add_new_category">Submit</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- new category add form end  here  -->

                                    </div>

                                </div>
                            </div>
                        </div>
                        <footer class="bg-white sticky-footer">
                            <div class="container my-auto">
                                <div class="text-center my-auto copyright"><span>Copyright © Manish singh 2022</span></div>
                            </div>
                        </footer>
                    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                </div>
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                <script src="assets/js/chart.min.js"></script>
                <script src="assets/js/bs-init.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
                <script src="assets/js/theme.js"></script>
    </body>

    </html>

<?php } ?>