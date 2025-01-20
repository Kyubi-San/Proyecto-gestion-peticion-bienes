<?php

require '../server/db.php';
require 'assets/include/session_start.php';



if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if ($_POST) {
    $bien = htmlspecialchars($_POST['bien']);
    $tipo_bien = htmlspecialchars($_POST['tipo_bien']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $comentario = htmlspecialchars($_POST['comentario']);
    $fecha = htmlspecialchars($_POST['fecha']);
    $password = htmlspecialchars($_POST['password']);
    $responsible = $_SESSION['user_id'];

    if (!empty($bien) && !empty($tipo_bien) && !empty($descripcion) && !empty($fecha) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO solicitudes (bien, tipo_bien, descripcion, comentario, fecha_solicitud, id_usuario) VALUES (:bien, :tipo_bien, :descripcion, :comentario, :fecha, :responsible)");

        $stmt->bindParam(':bien', $bien);
        $stmt->bindParam(':tipo_bien', $tipo_bien);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':responsible', $responsible);

        try {
          $stmt->execute();

        } catch (\Throwable $th) {
            echo "Error al insertar el bien";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud De Bienes</title>
    <link rel="stylesheet" href="css/solicitud-bienes.css">
</head>
<body>
    <form action="" method="post">
        <h1>Solicitud Del Bien</h1>
        <label for="bien">Nombre del Bien:</label>
        <input type="text" id="bien" name="bien" required>
        
        <label for="tipo_bien">Tipo de Bien:</label>
        <select id="tipo_bien" name="tipo_bien" required>
            <option value="Electronico">Electrónico</option>
            <option value="Mueble">Mueble</option>
            <option value="Herramienta">Herramienta</option>
        </select>
        
        <label for="descripcion">Descripción del Bien:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        
        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario"></textarea>
        
        <label for="fecha">Fecha de Solicitud:</label>
        <input type="date" id="fecha" name="fecha" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" value="Solicitar">
    </form>
</body>
</html>