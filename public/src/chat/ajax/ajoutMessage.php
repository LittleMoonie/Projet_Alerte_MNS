<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['userId'])) {
        $dataJson = file_get_contents('php://input');
        $data = json_decode($dataJson);

        if (isset($data->message) && !empty($data->message)) {
            $sql = "INSERT INTO `message` (`message_content`, `message_sender_id`, `message_channel_id`, `message_timestamp`, `message_file_type`) 
                    VALUES (:message, :user, :channel, :date, :file_type)";

            $stmt = $db->prepare($sql);
            if ($stmt->execute([
                'message' => htmlspecialchars($data->message),
                'user' => $_SESSION['userId'],
                'channel' => htmlspecialchars($data->channel),
                'date' => htmlspecialchars($data->timestamp),
                'file_type' => htmlspecialchars($data->file_type)
            ])) {
                http_response_code(201);
                echo json_encode(['message' => 'Message enregistré']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Une erreur est survenue']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Le message est vide']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Vous n\'êtes pas connecté(e)']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}
?>
