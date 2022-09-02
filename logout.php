<?php
include "db.config.php";
session_start();

unset($_SESSION["logedin"]);
unset($_SESSION["name"]);
unset($_SESSION["user_id"]);
// session_destroy();
$_SESSION['crud_msg'] = "you are logged out ...!!";
header("Location:login.php");
?>


