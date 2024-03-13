<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

if($_GET['group_id'] != 0 && $_GET['category_id'] != 0 && isset($_GET['group_id']) && isset($_GET['category_id'])) {
    $sql = 'INSERT INTO groupxcategory (gxc_group_id, gxc_category_id) VALUES (:group_id, :category_id) ';
    $stmt= $db->prepare($sql);

    $stmt->bindParam(':group_id',$_GET['group_id']);
    $stmt->bindParam(':category_id',$_GET['category_id']);

    $stmt->execute();

    header("Location:../../index.php");
}
?>