<?php
include_once 'database.php';
include_once 'user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// Handle user deletion...
?>
