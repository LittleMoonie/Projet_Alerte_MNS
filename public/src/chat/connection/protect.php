<?php session_start();
if (!isset($_SESSION['mySession']) || $_SESSION['mySession'] != "042") {
    header("Location: /public/src/chat/connection/login.php");
    exit();
}
?>