<?php
namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat_Websocket implements MessageComponentInterface {
    protected $clients;
    protected $db;

    public function __construct() {
        $this->clients = new \SplObjectStorage;

        // Connect to the database using connect.php
        require_once $_SERVER["DOCUMENT_ROOT"]."/connection/connect.php";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Store the message in the database
        $userId = $from->userId; // Assuming you set userId when the user connects
        $timestamp = date("Y-m-d H:i:s");
        $channelId = $_GET['channel_id'];
        $this->saveMessageToDatabase($userId, $msg, $timestamp, $channelId);

        // Broadcast the message to all clients
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    protected function saveMessageToDatabase($userId, $message, $timestamp, $channel) {
        $sql = "INSERT INTO message (message_sender_id, message_content, message_timestamp, message_file_type, message_channel_id) VALUES (:user, :content, :timestamp, 'text', :channel)";
        $stmt = $db->prepare($sql);
        $stmt-> bindParam(':user', $userId);
        $stmt-> bindParam(':content', $message);
        $stmt-> bindParam(':timestamp', $timestamp);
        $stmt-> bindParam(':channel', $channel);
        $stmt->execute();

        /*$stmt = $this->db->prepare("INSERT INTO messages (user_id, message, timestamp) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $message, $timestamp]);*/
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

