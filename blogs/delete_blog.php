<?php


if (isset($_POST["delete_btn"])) {
    include "../db.config.php";
    $id = $_POST['id'];
    $delete_query = "DELETE FROM `blogs_table` WHERE blog_id='$id'";
    mysqli_query($conn, $delete_query);
   
}
