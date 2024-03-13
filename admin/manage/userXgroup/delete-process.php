<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

if($_GET['group_id'] != 0 && $_GET['user_id'] != 0 && isset($_GET['group_id']) && isset($_GET['user_id'])) {
    $sql = "DELETE FROM userxgroup WHERE uxg_user_id=:user_id AND uxg_group_id=:group_id";
    $stmt= $db->prepare($sql);

    $stmt->bindParam(':group_id',$_GET['group_id']);
    $stmt->bindParam(':user_id',$_GET['user_id']);

    $stmt->execute();

    header("Location:../../index.php");
}
?>