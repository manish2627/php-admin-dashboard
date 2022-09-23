<?php
include 'db.config.php';



$blogs = [];
$result = mysqli_query($conn, "select * from blogs_table");
while ($data =  mysqli_fetch_assoc($result)) {
    $blogs[] = $data;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />


</head>

<body>

    <!--nav bar start here-->
    <nav class="navbar navbar-expand-lg navbar-primary bg-light">
        <a class="navbar-brand" href="/">Ecomm</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= APP_URL?>/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= APP_URL?>/blog.php">Blogs</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href=""></a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Contact US</a>
                </li> -->

            </ul>
            <form class="form-inline my-2 my-lg-0" action="" mathod='GET'>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query" id="query">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

            </form>

            </form>
        </div>

        <a class="btn btn-primary mx-2" href="<?= APP_URL ?>/login.php" ">log in </a>
        <a  class=" btn btn-primary mr-2" href="<?= APP_URL ?>/register.php" "> sign up </a>
</div>
    </nav>
    <!--nav bar ends  here-->
    <div class="container my-3">
    <h2>Blogs</h2>
    <?php foreach($blogs as $blog){?>
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 my-4 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">Post by: <?= $blog['created_by']?></strong>
            <h3 class="mb-0"><?=$blog['blog_title'] ?></h3>
            <div class="mb-1 text-muted"><?=$blog['created_on'] ?></div>
            <p class="card-text mb-auto"><?=  strip_tags(substr($blog['blog_description'] , 0,70))."..";?></p>
            <div class="my-2">
            	<a href="#" role="button" class="btn btn-primary my-2">Continue reading</a>
            </div>
            
        </div>
     
       
    </div>
    <?php }?>
</div>











            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>