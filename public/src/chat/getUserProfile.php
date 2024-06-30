<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";

if (isset($_GET['userId'])) {
    $userId = htmlspecialchars($_GET['userId']);
    $sql = "SELECT user_firstname, user_lastname, user_mail, user_picture FROM users WHERE user_id = :userId";
    $stmt = $db->prepare($sql);
    $stmt->execute([":userId" => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo json_encode($user);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'User not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid user ID']);
}
?>
