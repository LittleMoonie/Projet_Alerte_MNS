<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$categoryName = "";

if(isset($_POST['name']))
    $categoryName = $_POST['name'];

if($_POST['channel_id'] != 0) {
    $sql = 'UPDATE channel SET channel_name=:name WHERE channel_id=:id';
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':id',$_POST['channel_id']);
}
else {
    $sql = 'INSERT INTO channel (channel_name) VALUES (:name)';
    $stmt= $db->prepare($sql);
}

$stmt->bindParam(':name',$categoryName);
$stmt->execute();

header("Location:../category/index.php");
?>