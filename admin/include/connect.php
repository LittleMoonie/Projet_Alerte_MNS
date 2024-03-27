<?php
$host = 'localhost'; // 5.250.177.216
$name = 'alerte-mns';
$username = 'root'; // alerte-mns
$password = ''; // 02AlertemnsLMR?!

try {        
    $db = new PDO("mysql:host=".$host.";dbname=".$name.";charset=utf8", $username, $password);
} catch (Exception $e) {
    die("Error:". $e->getMessage());
}
?>