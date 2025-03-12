<?php

require '../db.php';

$email = htmlspecialchars($_POST['email']);
$stmt = $conn->prepare("SELECT correo, n_dependencia FROM usuario WHERE correo = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $n_dependencia = $resultado['n_dependencia'];
    $stmt2 = $conn->prepare("SELECT pregunta1, pregunta2, pregunta3 FROM pregunta_seguridad WHERE id_usuario = :n_dependencia");
    $stmt2->bindParam(':n_dependencia', $n_dependencia);
    $stmt2->execute();
    $securityQuestion = $stmt2->fetch(PDO::FETCH_ASSOC);
    echo($securityQuestion['pregunta1']."-");
    echo($securityQuestion['pregunta2']."-");
    echo($securityQuestion['pregunta3']."-");
    echo($n_dependencia);
}

?>