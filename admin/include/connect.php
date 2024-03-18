<?php
$host = 'localhost';
$name = 'alerte-mns';
$username = 'root';
$password = '';

try {

    $db = new PDO("mysql:host=".$host.";dbname=".$name.";charset=utf8", $username, $password);

} catch (Exception $e) {

    die("Error:". $e->getMessage());

}
?>