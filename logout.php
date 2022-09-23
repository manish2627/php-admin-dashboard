<?php
include "db.config.php";
session_start();

unset($_SESSION["logedin"]);
unset($_SESSION["name"]);
unset($_SESSION["user_id"]);
session_destroy();

header("Location:login.php");
?>


