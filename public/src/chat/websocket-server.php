<?php
require __DIR__ . '/../../../vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat_Websocket;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat_Websocket()
        )
    ),
    8080
);

$server->run();
?>