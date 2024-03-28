<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$tokenUser = "";

if(isset($_POST['token_user']))
    $tokenUser = $_POST['token_user'];

if($_POST['id'] != 0) {
    $sql = 'UPDATE token SET token_user_id=:user_id WHERE token_id=:id';
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':id',$_POST['token_id']);
}
else {
    $sql = 'INSERT INTO token (token_user_id) VALUES (:user_id)';
    $stmt= $db->prepare($sql);
}

$stmt->bindParam(':user_id',$tokenUser);
$stmt->execute();

header("Location:index.php");
?>