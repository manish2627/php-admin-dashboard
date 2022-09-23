<?php
session_start();
include '../db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:".APP_URL."/login.php");
} else {

  

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

    $product_query = "SELECT * FROM products_tables";
  
    $filters = array_filter($_GET);
    // echo"<pre>";
    // print_r($filters);

    if (count($filters)) {
        $product_query .= " WHERE"; 
       
        
        // // if price fillter is use 
        // if(isset($filters['min_price']) && isset($filters['max_price']) ){
            
                $product_query .= " `product_price` BETWEEN ".$filters['min_price']." AND ".$filters['max_price']." ";
                unset($filters['min_price']) ;
                unset($filters['max_price']) ;
    
        // }


        $i = 0;
       
        foreach ($filters as $key => $value) {
            if (count($filters) > $i) { 
                $product_query .= " &&";
            }
            
            $product_query .= " $key = '$value'";  
            $i++;
           
           
        }
    }
    
    $product_query .= " ORDER BY `products_tables`.`created_on` ";

    $product_q = mysqli_query($conn, $product_query);
    $products = [];
    while ($product = mysqli_fetch_assoc($product_q)) {
        $products[] =  $product;
    }
    $category_data = [];
    $result = mysqli_query($conn, "select * from category_table");
    while ($data =  mysqli_fetch_assoc($result)) {
        $category_data[] = $data;
    }



?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

        <title>All products </title>
        <link rel="stylesheet" href="/path/to/jquery-ui.css">
<script src="/path/to/jquery.min.js"></script>
<script src="/path/to/jquery-ui.min.js"></script>
    </head>

    <body id="page-top">

        <?php include '../header.php' ?>

        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">All products :</h3>
                <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
            </div>


            <div class="container-fluid">
                <?php
                if (isset($_SESSION['crud_msg']) && !empty($_SESSION['crud_msg'])){
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


                    <!-- product search form start here -->
                    <form action="">
                        <div class="row mx-2">
                            <div class=" col-md-3">

                                <input type="text" class="form-control" name="product_name" placeholder="Prouct name">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="category" aria-label="Default select example" style="width:100% ;">
                                    <option value=""> All category </option>
                                    <?php foreach ($category_data as $category) { ?>
                                        <option><?= $category['category_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3 row">
                                <div class="col-md-6">
                                <select class="form-select" name="min_price" aria-label="Default select example" style="width:100% ;">
                                    <option selected value="01">MInimum Price  </option>

                                    <option value="5"> 5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>


                                </select>
                                </div>
                                <div class="col-md-6">
                                <select class="form-select" name="max_price" aria-label="Default select example" style="width:100% ;">
                                    <option selected value="100">MAx Price </option>

                                    
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="20">30</option>


                                </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    <!-- product search form ends here -->

                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>

                                    <th scope="col">s.no</th>
                                    <th scope="col">Images</th>
                                    <th scope="col">Product Name </th>
                                    <th scope="col">Product Slug</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Height</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">View</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $i = 0;
                                foreach ($products as $product) {
                                    $i += 1 ?>
                                    <tr>

                                        <td class="counterCell"><?= $i ?></td>
                                        <!-- all images of product  -->
                                        <td>
                                            <?php
                                            $product_name = $product['product_name'];
                                            $q_product_images = mysqli_query($conn, "SELECT `image_name` FROM `products_images` WHERE `product_name`='$product_name'");
                                            $images = [];
                                            while ($image = mysqli_fetch_assoc($q_product_images)) {
                                                $images[] = $image['image_name']; ?>

                                                <img class="d-block w-100 my-1 " style="height:50px ;" src="../assets/img/product_images/<?= $image['image_name'] ?>">



                                            <?php } ?>
                                        </td>
                                        <td><?php echo $product['product_name']; ?></td>
                                        <td><?php echo $product['product_slug']; ?></td>
                                        <td><?php echo $product['category']; ?></td>
                                        <td>Rs.<?php echo $product['product_price']; ?></td>
                                        <td>Rs.<?php echo $product['product_price_discount']; ?></td>
                                        <td><?php echo $product['product_weight']; ?></td>
                                        <td><?php echo $product['product_height']; ?></td>
                                        <td><?php echo $product['quantity']; ?></td>
                                        <td><?php echo substr($product['description'], 0, 60); ?></td>
                                        <td>
                                            <!-- for vew the product details  -->
                                            <form id="form" action="product_view.php" method="GET">
                                                <input type="hidden" name="product_update_id" value="<?php echo $product['product_id']; ?>">

                                                <button type="submit" class="btn-sm btn-primary " data-toggle="modal" data-target="#cat_update_Modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                                                        <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z" />
                                                    </svg></button>
                                            </form>
                                        </td>


                                        <td>
                                            <div class="row">
                                                <!-- Button trigger modal for update form-->
                                                <form id="form" action="product_update.php" method="GET">
                                                    <input type="hidden" name="product_update_id" value="<?php echo $product['product_id']; ?>">

                                                    <button type="submit" class="btn-sm btn-primary " data-toggle="modal" data-target="#cat_update_Modal"> edit</button>
                                                </form>

                                                <input type="hidden" name="product_delte_id" class="product_delete_id" value="<?php echo $product['product_id']; ?>">
                                                <a href="javascript:void(0)" name="product_delete_btn" class="btn-sm mx-1 btn-danger product_delete_btn">Delete</a>

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


            <script>
                $(document).ready(function() {
                    $('.product_delete_btn').click(function(e) {
                        e.preventDefault();
                        //  console.log("hello");
                        var delete_id = $(this).closest("tr").find('.product_delete_id').val();
                        // console.log(delete_id);

                        swal({
                                title: "Are you sure?",
                                text: "Once deleted, you will not be able to recover this category..!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $.ajax({
                                        type: "POST",
                                        url: "delete_product.php",
                                        data: {
                                            "delete_btn": 1,
                                            "id": delete_id
                                        },

                                        success: function(response) {
                                            swal("your category deleted successfully ", {
                                                icon: "success",

                                            }).then((result) => {
                                                location.reload();

                                            });


                                        }

                                    });


                                }
                            });

                    });
                });
            </script>


    </body>

    </html>

<?php } ?>