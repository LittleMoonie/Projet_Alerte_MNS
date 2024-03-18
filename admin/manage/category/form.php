<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$categoryName = "";
$categoryId = 0;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM category WHERE category_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['id']]);

    if($row = $stmt->fetch()) {
        $categoryId = $row['category_id'];
        $categoryName = $row['category_name'];
    }
}
else {
    $sql = "SELECT * FROM user_group WHERE group_id!=1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $recordset = $stmt->fetchAll();
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
        <?php if($categoryId == 0) {?>
            Ajouter des groupes à la catégorie<br/>
            <select multiple name="groups" id="groups">
                <?php foreach($recordset as $row) {?>
                    <option><?= $row['group_name']?></option>
                <?php }?>
            </select>
        <?php }?>
        <input type="submit" name="submit"/>
    </form>
</body>
</html>