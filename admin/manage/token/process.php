<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$tokenFirstname = "";
$tokenLastname = "";
$tokenFirstname = "";

if(isset($_POST['firstname']))
    $tokenFirstname = $_POST['firstname'];

if(isset($_POST['lastname']))
    $tokenLastname = $_POST['lastname'];

$tokenContent = bin2hex(random_bytes(16));

$sql = 'INSERT INTO token (token_content, token_lastname, token_firstname, token_use) VALUES (:content, :firstname, :lastname, true)';
$stmt= $db->prepare($sql);
$stmt->execute(['lastname' => $tokenLastname, 'firstname' => $tokenFirstname, 'content' => $tokenContent]);

$tokenId = $db->lastInsertId();
echo "<script>console.log('last token: ".$tokenId."')</script>";

if (isset($_POST['token_group'])) {
    $selectedGroupIds = $_POST['token_group'];

    if (is_array($selectedGroupIds)) {
        foreach ($selectedGroupIds as $groupId) {
            echo "<script>console.log('group id: ".$groupId."')</script>";
            $sql = 'INSERT INTO tokenxgroup (txg_token_id, txg_group_id) VALUES (:token, :group)';
            $stmt= $db->prepare($sql);
            $stmt->execute(['token' => $tokenId, 'group' => $groupId]);
        }
    } else {
        $sql = 'INSERT INTO tokenxgroup (txg_token_id, txg_group_id) VALUES (:token, :group)';
        $stmt= $db->prepare($sql);
        $stmt->execute(['token' => $tokenId, 'group' => $groupId]);
    }
}

header("Location:index.php");
?>