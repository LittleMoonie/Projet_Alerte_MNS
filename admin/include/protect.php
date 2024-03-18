<?php session_start();
if (!isset($_SESSION['mySession']) || $_SESSION['mySession'] != "042") {
    header("Location: /admin/login.php");
    exit();
}
?>
