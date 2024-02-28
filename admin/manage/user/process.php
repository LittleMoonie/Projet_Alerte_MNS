<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$userLastname = "";
$userFirstname = "";
$userMail = "";
$userTel = "";

if(isset($_POST['lastName']))
    $userLastname = $_POST['lastName'];

if(isset($_POST['firstName']))
    $userFirstname = $_POST['firstName'];

if(isset($_POST['mail']))
    $userMail = $_POST['mail'];

if($_POST['id'] != 0) {
    $sql = 'UPDATE users SET user_lastname=:lastname, user_firstname=:firstname, user_mail=:mail WHERE user_id=:id';
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':id',$_POST['id']);
}
else {
    $sql = 'INSERT INTO users (user_lastname, user_firstname, user_phone, user_mail) VALUES (:lastname, :firstname, :mail)';
    $stmt= $db->prepare($sql);
}

$stmt->bindParam(':lastname',$userLastname);
$stmt->bindParam(':firstname',$userFirstname);
$stmt->bindParam(':mail',$userMail);
$stmt->execute();

header("Location:index.php");
?>