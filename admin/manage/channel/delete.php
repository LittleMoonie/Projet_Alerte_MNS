<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "DELETE FROM channel WHERE channel_id=:id";
    $stmt= $db->prepare($sql);
    $stmt->execute(['id'=>$_GET['id']]);
}

header("Location:index.php");
?>