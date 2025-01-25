<?php

require '../server/db.php';
require 'assets/include/session_start.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if ($_POST) {
    $tipo_bien = htmlspecialchars($_POST['tipo_bien']);
    $descripcion = htmlspecialchars($_POST['bienSpec']) .' '.htmlspecialchars($_POST['tipo-informacion']);
    $comentario = htmlspecialchars($_POST['comentario']);
    $password = htmlspecialchars($_POST['password']);
    $responsible = $_SESSION['user_id'];
    echo $descripcion;

    if (!empty($bien) && !empty($tipo_bien) && !empty($descripcion) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO solicitudes (bien, tipo_bien, descripcion, comentario, id_usuario) VALUES (:bien, :tipo_bien, :descripcion, :comentario, :responsible)");

        $stmt->bindParam(':bien', $bien);
        $stmt->bindParam(':tipo_bien', $tipo_bien);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':comentario', $comentario);
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
  <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
    <?php include 'assets/include/menu.php'?>
    <main class="main">
        <form action="" method="post" class="form" autocomplete="off">
            <h1>Solicitud De Bienes</h1>
            <label for="tipo_bien">Tipo de Bien:</label>
            <select id="tipo_bien" name="tipo_bien" required>
                <option value="" selected disabled>Categoria del bien a solicitar</option>
                <option value="Electronico">Electrónico</option>
                <option value="Mueble">Mueble</option>
                <option value="Herramienta">Herramienta</option>
            </select>
            
            <label for="descripcion">Descripción del Bien:</label>
            <div id="description-values">
            </div>

            <div id="description" disabled></div>
            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario"></textarea>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Solicitar">
        </form>
    </main>
    </div>
    <script src="js/solicitud-bienes.js"></script>
</body>
</html>