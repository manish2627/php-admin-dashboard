<?php
include 'db.config.php';
session_start();


$product_query = "SELECT * FROM products_tables  ORDER BY `products_tables`.`created_on` LIMIT 0 , 21 ";

$product_q = mysqli_query($conn, $product_query);
$products = [];
while ($product = mysqli_fetch_assoc($product_q)) {
    $products[] =  $product;
}
$category_data = [];
$result = mysqli_query($conn, "select * from category_table");
while ($data =  mysqli_fetch_assoc($result)) {
    $category_data[] = $data;
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
         <?php if (!isset($_SESSION['logedin'])) {?>
            <a class="btn btn-primary mx-2" href="<?= APP_URL ?>/login.php" ">log in </a>
        <a  class=" btn btn-primary mr-2" href="<?= APP_URL ?>/register.php" "> sign up </a>
        <?php } else{?>
            <a class="btn btn-primary mx-2" href="<?= APP_URL ?>/dashbord.php" ">Dashboard </a>
        <?php }?>

      
</div>
    </nav>
    <!--nav bar ends  here-->
    <div class="container">
    <h2 class="my-3">Products :</h2>
    <div class="row">
       <?php foreach($products as $product){?>
        <div class="col">
            <div class="card my-3" style="width: 18rem;" style="width:100%;height: 230px;">
            <?php $product_name = $product['product_name'];
              $q_product_images = mysqli_query($conn, "SELECT `image_name` FROM `products_images` WHERE `product_name`='$product_name'");
              $images = [];
              while ($image = mysqli_fetch_assoc($q_product_images)) {
                $images[] = $image['image_name']; ?>
                <?php }?>
                <img src="<?= APP_URL?>/assets/img/product_images/<?=$images[0]?>" class="card-img-top img-fluid" style="height:200px ;" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?= $product['product_name']?></h5>
                  <h6 class="card-title"></h6>
                  <p class="card-text"><?= substr($product['description'] ,0 ,50);?></p>
                     
                      <h6 class="card-title"><b> $ <?= $product['product_price']?></b></h6>
                  <a href="{% url 'coursehome' slug=course.sno %}" class="btn btn-primary">Take a view</a>
                </div>
              </div>
        </div>
        <?php } ?>
      
    </div>
</div>











            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>