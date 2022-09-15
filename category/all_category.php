<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    $aleart_msg = [];
    include '../db.config.php';

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

    <head>
        <title>All Categories</title>
    </head>

    <body id="page-top">
      
        <?php include '../header.php'?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">All categories </h3>
                            <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
                        </div>


                        <div class="container-fluid">
                        <?php
       if($_SESSION['crud_msg']) {
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
                                                            <form id="form" action="category_update.php" method="GET">
                                                                <input type="hidden" name="cat_update_id" value="<?php echo $data['id']; ?>">

                                                                <button type="submit" class="btn-sm btn-primary  " data-toggle="modal" data-target="#cat_update_Modal"> edit</button>
                                                            </form>
                                                            <input type="hidden" name="cat_delete_id" class="cat_delete_id" value="<?php echo $data['id']; ?>">
                                                            <a href="javascript:void(0)" name="category_delete_btn" class="btn-sm mx-1 btn-danger category_delete_btn ">Delete</a>

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
                    </div>
                    <?php include '../footer.php'?>
                    
            <script>
                $(document).ready(function() {
                    $('.category_delete_btn').click(function(e) {
                        e.preventDefault();
                        //  console.log("hello");
                        var delete_id = $(this).closest("tr").find('.cat_delete_id').val();
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
                                        url: "<?= APP_URL?>/category/delete.php",
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