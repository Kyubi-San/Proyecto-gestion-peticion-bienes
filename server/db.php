<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'contraloria_db';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

if (isset($_SESSION["user_id"])) {
  $records = $conn->prepare("SELECT username, nombre, contrasena, admin FROM usuario WHERE n_dependencia =".$_SESSION['user_id']); 
  # acordarme de corregir esto
  $records->execute();
  $records = $records->fetch(PDO::FETCH_ASSOC);
}

?>