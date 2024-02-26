<?php session_start();
$_SESSION['mySession'] = "";
$_SESSION['user_name'] = "";
session_destroy();
header("Location: /admin/login.php");
?>