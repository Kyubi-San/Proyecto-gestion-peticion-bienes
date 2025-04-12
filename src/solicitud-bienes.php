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
    $responsible = $_SESSION['user_id'];

    $record = $conn->prepare("SELECT n_dependencia FROM usuario WHERE admin > 0");
    $record->execute();
    $receiver = $record->fetch(PDO::FETCH_ASSOC);
    
    if (!empty($bien) && !empty($tipo_bien) && !empty($descripcion) && !empty($comentario)) {
        $stmt = $conn->prepare("INSERT INTO solicitudes (bien, tipo_bien, descripcion, comentario, id_usuario) VALUES (:bien, :tipo_bien, :descripcion, :comentario, :responsible)");
        $stmt->bindParam(':bien', $bien);
        $stmt->bindParam(':tipo_bien', $tipo_bien);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':responsible', $responsible);
        try {
            $stmt->execute();
            $id_solicitud = $conn->lastInsertId();
            $stmt2 = $conn->prepare('INSERT INTO notificaciones (sender, receiver, type, message, id_solicitud) VALUES (:sender, :receiver, 1, "Solicito un nuevo bien", :id_solicitud)');
            $stmt2->bindParam(':sender', $responsible);
            $stmt2->bindParam(':receiver', $receiver['n_dependencia']);
            $stmt2->bindParam(':id_solicitud', $id_solicitud);
            $stmt2->execute();
        } catch (\Throwable $th) {
            echo "Error al insertar el bien o la notificación: " . $th->getMessage();
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
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/solicitud-bienes.css">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        
    <?php include 'assets/include/menu.php'; ?>
    <main class="main">
        <form action="" method="post" class="form" autocomplete="off">
            <h2>Solicitud De Bienes</h2>
            <h3>Ingresa los detalles</h3>
            <div class="input-container">
                <input type="text" id="bien" class="input" name="bien" placeholder=" ">
                <label for="bien" class="placeholder">Titulo</label>
            </div>

            <div class="input-container">
                <select id="tipo_bien" class="input" name="tipo_bien" required>
                    <option value="" selected disabled>Selecciona una categoria</option>
                    <option value="Electronico">Electrónico</option>
                    <option value="Mueble">Mueble</option>
                    <option value="Herramienta">Herramienta</option>
                    <option value="Otro">Otro...</option>
                </select>
                <label for="tipo_bien" class="placeholder--category">Categoria</label>
            </div>

            <textarea name="descripcion" placeholder="Descripcion" required></textarea>
            <label for="comentario">Comentario al administrador:</label>
            <textarea id="comentario" name="comentario" required></textarea>

            <?php echo isset($messageError) ? '<span class="message-error">'.$messageError.'</span>' : ''; ?>
            
            <div class="button__group">
                <a href="index.php" class="input__button input__button--cancel">Cancelar</a>
                <input type="submit" value="Solicitar" class="input__button">
            </div>
        </form>
    </main>
    </div>
    <script src="js/solicitud-bienes.js"></script>
</body>
</html>