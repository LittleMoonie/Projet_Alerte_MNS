<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$categoryName = "";

if(isset($_POST['name']))
    $categoryName = $_POST['name'];

if($_POST['id'] != 0) {
    $sql = 'UPDATE category SET category_name=:name WHERE category_id=:id';
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':id',$_POST['id']);
}
else {
    $sql = 'INSERT INTO category (category_name) VALUES (:name)';
    $stmt= $db->prepare($sql);
}

$stmt->bindParam(':name',$categoryName);
$stmt->execute();

header("Location:index.php");
?>