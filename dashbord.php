<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    $aleart_msg = [];
    include 'db.config.php';

    //  for contact us messages 
    // $messages = [];
    // $msg_query = mysqli_query($conn, "SELECT * FROM messages ");
    // while ($msg_result = mysqli_fetch_assoc($msg_query)) {
    //     $messages[] = $msg_result;
    // }
    // $messages = array_reverse($messages);


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


        <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <!-- Custom styles for this template-->
        <link href="assets/css/styles.css" rel="stylesheet">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    </head>

    <body id="page-top">
        <?php foreach ($aleart_msg as $errmsg) {
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

                                                <th scope="col">s.no</th>
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
                                                    <td><?php echo $data['created_by']; ?></td>
                                                    
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

                                                                <button type="submit" class="btn-sm btn-primary " data-toggle="modal" data-target="#cat_update_Modal"> edit</button>
                                                            </form>
                                                            <input type="hidden" name="cat_delete_id" class="cat_delete_id" value="<?php echo $data['id']; ?>">
                                                            <a href="javascript:void(0)" name="category_delete_btn" class="btn-sm mx-1 btn-danger category_delete_btn">Delete</a>

                                                        </div>
                                                    </td>
                                                    <td>

                                                    </td>


                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                    <!-- new category add form start here  -->


                                    <!-- Modal -->
                                    <!-- 
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
                                    </div> -->
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
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.category_delete_btn').click(function(e) {
                        e.preventDefault();
                        //  console.log("hello");
                        var delete_id = $(this).closest("tr").find('.cat_delete_id').val();
                        // console.log(delete_id);

                        swal({
                                title: "Are you sure?",
                                text: "Once deleted, you will not be able to recover this imaginary file!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $.ajax({
                                        type: "POST",
                                        url: "delete.php",
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