<?php

require '../db.php';

$n_solicitud = $_POST['n_solicitud'];
$stmt = $conn->prepare('DELETE FROM solicitudes WHERE n_solicitud = :n_solicitud');
$stmt->bindParam(':n_solicitud', $n_solicitud);

$stmt2 = $conn->prepare('DELETE FROM notificaciones WHERE id_solicitud = :n_solicitud');
$stmt2->bindParam(':n_solicitud', $n_solicitud);

try {
    $stmt->execute();
    $stmt2->execute();
} catch (\Throwable $th) {
    echo "Error al eliminar la solicitud";
}
?>