<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$channelId = 0;
$categoryId = 0;
$channelName = "";
$channelDesc = "";

if(isset($_GET['channel_id']) && $_GET['channel_id'] > 0) {
    $sql = "SELECT * FROM channel WHERE channel_id=:id"; 
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['channel_id']]);

    if($row = $stmt->fetch()) {
        $channelId = $row['channel_id'];
        $channelName = $row['channel_name'];
        $channelDesc = $row['channel_description'];
    }
}

if(isset($_GET['cat_id']) && $_GET['cat_id'] > 0) {
    $categoryId = $_GET['cat_id'];
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
        <input type="text" name="name" value="<?=$channelName?>"/>

        <br/>Description<br/>
        <input type="text" name="description" value="<?=$channelDesc?>"/>

        <br/>
        <input type="submit" name="submit"/>
    </form>
</body>
</html>