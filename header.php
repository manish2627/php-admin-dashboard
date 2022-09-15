<?php 



// $nav_menu = [
//     'category' => ['All Ctegory' =>  APP_URL.'/category/all_category.php', 'Add new Category'=>APP_URL.'/category/add_new_category.php'],
//     'Products' => ['All Products'=> APP_URL.'/product/all_products.php', 'Add new Product '=>APP_URL.'/product/add_new_product.php'],
//     'Users' => ['All Users'=> APP_URL.'/blogs/all_user.php', 'Add new Users '=>APP_URL.'/product/add_new_user.php'],
//     'Blogs' => ['All Blogs'=> APP_URL.'/blogs/all_blogs.php', 'Add new Blog '=>APP_URL.'/blogs/add_new_blog.php'],
//     'Orders' => ['All Orders'=> APP_URL.'/all_order.php', 'Add new Order '=>APP_URL.'/add_new_order.php'],
// ];
$nav_menu = [
    [
       'menu_name'=>'Category',
       'sub_menu' => [
           ['submenu_name' => 'All Category','url' => APP_URL.'/category/all_category.php'],
           ['submenu_name' => 'Add new Category','url' =>APP_URL.'/category/add_new_category.php']
       ]
   ],
    [
       'menu_name'=>'Products',
       'sub_menu' => [
           ['submenu_name' => 'All Products','url' => APP_URL.'/product/all_products.php'],
           ['submenu_name' => 'Add new Product','url' => APP_URL.'/product/add_new_product.php']
       ]
   ],
    [
       'menu_name'=>'Users',
       'sub_menu' => [
           ['submenu_name' => 'All Users','url' => APP_URL.'/users/all_users.php'],
           ['submenu_name' => 'Add new Users','url' => APP_URL.'/users/add_new_user.php']
       ]
   ],
   [
       'menu_name'=>'Blogs',
       'sub_menu' => [
           ['submenu_name' => 'All Blogs','url' => APP_URL.'/blogs/all_blogs.php'],
           ['submenu_name' => 'Add new Blog','url' => APP_URL.'/blogs/add_new_blog.php']
       ]
   ],
    [
       'menu_name'=>'Orders',
       'sub_menu' => [
           ['submenu_name' => 'All Orders','url' => APP_URL.'/orders/all_orders.php'],
        //    ['submenu_name' => 'Add new Order','url' => 'add_new_order.php']
       ]
   ],
   
];




?>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Dashboard</title>


        <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
        <link rel="stylesheet" href="<?= APP_URL; ?>/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="<?= APP_URL; ?>/assets/fonts/fontawesome-all.min.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <!-- Custom styles for this template-->
        <link href="<?= APP_URL; ?>/assets/css/styles.css" rel="stylesheet">
        <link href="<?= APP_URL; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    </head>

<body>
<div id="wrapper">
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">

<div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
    </a>
    <hr class="sidebar-divider my-0">

    <ul class="navbar-nav text-light" id="accordionSidebar">
        <li class="nav-item"><a class="nav-link active" href="<?= APP_URL; ?>/dashbord.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

         <!-- Nav Item - Pages Collapse Menu -->
         <?php foreach($nav_menu as $nav_item){ ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo<?=$nav_item['menu_name']?>" aria-expanded="true" aria-controls="collapseTwo<?=$nav_item['menu_name']?>">
                <!-- <i class="fas fa-fw fa"></i> -->
                <span><?=$nav_item['menu_name']?></span>
            </a>
            <div id="collapseTwo<?=$nav_item['menu_name']?>" class="collapse" aria-labelledby="headingTwo<?=$nav_item['menu_name']?>" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                   <?php foreach($nav_item['sub_menu'] as $sub_menu){?>
                    <a class="collapse-item" href="<?=$sub_menu['url']?>"><?=$sub_menu['submenu_name']?></a>
                    <?php }?>
                </div>
            </div>
        </li>
        <?php }?>

        <!-- Nav Item - Utilities Collapse Menu -->
        <!-- <li class="nav-item"><a class="nav-link" href="table.php"><i class="fas fa-table"></i><span>Table</span></a></li> -->
        <!-- <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li> -->
        <!-- <li class="nav-item"><a class="nav-link" href="contactus.php"><i class="fas fa-address-book"></i><span>Contact Us</span></a></li> -->

    </ul>
    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
</div>
</nav>
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
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="assets/img/profile/image3.jpeg" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="assets/img/profile/image2.jpeg" alt="...">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="assets/img/profile/image3.jpeg" alt="...">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="...." alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li>
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?= $_SESSION['username'] ?></span><img class="border rounded-circle img-profile" src="<?= APP_URL; ?>/assets/img/profile/<?= $profile_pic = mysqli_fetch_assoc($query = mysqli_query($conn, "SELECT profile_pic FROM users WHERE `user_id` = " . $_SESSION['user_id']))['profile_pic']; ?>"></a>
                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="<?= APP_URL?>/profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="<?= APP_URL; ?>/logout.php">Logout</a>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</nav>


</body>