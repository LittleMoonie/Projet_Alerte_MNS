<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$channelName = "";
$categoryId = 0;

if(isset($_POST['name']))
    $channelName = $_POST['name'];

if(isset($_POST['cat_id']))
    $categoryId = $_POST['cat_id'];

if($_POST['channel_id'] != 0) {
    $sql = 'UPDATE channel SET channel_name=:name WHERE channel_id=:id';
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':id',$_POST['channel_id']);
}
else {
    $sql = 'INSERT INTO channel (channel_name, channel_category_id) VALUES (:name, :cat_id)';
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':cat_id',$_POST['cat_id']);
}

$stmt->bindParam(':name',$channelName);
$stmt->execute();

header("Location:../category/index.php");
?>