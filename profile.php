<?php

session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {
    include "db.config.php";

    
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE `user_id` = " . $_SESSION['user_id']);
    $user_details = mysqli_fetch_assoc($user_details_query);


    // update profile pic 

    //update user details here 

    if (isset($_POST['save_change'])) {
        $image = $user_details['profile_pic'];
        if (isset($_FILES['profile_pic'])) {
            
            $filename = $_FILES['profile_pic']['name'];
            $tempname = $_FILES['profile_pic']['tmp_name'];
            $folder = "assets/img/profile/" . $filename;
            if($filename !=''){
            move_uploaded_file($tempname, $folder);
            $image =$filename;
           
            }
        }
       
       


        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];

        include 'db.config.php';
        $user_id = $user_details['user_id'];
        mysqli_query($conn, "UPDATE `users` SET `profile_pic`='$image',`first_name`='$first_name',`last_name`='$last_name',`email`='$email',`dob`='$dob',`phone`='$phone' WHERE `user_id` ='$user_id' ");
        $_SESSION['crud_msg']= "your details updated";
        header('location:profile.php');
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="assets/css/Profile-Edit-Form-styles.css">
        <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    </head>

    <body id="page-top">
        <?php include 'header.php' ?>
        
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
        }?>
            <div class="container profile profile-view" id="profile">
                
                <form method="POST" action="" enctype="multipart/form-data">
                    
                        <h1>Profile </h1>
                        <hr>
                        <div class=" form-row text-center avatar my-3 col-4">
                            <img class="rounded-circle mb-3 mt-4" src="assets/img/profile/<?= $user_details['profile_pic'] ?>" width="160" height="160">
                            <input class="form-control form-control" type="file" name="profile_pic">
                        </div>

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

                        <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="save_change">Save Changes</button></div>

                        <hr>
                       
                </form>
            </div>
        </div>
       
        <?php include "footer.php" ?>
    </body>

    </html>

<?php } ?>