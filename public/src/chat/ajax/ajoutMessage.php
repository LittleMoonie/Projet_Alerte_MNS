<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_SESSION['userId'])){
        $donneesJson = file_get_contents('php://input');
        $donnees = json_decode($donneesJson);

        // On vérifie qu'il y a un message
        if(isset($donnees->message) && !empty($donnees->message)){
            // Le message n'est pas vide

            $sql = 'INSERT INTO `message` (`message_content`, `message_sender_id`, `message_channel_id`) VALUES (:message, :user, :channel)';

            $requete = $db->prepare($sql);
            $requete->bindValue('message', $donnees->message, PDO::PARAM_STR);
            $requete->bindValue('user', $_SESSION['userId'], PDO::PARAM_INT);
            $requete->bindValue('channel', $donnees->channel, PDO::PARAM_INT);

            if($requete->execute()){
                http_response_code(201);
                echo json_encode(['message' => 'Message enregistré']);
            }else{
                http_response_code(400);
                echo json_encode(['message' => 'Une erreur est survenue']);
            }
        }else{
            // Le message est indéfini ou vide
            http_response_code(400);
            echo json_encode(['message' => 'Le message est vide']);    
        }
    }else{
        // L'utilisateur n'est pas connecté
        http_response_code(400);
        echo json_encode(['message' => 'Vous n\'êtes pas connecté(e)']);
    }
}else{
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}

?>