<?php include $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/protect.php"; 
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$user_id = $_SESSION['userId'];

$sql = "SELECT * FROM users WHERE user_id = :id";

$stmt = $db->prepare($sql);
$stmt->execute([":id" => $user_id]);
$recordset = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
</head>
<body>
    <h1>Profil</h1>
    <a href="./assets/php/changePicture.php">Changer Photo de Profil</a>
    <div>
        Nom</br>
        <?= $recordset['user_lastname']?></br>
    </div>
    <div>
        Prénom</br>
        <?= $recordset['user_firstname']?></br>
    </div>
    <div>
        Mail</br>
        <?= $recordset['user_mail']?></br>
    </div>
    <div>
        <img src="<?= '../../upload/'.$recordset['user_picture']?>" alt="" srcset="">
    </div>
</body>
</html>