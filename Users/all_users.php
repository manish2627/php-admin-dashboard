<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {

    include '../db.config.php';




    // get all users 
    $user_query = mysqli_query($conn, "SELECT * FROM USERS ");

    $users = [];
    while ($user =  mysqli_fetch_assoc($user_query)) {
        $users[] = $user;
    }

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>All products </title>
    </head>

    <body id="page-top">

        <?php include '../header.php' ?>

        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Users :</h3>
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
                        <p class="text-primary m-0 font-weight-bold">Orders</p>
                    </div>

                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>

                                    <th scope="col">s.no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Job Role</th>
                                    <th scope="col">Join Date</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($users as $user) {
                                    $i += 1 ?>
                                    <tr>

                                        <td class="counterCell"><?= $i ?></td>
                                        <td><?php echo $user['first_name'] . " " . $user['last_name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['phone']; ?></td>
                                        <td><?php echo $user['role']; ?></td>


                                        <td><?php $date = date_create($user['join_date']);
                                            echo date_format($date, DATE_COOKIE); ?></td>

                                        <td><?php $q =mysqli_query($conn,"SELECT `role` FROM `users` WHERE `user_id`=".$_SESSION['user_id']);
                                                $user_role = mysqli_fetch_assoc($q);
                                                
                                                

                                                    if($user_role['role'] == 'admin'){ ;?>
                                            <div class="row">
                                                <!-- Button trigger modal for update form-->
                                                <form id="form" action="update_user.php" method="GET">
                                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

                                                    <button type="submit" class="btn-sm btn-primary "> edit</button>
                                                </form>
                                            </div>
                                            <?php }
                                            else{echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                              </svg>'; 
                                              
                                            }?>
                                        </td>


                                    </tr>
                                <?php }?>
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
            <?php include '../footer.php' ?>


            < </body>

    </html>

<?php } ?>