<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$userFirstname = "";
$userLastname = "";
$userMail = "";
$userId = 0;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM table_user WHERE user_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['id']]);

    if($row = $stmt->fetch()) {
        $userId = $row['user_id'];
        $userFirstname = $row['user_firstname'];
        $userLastname = $row['user_lastname'];
        $userMail = $row['user_mail'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office | Formulaire</title>
</head>
<body>
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?=$userId?>"/>
        Nom<br/>
        <input type="text" name="lastName" value="<?=$userLastname?>"/>
        Prénom<br/>
        <input type="text" name="firstName" value="<?=$userFirstnamee?>"/>
        <br/>Mail<br/>
        <input type="text" name="mail" value="<?=$userMail?>"/>
        <br/>
        <input type="submit" name="submit"/>
    </form>
</body>
</html>