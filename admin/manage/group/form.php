<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$groupName = "";
$groupId = 0;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM table_user_group WHERE group_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['id']]);

    if($row = $stmt->fetch()) {
        $groupId = $row['group_id'];
        $groupName = $row['group_name'];
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
        <input type="hidden" name="id" value="<?=$groupId?>"/>
        <br/>Nom<br/>
        <input type="text" name="name" value="<?=$groupName?>"/>
        <br/>
        <input type="submit" name="submit"/>
    </form>
</body>
</html>