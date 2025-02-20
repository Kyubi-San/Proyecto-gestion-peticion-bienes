<?php

require '../db.php';
require '../../src/assets/include/session_start.php';

if ($_POST) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $cedula = htmlspecialchars($_POST['cedula']);
    $responsible = $_SESSION['user_id'];

    if (!empty($nombre) && !empty($apellido) && !empty($cedula)) {
        $stmt = $conn->prepare("UPDATE usuario SET nombre = :nombre, apellido = :apellido, cedula = :cedula WHERE n_dependencia = :responsible");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':responsible', $responsible);
        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo "Error al actualizar los datos";
        }
    }
}

?>