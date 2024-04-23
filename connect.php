<?php

$user = 'root';
$pass = '';
$db = 'reviewsystems';

$connection = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>