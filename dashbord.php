<?php
session_start();
include 'db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    $aleart_msg = [];
   

    $user_query = mysqli_query($conn, "SELECT * FROM USERS ");

    $users = [];
    while ($user =  mysqli_fetch_assoc($user_query)) {
        $users[] = $user;
    }

   

    $orders =[];
    $result = mysqli_query($conn, "select * from orders");
    while ($data =  mysqli_fetch_assoc($result)) {
        $orders[] = $data;
    }
    $deleverd_orders =[];
    $result = mysqli_query($conn, "select * from orders where  `status`= 'diliverd'");
    while ($data =  mysqli_fetch_assoc($result)) {
        $cancel_orders[] = $data;
    }
    $processing_orders =[];
    $result = mysqli_query($conn, "select * from orders where `status`= 'proccessing'");
    while ($data =  mysqli_fetch_assoc($result)) {
        $processing_orders[] = $data;
    }
    $pendding_orders =[];
    $result = mysqli_query($conn, "select * from orders where  `status`= 'pendding'");
    while ($data =  mysqli_fetch_assoc($result)) {
        $pendding_orders[] = $data;
    }
   


   

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Dashboard</title>
    </head>

    <body id="page-top">

        <?php include 'header.php' ?>

        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Dashboard</h3>
                <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
            </div>
            <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Total orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($orders)?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                 Pending Order</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($pendding_orders)?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Proseccing Order</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($processing_orders)?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                               Delivered Order</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($deleverd_orders)?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
            <!-- Content Row -->
            <div class="row">
            
        </div>
          


            <?php include 'footer.php' ?>

    </body>

    </html>

<?php } ?>