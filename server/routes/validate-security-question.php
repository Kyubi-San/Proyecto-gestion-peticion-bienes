<?php
    require '../db.php';

    $respuesta1 = $_POST['respuesta1'];
    $respuesta2 = $_POST['respuesta2'];
    $respuesta3 = $_POST['respuesta3'];
    $idUsuario = $_POST['idUsuario'];

    $stmt = $conn->prepare('SELECT * FROM pregunta_seguridad WHERE respuesta1 = :respuesta1 AND respuesta2 = :respuesta2 AND respuesta3 = :respuesta3 AND id_usuario = :idUsuario');
    $stmt->bindParam(":respuesta1", $respuesta1);
    $stmt->bindParam(":respuesta2", $respuesta2);
    $stmt->bindParam(":respuesta3", $respuesta3);
    $stmt->bindParam(":idUsuario", $idUsuario);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($record) {
        echo 'Respuestas correctas';
    }

?>