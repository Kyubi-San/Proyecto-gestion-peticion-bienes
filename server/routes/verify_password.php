<?php
require '../../src/assets/include/session_start.php';
require '../db.php';

    $password = htmlspecialchars($_POST['password']);
    $registro = $conn->prepare("SELECT contrasena FROM usuario WHERE n_dependencia =".$_SESSION['user_id']);
    $registro->execute();
    $resultado = $registro->fetch(PDO::FETCH_ASSOC);
    if ($resultado && password_verify($password, $resultado['contrasena'])) {
        echo "true";
    }
?>