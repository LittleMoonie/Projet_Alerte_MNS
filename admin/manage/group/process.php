<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$groupName = "";

if(isset($_POST['name']))
    $groupName = $_POST['name'];

if($_POST['id'] != 0) {
    $sql = 'UPDATE group SET group_name=:name WHERE group_id=:id';
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':id',$_POST['id']);
}
else {
    $sql = 'INSERT INTO user_group (group_name) VALUES (:name)';
    $stmt= $db->prepare($sql);
}

$stmt->bindParam(':name',$groupName);
$stmt->execute();

header("Location:index.php");
?>