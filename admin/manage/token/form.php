<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$tokenId = 0;
$tokenUser = "";

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM token WHERE token_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['id']]);

    if($row = $stmt->fetch()) {
        $tokenId = $row['token_id'];
        $tokenUser = $row['token_user_id'];
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
        <input type="hidden" name="id" value="<?=$tokenId?>"/>
        <br/>Utilisateur relié<br/>
        <input type="text" name="name" value="<?=$tokenUser?>"/>
        <br/>
        <input type="submit" name="submit"/>
    </form>
</body>
</html>