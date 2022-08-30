<?php
session_start();

if (isset($_SESSION['logedin'])) {

  header("location:dashbord.php");

} else {

include 'db.config.php';

$fname = $lname = $email = $dob = $phone =  $pass = "";
$errfname = $erremail = $errdob = $errphone =  $errpass = "";
$errmsg = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST["fname"])) {
        $fnameErr = "Name is required";
    } else {
        $fname = $_POST["fname"];
    }

    $lname = $_POST['lname'];

    if (empty($_POST["email"])) {
        $erremail = "email is required";
    } else {
        $email = $_POST["email"];
    }
    if (empty($_POST['dob'])) {
        $erremail = "date of birth is required";
    } else {
        $dob = $_POST['dob'];
    }
    if (empty($_POST['phone'])) {
        $errphone = "phone no  is required";
    } else {
        $phone = $_POST['phone'];
    }

    if (empty($pass1 = $_POST['pass1'])) {
        $errpass = "password is required";
    } else {
        $pass1 = $_POST['pass1'];
    }

    if (empty($pass2 = $_POST['pass2'])) {
        $errpass = "password is required";
    } else {
        $pass2 = $_POST['pass2'];
    }


    //  checks ==>



    // email check that alreardy in db or not 
    $emailindb = false;

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $emailindb = true;
    }

    // password check

    if ($pass1 != $pass2) {
        $errmsg = "your password does not match !!! please check !";
    } elseif (empty($fname) or empty($pass1) or empty($email) or empty($dob) or empty($phone)) {

        $errmsg = "please check the enter details are correct it  ";
    } elseif ($emailindb) {
        $errmsg = "allready have an account with this email. use another email account ..! ";
    } else {
        $pass = md5($pass1);
        $errmsg = "your account has been created successfully ...!! ";
        $query =
            "INSERT INTO `users` (`first name`, `last name`, `email`, `dob`, `phone`, `password`) VALUES ('$fname', '$lname', '$email', '$dob', '$phone', '$pass')";
        mysqli_query($conn, $query);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-primary">
    <?php if ($errmsg) {
        echo '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>message: </strong> ' . $errmsg . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    ?>
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/dogs/image2.jpeg&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form class="user" action="register.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="fname" placeholder="First Name" name="fname" value="<?php echo $fname ?>"><span class="error"> <h6><?php echo $errfname; ?></h6></span></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="lname" placeholder="Last Name" name="lname" value="<?php echo $lname ?>"></div>
                                </div>
                                <div class="form-group"><input class="form-control form-control-user" type="email" id="email" name="email" value="<?php echo $email ?>" aria-describedby=" emailHelp" placeholder="Email Address"><span class="error"> <h6><?php echo $erremail; ?></h6></span></div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="tel" id="phone" placeholder="phone" name="phone" value="<?php echo $phone ?>"><span class="error"> <h6><?php echo $errphone; ?></h6></span></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="date" id="dob" placeholder="date of birth" name="dob" value="<?php echo $dob ?>"><span class="error"> <h6><?php echo $errdob; ?></h6></span></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" placeholder="Password" id="pass1" name="pass1"><span class="error"> <h6><?php echo $errpass; ?></h6></span></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password" id="pass2" name="pass2" placeholder="Repeat Password"><span class="error"> <h6><?php echo $errpass; ?></h6></span></div>
                                </div><button class="btn btn-primary btn-block text-white btn-user" type="submit">Register Account</button>
                                <!-- <hr><a class="btn btn-primary btn-block text-white btn-google btn-user" role="button"><i class="fab fa-google"></i>&nbsp; Register with Google</a><a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Register with Facebook</a> -->
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="forgot-password.html">Forgot Password?</a></div>
                            <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
<?php }?>