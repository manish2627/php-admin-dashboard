<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    $aleart_msg = [];


    include 'db.config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //add new catagory 
        if (isset($_POST['add_new_category'])) {
            if (empty($_POST['cat_status'])) {
                $status = 0;
            } else {
                $status = 1;
            }


            if (!empty($_POST['cat_name'])) {
                $cat_name = $_POST['cat_name'];
                $user_id = $_SESSION['user_data']['user'];

                // if condition if slug value is not defined

                if (empty($_POST['cat_slug'])) {
                    $cat_slug = str_replace(' ', '_', $cat_name);
                } else {
                    $cat_slug = $_GET['cat_slug'];
                }

                $add_query = "INSERT INTO `category_table` ( `category_name`, `category_slug`,`status`,`user_id`) VALUES ('$cat_name','$cat_slug','$status','$user_id')";
                mysqli_query($conn, $add_query);
                $aleart_msg[] = "your category is added";
            }
        }

        // delete a category 
        if (isset($_POST['delete_category'])) {
            $id  = $_POST['cat_delete'];
            $delete_query = "DELETE FROM `category_table` WHERE id='$id'";
            mysqli_query($conn, $delete_query);
            $aleart_msg[] = "your category is deleted";
        }

        // update the category details 
        if (isset($_POST['update'])) {
            $update_id = $_POST["cat_update_id"];
            $update_name = $_POST["cat_update_name"];
            $update_slug = $_POST["cat_update_slug"];
            if (!empty($_POST['cat_update_status'])) {
                $update_status = 1;
            } else {
                $update_status = 0;
            }
            $update_time = date('m/d/Y h:i:s ', time());
            $update_user_id = $_SESSION['user_data']['user'];
    
            // echo $update_id,$update_name,$update_slug,$update_status,$update_time,$update_user_id;
            $update_query = " UPDATE `category_table` SET `category_name`='$update_name',`category_slug`='$update_slug',`status`='$update_status',`updated_on`=CURRENT_TIMESTAMP(),`user_id`='$update_user_id' WHERE id = '$update_id'";
            mysqli_query($conn, $update_query);
            $aleart_msg[] = "your category is updated";
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
        <title>Dashboard - Brand</title>
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
            <?php include 'nav.php' ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                            <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                    <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                </div>
                            </form>
                            <ul class="navbar-nav flex-nowrap ml-auto">
                                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                        <form class="form-inline mr-auto navbar-search w-100">
                                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                                <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge badge-danger badge-counter"></span><i class="fas fa-bell fa-fw"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-list animated--grow-in">
                                            <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="mr-3">
                                                    <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                                </div>
                                                <div><span class="small text-gray-500">December 12, 2019</span>
                                                    <p>A new monthly report is ready to download!</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="mr-3">
                                                    <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                                </div>
                                                <div><span class="small text-gray-500">December 7, 2019</span>
                                                    <p>$290.29 has been deposited into your account!</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="mr-3">
                                                    <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                                </div>
                                                <div><span class="small text-gray-500">December 2, 2019</span>
                                                    <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                                </div>
                                            </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge badge-danger badge-counter"></span><i class="fas fa-envelope fa-fw"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-list animated--grow-in">
                                            <h6 class="dropdown-header">messageses</h6>


                                            <!-- messages aleart tamplate start here   -->

                                            <?php $i = 0;
                                            foreach ($messages as $message) {
                                                $i++ ?>
                                                <a class="dropdown-item d-flex align-items-center" href="message.php">
                                                    <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                                        <div class="bg-success status-indicator"></div>
                                                    </div>
                                                    <div class="font-weight-bold">
                                                        <div class="text-truncate"><span><?= $message['massage'] ?></span></div>
                                                        <p class="small text-gray-500 mb-0"><?= $message['name'] ?></p>
                                                    </div>
                                                </a>
                                            <?php if ($i == 4) {
                                                    break;
                                                }
                                            } ?>

                                            <a class="dropdown-item text-center small text-gray-500" href="message.php">Show All Alerts</a>
                                            <!-- messages aleart tamplate ends  here   -->


                                        </div>
                                    </div>
                                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                                </li>
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?= $_SESSION['user_data']['first name'] ?></span><img class="border rounded-circle img-profile" src="assets/img/profile/<?= $_SESSION['user_data']['profile_pic'] ?>"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php">Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
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
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-nowrap">
                                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_cat_Modal" name="add">
                                                    Add new category
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="text-md-right dataTables_filter" id="dataTable_filter"><label>
                                                    <form method="" action="search.php">
                                                        <input name="search_input" type="search">
                                                        <button class="btn-sm btn-primary mx-1" type="submit" name="search_btn">search</button>
                                                    </form>
                                                </label>
                                            </div>
                                            <? if (isset($_GET['search_btn']) && !empty($_GET['search_input'])) {
                                                header("location:search.php");
                                            }; ?>
                                        </div>
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
                                                                if ($user['user'] == $data['user_id']) {
                                                                    echo $user['first name'];
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