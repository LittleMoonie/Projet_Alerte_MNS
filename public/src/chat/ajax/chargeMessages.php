<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['lastId'])){
        $lastId = (int)strip_tags($_GET['lastId']);
        $channelId = (int)strip_tags($_GET['channelId']);

        $filtre = ($lastId > 0) ? " AND `message_id` > $lastId" : '';

        $sql = 'SELECT `message_id`, `message_content`, `message_timestamp`, `message_sender_id`, `user_lastname`, `user_firstname`, `user_picture` 
                FROM `message` 
                LEFT JOIN `users` ON `message_sender_id` = `user_id`
                WHERE `message_channel_id` = '.$channelId.$filtre.' 
                ORDER BY `message_id` DESC LIMIT 50';
        $requete = $db->query($sql);
        $messages = $requete->fetchAll();

        $messagesJson = json_encode($messages);
        echo $messagesJson;
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}
?>
