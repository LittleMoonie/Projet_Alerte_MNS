<?php session_start();
$_SESSION['mySession'] = "";
$_SESSION['user_mail'] = "";
$_SESSION['userId'] = "";
session_destroy();
header("Location: login.php");
?>