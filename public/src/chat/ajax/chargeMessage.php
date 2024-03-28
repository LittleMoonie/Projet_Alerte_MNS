<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['lastId'])){
        $lastId = (int)strip_tags($_GET['lastId']);

        $filtre = ($lastId > 0) ? " WHERE `messages`.`id` > $lastId" : '';

        $sql = 'SELECT `message_id`, `message_content`, `message_timestamp`, `user_lastname`, `user_firstname` FROM `message` LEFT JOIN `users` ON `message_user_id` = `user_id`'.$filtre.' ORDER BY `id` DESC LIMIT 5';
        $requete = $db->query($sql);
        $messages = $requete->fetchAll();

        $messagesJson = json_encode($messages);
        echo $messagesJson;
    }
}else{
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}

?>