<?php


if (isset($_POST["delete_btn"])) {
    include "db.config.php";
    $id = $_POST['id'];
    $delete_query = "DELETE FROM `products_tables` WHERE product_id='$id'";
    mysqli_query($conn, $delete_query);
   
}
