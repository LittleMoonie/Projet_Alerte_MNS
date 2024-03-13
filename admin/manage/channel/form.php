<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$categoryName = "";
$categoryId = 0;
$channelId = 0;

if(isset($_GET['cat_id']) && $_GET['cat_id'] > 0) {
    $sql = "SELECT category_id FROM category WHERE category_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['cat_id']]);

    if($row = $stmt->fetch()) {
        $groupId = $row['category_id'];
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
        <input type="hidden" name="cat_id" value="<?=$categoryId?>"/>
        <input type="hidden" name="channel_id" value="<?=$channelId?>"/>

        <br/>Nom<br/>
        <input type="text" name="name" value=""/>

        <input type="submit" name="submit"/>
    </form>
</body>
</html>