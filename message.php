<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");
} else {

    include 'db.config.php';
    $messages = [];
    $msg_query = mysqli_query($conn, "SELECT * FROM messages ");
    while ($msg_result = mysqli_fetch_assoc($msg_query)) {
        $messages[] = $msg_result;
    }
   



?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Dashboard - Brand</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/some-message.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body id="page-top">


        <div id="wrapper">
            <?php include 'nav.php' ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">messages</h3>
                            <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> -->
                        </div>
                        <!-- message tamplate start here  -->
                       <?php foreach($messages as $message){ ?>
                        <div class="d-flex my-2" id="some-message">
                            <div class="profile"><img class="rounded-circle" src="assets/img/avatars/1365309047096.jpg"></div>
                            <div class="content">
                                <h3>Message by:&nbsp;<span><?= $message['name']?></span></h3>
                                <h6><?= $message['email']?></h6>
                                <p><?=$message['massage'] ?></p>
                                <!-- <div><a href="#"><i class="fa fa-reply"></i></a><a href="#"><i class="fa fa-retweet"></i></a><a href="#"><i class="fa fa-heart"></i></a><a href="#"><i class="fa fa-ellipsis-h"></i></a></div> -->
                            </div>
                        </div>
                        <?php }?>
                         <!-- message tamplate ends here  -->
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
    </body>

    </html>

<?php } ?>