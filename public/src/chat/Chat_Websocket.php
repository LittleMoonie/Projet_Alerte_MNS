<?php
namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat_Websocket implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        // Ensure the resourceId property exists before trying to access it
        $resourceId = property_exists($conn, 'resourceId') ? $conn->resourceId : 'unknown';
        echo "New connection! ({$resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            // if ($from !== $client) {
            //     // Optionally, only send to clients other than the sender.
            //     $client->send($msg);
            // } else {
            //     // For debugging, you can send a confirmation back to the sender.
            //     $client->send("Message received: " . $msg);
            // }
            $client -> send($msg);
        }
    }    

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        // Ensure the resourceId property exists before trying to access it
        $resourceId = property_exists($conn, 'resourceId') ? $conn->resourceId : 'unknown';
        echo "Connection {$resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
