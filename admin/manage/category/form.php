<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$categoryName = "";
$categoryId = 0;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM category WHERE category_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['id']]);

    if($row = $stmt->fetch()) {
        $groupId = $row['category_id'];
        $groupName = $row['category_name'];
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
        <input type="hidden" name="id" value="<?=$categoryId?>"/>
        <br/>Nom<br/>
        <input type="text" name="name" value="<?=$categoryName?>"/>
        <br/>
        <input type="submit" name="submit"/>
    </form>
</body>
</html>