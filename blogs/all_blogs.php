<?php
session_start();
include '../db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:".APP_URL."/login.php");
} else {
    $aleart_msg = [];
    

       //Get catgory details
    $result = mysqli_query($conn, "select * from blogs_table");
    $user_query = mysqli_query($conn, "SELECT * FROM USERS ");

    $users = [];
    while ($user =  mysqli_fetch_assoc($user_query)) {
        $users[] = $user;
    }

    $blogs = [];
    while ($data =  mysqli_fetch_assoc($result)) {
        $blogs[] = $data;
    }
    // print_r($blogs);
?>

    <head>
        <title>All Blogs</title>
    </head>

    <body id="page-top">
      
        <?php include '../header.php'?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Blogs </h3>
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
                                    <p class="text-primary m-0 font-weight-bold">Blogs</p>
                                </div>

                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>

                                                <th scope="col">s.no</th>
                                                <th scope="col">Tilte</th>
                                                <th scope="col">Description</th>                                                
                                                <th scope="col">Created by</th>
                                                <th scope="col">created on</th>
                                                <th scope="col">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0;
                                            foreach ($blogs as $blog) {
                                                $i += 1 ?>
                                                <tr>

                                                    <td class="counterCell"><?= $i ?></td>
                                                    <td><?php echo $blog['blog_title']; ?></td>
                                                    <td><?php echo substr($blog['blog_description'] , 0,30).".."; ?></td>
                                                    <td><?php echo $blog['created_by']; ?></td>
                                                    <td><?php echo $blog['created_on']; ?></td>
                                                    <td>
                                            <div class="row">
                                                <!-- Button trigger modal for update form-->
                                                <form id="form" action="update_blog.php" method="GET">
                                                    <input type="hidden" name="blog_update_id" value="<?php echo $blog['blog_id']; ?>">

                                                    <button type="submit" class="btn-sm btn-primary " data-toggle="modal" data-target="#cat_update_Modal"> edit</button>
                                                </form>
                                                <input type="hidden" name="blog_delte_id" class="blog_delete_id" value="<?php echo $blog['blog_id']; ?>">
                                                <a href="javascript:void(0)" name="blog_delete_btn" class="btn-sm mx-1 btn-danger blog_delete_btn">Delete</a>

                                            </div>
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
                    $('.blog_delete_btn').click(function(e) {
                        e.preventDefault();
                        //  console.log("hello");
                        var delete_id = $(this).closest("tr").find('.blog_delete_id').val();
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
                                        url: "delete_blog.php",
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