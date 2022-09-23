<?php
session_start();
include '../db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:".APP_URL."/login.php");
} else {

   




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
                if (isset($_SESSION['crud_msg']) && !empty($session['crud_msg'])) {
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
                    

                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>

                                    <th scope="col">s.no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <!-- <th scope="col">Role</th> -->
                                    <th scope="col">Created on</th>

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
                                        <!-- <td><?php  ?></td> -->


                                        <td><?php $date = date_create($user['join_date']);
                                            echo date_format($date,"d/m/Y"); ?></td>

                                        <td>
                                    
                                            <div class="row">
                                                <!-- Button trigger modal for update form-->
                                                <form id="form" action="update_user.php" method="GET">
                                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

                                                    <button type="submit" class="btn-sm btn-primary "> edit</button>
                                                </form>
                                            </div>
                                          
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