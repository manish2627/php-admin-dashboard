<?php

session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    include "db.config.php";
    
    $update_msg = false;
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE `user_id` = " . $_SESSION['user_id']);
    $user_details = mysqli_fetch_assoc($user_details_query);


    // update profile pic 
    if (isset($_POST['change_photo']) && isset($_FILES['profile_pic'])) {
        $filename = $_FILES['profile_pic']['name'];
        $tempname = $_FILES['profile_pic']['tmp_name'];
        $folder = "assets/img/profile/" . $filename;
        move_uploaded_file($tempname, $folder);

        include 'db.config.php';
        $user_id = $user_details['user_id'];
        mysqli_query($conn, "UPDATE `users` SET `profile_pic`='$filename' WHERE `user_id`='$user_id' ");
        $update_msg = "your profile picture updated ..!";
    }

    //update user details here 

    if (isset($_POST['save_change'])) {

        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];

        include 'db.config.php';
        $user_id = $user_details['user_id'];
        mysqli_query($conn, "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`dob`='$dob',`phone`='$phone' WHERE `user_id` ='$user_id' ");
        $update_msg = "your details updated ..!";
        // header('location:profile.php');
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    </head>

    <body id="page-top">
        <div id="wrapper">
            <?php include 'sidenavbar.php' ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <?php include 'topnavbar.php' ?>
                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Profile</h3>
                        <?php if ($update_msg) {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>message: </strong> ' . $update_msg . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                            echo '<meta http-equiv="refresh" content="1;url=profile.php">';
                        } ?>



                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="card mb-3">
                                    <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="assets/img/profile/<?= $user_details['profile_pic'] ?>" width="160" height="160">
                                        <div class="mb-3">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="file" name="profile_pic">
                                                <!-- <button type="submit" name='submit'>submit</button> -->
                                                <button class="btn btn-primary btn-sm" type="submit" name="change_photo">Change Photo</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary font-weight-bold m-0">Projects</h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="small font-weight-bold">Server migration<span class="float-right">20%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Sales tracking<span class="float-right">40%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Customer Database<span class="float-right">60%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="sr-only">60%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Payout Details<span class="float-right">80%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Account setup<span class="float-right">Complete!</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-lg-8">
                                <div class="row mb-3 d-none">
                                    <div class="col">
                                        <div class="card text-white bg-primary shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Peformance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card text-white bg-success shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Peformance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username" placeholder="user.name" name="username" value="<?= $user_details['email'] ?>"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" id="email" placeholder="user@example.com" name="email" value="<?= $user_details['email'] ?>"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name" placeholder="John" name="first_name" value="<?= $user_details['first_name'] ?>"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name" placeholder="Doe" name="last_name" value="<?= $user_details['last_name'] ?>"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label for="phone"><strong>Phone</strong></label><input class="form-control" type="tel" id="phone" name="phone" value="<?= $user_details['phone'] ?>"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group"><label for="date_of_birth"><strong>Dob</strong></label><input class="form-control" type="date" id="dob" name="dob" value="<?= $user_details['dob'] ?>"></div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control" type="text" id="address" placeholder="Sunset Blvd, 38" name="address"></div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label for="city"><strong>City</strong></label><input class="form-control" type="text" id="city" placeholder="Los Angeles" name="city"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group"><label for="country"><strong>Country</strong></label><input class="form-control" type="text" id="country" placeholder="USA" name="country"></div>
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="save_change">Save Changes</button></div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card shadow mb-5">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Forum Settings</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form>
                                            <div class="form-group"><label for="signature"><strong>Signature</strong><br></label><textarea class="form-control" id="signature" rows="4" name="signature"></textarea></div>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label" for="formCheck-1"><strong>Notify me about new replies</strong></label></div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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

<?php } ?>