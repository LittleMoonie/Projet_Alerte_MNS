<?php
$host = '5.250.177.216';
$name = 'alerte-mns';
$username = 'root';
$password = 'i9vgQYzEemj5C6';

try {
    $db = new PDO("mysql:host=".$host.";dbname=".$name.";charset=utf8", $username, $password);
} catch (Exception $e) {
    die("Error:". $e->getMessage());
}
?>