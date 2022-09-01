<?php

session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $msg_name = $_POST['msg_name'];
    $msg_email = $_POST['msg_email'];
    $msg_phone = $_POST['msg_phone'];
    $msg_message = $_POST['msg'];

    echo $msg_email,$msg_message,$msg_name,$msg_phone;
}
   



?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile - Brand</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    </head>

    <body id="page-top">
        <div id="wrapper">
            <?php include 'sidenavbar.php' ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    
                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Contact Us: </h3>
                            <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
                        </div>



                        <div class="container-fluid">

                            <div class="card shadow">
                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6" style="background-color: rgb(241,247,252);">
                                                    <form action="" method="POST">
                                                        <div class="form-group mb-3"><input class="form-control" type="text" placeholder="Name" name="msg_name" required="" style="width: 330px;"></div>
                                                        <div class="form-group mb-3"><input type="email" style="width: 330px;height: 39px;" name="msg_email" placeholder="Email"></div>
                                                        <div class="form-group mb-3"><input type="tel" placeholder="Phone No" name="msg_phone" style="width: 330px;height: 38px;"></div>
                                                        <div class="form-group mb-3"><textarea style="width: 330px;" placeholder="Message" name="msg" ></textarea></div>
                                                        <div class="form-group mb-3"><button class="btn btn-info" type="submit" name="msg_submit" style="width: 330px;">Submit</button></div>
                                                </div>
                                                </form>
                                                <div class="col-md-6" style="padding-left: 20px;padding-right: 20px;background-color: rgb(241,247,252);">
                                                    <fieldset></fieldset>
                                                    <legend><i class="fas fa-industry"></i>&nbsp;Company Name</legend>
                                                    <p></p>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td><i class="fas fa-map-marker-alt" style="height: 24px;width: 24px;"></i></td>
                                                                    <td>597,Ghandhi Nagar,Rangasamutram Post,Sathyamangalam - 638 402</td>
                                                                </tr>
                                                                <tr></tr>
                                                                <tr>
                                                                    <td><i class="fa fa-phone" style="width: 24px;height: 24px;"></i></td>
                                                                    <td>+91 98428 73007</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-envelope" style="width: 24px;height: 24px;"></i></td>
                                                                    <td>kalaivaniagencieserd@gmail.com<br>kalaivanisarees@gmail.com<br><br></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
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

<?php }  ?>