<?php session_start();
$_SESSION['mySession'] = "";
$_SESSION['user_mail'] = "";
session_destroy();
header("Location: login.php");
?>