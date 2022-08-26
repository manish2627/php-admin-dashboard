<?php
include "db.config.php";
session_start();
unset($_SESSION['user_data']);
unset($_SESSION["logedin"]);
unset($_SESSION["name"]);
session_destroy();
header("Location:login.php");
?>