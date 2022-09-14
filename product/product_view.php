<?php
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:../login.php");
} else {

    include '../db.config.php';

    // get the product
    $product_id = $_GET['product_update_id'];

    $q_product = mysqli_query($conn, "SELECT * FROM PRODUCTS_TABLES WHERE `product_id`= '$product_id'");
    $product = mysqli_fetch_assoc($q_product);

    //get product images 
    $product_name = $product['product_name'];
    $q_product_images = mysqli_query($conn, "SELECT `image_name` FROM `products_images` WHERE `product_name`='$product_name'");
    $images = [];
    while ($image = mysqli_fetch_assoc($q_product_images)) {
        $images[] = $image['image_name'];
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

            <main class="h-full overflow-y-auto  ">
                <div class="container grid px-6 mx-auto ">
                    <h1 class="my-6 text-lg font-bold text-gray-700 dark:text-gray-300 py-3">Product Details</h1>
                    <div class="inline-block overflow-y-auto h-full align-middle transition-all transform ">
                        <div class="flex flex-col lg:flex-row md:flex-row w-full overflow-hidden row">
                            <div class="flex-shrink-0 flex items-center justify-center h-auto col-md-6">
                               
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                    
                                        <?php $i = 0 ; foreach($images as $image){ $i++; 
                                            if($i == 1){ echo "<div class='carousel-item active'>";

                                            }else{echo "<div class='carousel-item'>";}
                                            ?>
                                        
                                       
                                            <img class="d-block w-100" style="height:500px ;" src="../assets/img/product_images/<?=$image?>" >
                                        </div>
                                        <?php }?>
                                      
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <div class="w-full flex flex-col p-5 md:p-8 text-left col-md-6">
                                <div class="mb-5 block ">
                                    <div class="font-serif font-semibold py-1 text-sm">
                                        <!-- <p class="text-sm text-gray-500 pr-4">Status: <span class="text-green-400"></span></p> -->
                                    </div>
                                    <h2 class="text-heading text-lg md:text-xl lg:text-2xl font-semibold font-serif dark:text-gray-400"><?= $product['product_name'] ?></h2>
                                    <p class="uppercase font-serif font-medium text-gray-500 dark:text-gray-400 text-sm">SKU : <span class="font-bold text-gray-500 dark:text-gray-500"><?= $product['product_slug'] ?></span></p>
                                </div>
                                <div class="font-serif product-price font-bold dark:text-gray-400">Price : <span class="inline-block text-2xl"><?= $product['product_price'] ?>Rs.</span></div>
                                <div class="mb-3"><span class="inline-flex px-2 text-xs font-medium leading-5 rounded-full text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-100"> <span class="font-bold">In Stock</span></span><span class="text-sm text-gray-500 dark:text-gray-400 font-medium pl-4">Quantity: <?= $product['quantity'] ?></span></div>
                                <p class="text-sm leading-6 text-gray-500 dark:text-gray-400 md:leading-7"><?= $product['description'] ?></p>
                                <div class="flex flex-col mt-4">
                                    <p class="font-serif font-semibold py-1 text-gray-500 text-sm"><span class="text-gray-700 dark:text-gray-400">Category: </span><?= $product['category'] ?></p>
                                    <!-- <div class="flex flex-row"><span class="bg-gray-200 mr-2 border-0 text-gray-500 rounded-full inline-flex items-center justify-center px-2 py-1 text-xs font-semibold font-serif mt-2 dark:bg-gray-700 dark:text-gray-300">lettuce</span><span class="bg-gray-200 mr-2 border-0 text-gray-500 rounded-full inline-flex items-center justify-center px-2 py-1 text-xs font-semibold font-serif mt-2 dark:bg-gray-700 dark:text-gray-300">fresh vegetable</span></div> -->
                                </div>
                                
                                 
                                <!-- for edit the product details  -->
                                <form id="form" action="product_update.php" method="GET">
                                                    <input type="hidden" name="product_update_id" value="<?php echo $product['product_id']; ?>">

                                                    <button type="submit" class="btn btn-primary cursor-pointer leading-5 transition-colors duration-150 font-medium text-sm focus:outline-none px-5 py-2 rounded-md text-white bg-green-500 border border-transparent active:bg-green-600 hover:bg-green-600 focus:ring focus:ring-purple-300" > Edit Product </button>
                                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



        </div>
        <?php include '../footer.php' ?>


        <script>
            $(document).ready(function() {
                $('.product_delete_btn').click(function(e) {
                    e.preventDefault();
                    //  console.log("hello");
                    var delete_id = $(this).closest("tr").find('.product_delete_id').val();
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
                                    url: "delete_product.php",
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