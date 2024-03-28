<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_SESSION['userId'])){
        $donneesJson = file_get_contents('php://input');
        $donnees = json_decode($donneesJson);

        // On vérifie qu'il y a un message
        if(isset($donnees->message) && !empty($donnees->message)){
            $sql = 'INSERT INTO `message` (`message_content`, `message_sender_id`, `message_channel_id`, `message_timestamp`, `message_file_type`) VALUES (:message, :user, :channel, :date, \'text\')';

            $requete = $db->prepare($sql);

            if($requete->execute(['message'=> $donnees->message, 'user'=> $donnees->user, 'channel'=> $donnees->channel, 'date'=> $donnees->timestamp])){
                http_response_code(201);
                echo json_encode(['message' => 'Message enregistré']);
            }else{
                http_response_code(400);
                echo json_encode(['message' => 'Une erreur est survenue']);
            }

            $requete->debugDumpParams();
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