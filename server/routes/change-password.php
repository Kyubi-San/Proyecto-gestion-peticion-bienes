<?php

require '../db.php';

$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];
$email = $_POST['email'];

if ($newPassword == $confirmPassword) {
    $password = password_hash($newPassword, PASSWORD_BCRYPT);

    $stmt = $conn->prepare('UPDATE usuario SET contrasena = :password WHERE correo = :email');
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo 'Contraseña actualizada';
}

?>