<?php

session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    if (!isset($_GET['search_btn'])) {
        header("location:dashbord.php");
    } else {
        include 'db.config.php';
        $user_query = mysqli_query($conn, "SELECT * FROM USERS ");
        $users = [];
        while ($user =  mysqli_fetch_assoc($user_query)) {
            $users[] = $user;
        }

        if (isset($_GET['search_btn'])) {

            $search = $_GET['search_input'];
            $search_result = mysqli_query(
                $conn,
                " SELECT * FROM `category_table` WHERE category_name like '%" . $search . "%' OR category_slug LIKE '%" . $search . "%'"
            );
            $search_data = [];
            while ($data =  mysqli_fetch_assoc($search_result)) {
                $search_data[] = $data;
            }
            $search_count = mysqli_num_rows($search_result);
        }


?>


        <!DOCTYPE html>

        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <title>Profile - Brand</title>
            <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
            <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        </head>

        <body id="page-top">
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
                                        <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
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
                                        <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge badge-danger badge-counter">7</span><i class="fas fa-envelope fa-fw"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-list animated--grow-in">
                                                <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                                    <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                                        <div class="bg-success status-indicator"></div>
                                                    </div>
                                                    <div class="font-weight-bold">
                                                        <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                                                        <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                                    </div>
                                                </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                    <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                                                        <div class="status-indicator"></div>
                                                    </div>
                                                    <div class="font-weight-bold">
                                                        <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                                                        <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                                    </div>
                                                </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                    <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                                                        <div class="bg-warning status-indicator"></div>
                                                    </div>
                                                    <div class="font-weight-bold">
                                                        <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                                                        <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                                    </div>
                                                </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                    <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                                                        <div class="bg-success status-indicator"></div>
                                                    </div>
                                                    <div class="font-weight-bold">
                                                        <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                                                        <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                                    </div>
                                                </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                            </div>
                                        </div>
                                        <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                                    </li>
                                    <div class="d-none d-sm-block topbar-divider"></div>
                                    <li class="nav-item dropdown no-arrow">
                                        <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?= $_SESSION['user_data']['first name']; ?></span><img class="border rounded-circle img-profile" src="assets/img/profile/<?= $_SESSION['user_data']['profile_pic'] ?>"></a>
                                            <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                                <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="container-fluid">
                            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                <h3 class="text-dark mb-0">Search results: </h3>
                                <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
                            </div>


                            <div class="container-fluid">

                                <div class="card shadow">
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                        <?php if ($search_count <= 0) {
                                            echo "nothing here ";
                                        } else { ?>
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
                                                    foreach ($search_data as $data) {
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
                                                                        <button type="submit" class="btn-sm btn-primary mx-1" name='form_submit'>Delete</button>
                                                                    </form>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    <?php } ?>
                                                </tbody>

                                            </table>
                                        <?php } ?>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="bg-white sticky-footer">
                        <div class="container my-auto">
                            <div class="text-center my-auto copyright"><span>Copyright © Manish Singh 2022</span></div>
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