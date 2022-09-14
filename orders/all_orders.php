<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {

    include '../db.config.php';
    
    
    // update the order status 
    if (isset($_POST['order_status_btn'])) {
        $status = $_POST['order_status'];
        $order_id = $_POST['order_update_id'];
       
        $order_update_q = "UPDATE `orders` SET `status`='$status' WHERE `order_id`=$order_id";
        mysqli_query($conn, $order_update_q);
    } 


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

    $product_q = mysqli_query($conn, "SELECT * FROM products_tables");
    $products = [];
    while ($product = mysqli_fetch_assoc($product_q)) {
        $products[] =  $product;
    }

    $q_orders = mysqli_query($conn, "SELECT * FROM orders");
    $orders = [];
    while ($order = mysqli_fetch_assoc($q_orders)) {
        $orders[] = $order;
    }




?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Orders </title>
    </head>

    <body id="page-top">

        <?php include '../header.php' ?>

        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Orders :</h3>
                <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
            </div>


            <div class="container-fluid">
                <?php
                if ($_SESSION['crud_msg']) {
                    echo '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>message: </strong> ' . $_SESSION['crud_msg'] . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
                    $_SESSION['crud_msg'] = false;
                }

                ?>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Products</p>
                    </div>

                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>

                                    <th scope="col">s.no</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Shiping Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Ammount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($orders as $order) {
                                    $i += 1 ?>
                                    <tr>

                                        <td class="counterCell"><?= $i ?></td>
                                        <td><?php $date = date_create($order['time']);
                                            echo date_format($date, DATE_COOKIE); ?></td>
                                        <td><?php echo $order['shipping_address']; ?></td>
                                        <td><?php echo $order['phone']; ?></td>
                                        <td><?php echo $order['method']; ?></td>
                                        <td><?php echo "Rs." . $order['ammount']; ?></td>
                                        <td><?php echo $order['status']; ?></td>

                                        <td>
                                            <div class="row">
                                                <!-- Button trigger modal for update form-->
                                                <form id="form" action="" method="POST">
                                                    <input type="hidden" name="order_update_id" value="<?php echo $order['order_id']; ?>">
                                                    <select class="form-select" name="order_status" aria-label="Default select example">
                                                        <option value="Pending">Pending</option>
                                                        <option value="Proccessing">proccessing</option>
                                                        <option value="Deliverd">Deliverd</option>
                                                        <option value="Cancel">Cancel</option>
                                                    </select>
                                                    <button type="submit" name="order_status_btn">er</button>
                                                </form>
                                            </div>
                                            
                                        </td>
                                        <td>

                                        </td>


                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
            <?php include '../footer.php' ?>


            < </body>

    </html>

<?php } ?>