<?php session_start();
if (!isset($_SESSION['mySession']) || $_SESSION['mySession'] != "042") {
    header("Location: /admin/login.php");
    exit();
}
?>

<?php include $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/protect.php"; 
require_once $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/connect.php";
?>