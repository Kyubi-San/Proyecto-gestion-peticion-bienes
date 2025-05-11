<?php

require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id']) || $records['admin'] < 1) {
  header('Location: login.php');
}

$query = $conn->query('SELECT * from solicitudes INNER JOIN usuario ON solicitudes.id_usuario = usuario.n_dependencia WHERE n_solicitud ='.$_GET["id"]);
$row = $query->fetch(PDO::FETCH_ASSOC);

$id = $row['n_solicitud'];
$name = $row['bien'];
$description = $row['descripcion'];
$type = $row['tipo_bien'];
$requestDate = $row['fecha_solicitud'];
$comments = $row['comentario'];
$responsible = $row['nombre_dependencia'];
$responsable = $row['id_usuario'];
$approbed = $row['aprobado'];

$sender = $_SESSION['user_id'];
$message = 'Rechazo tu solicitud de '.$name;

if ($approbed == 1) {
  header('Location: login.php');
}

if ($_POST) {

  $commentAdmin = $_POST["commentAdmin"];

// Asignar valores a las variables desde $_POST

  $stmt = $conn->prepare("UPDATE solicitudes SET aprobado = '-1', comentario_admin = :commentAdmin WHERE n_solicitud = :id");  
  $stmt2 = $conn->prepare('INSERT INTO notificaciones (sender, receiver, type, message) VALUES (:sender, :receiver, 2, :message)');
  $stmt3 = $conn->prepare("DELETE FROM notificaciones WHERE id_solicitud = :id AND type = 1");

  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':commentAdmin', $commentAdmin);

  $stmt2->bindParam(':receiver', $responsable);
  $stmt2->bindParam(':sender', $sender);
  $stmt2->bindParam(':message', $message);

  $stmt3->bindParam(':id', $id);

      try {
        $stmt->execute();
        $stmt2->execute();
        $stmt3->execute();
        header('Location: solicitudes-rechazadas.php');
  
      } catch (\Throwable $th) {
          echo "Error al insertar el bien";
      }
  }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Solicitudes</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/gestion-bienes.css" />
    <script src="js/sweetalert2.js"></script>
  </head>
  <body>
    <div class="container">
      <?php include 'assets/include/menu.php'?>
      <main class="main">
      <div class="form-container">
        <h2>Rechazar solicitud</h2>
        <form action="" class="form" method="POST" id="form">
            <div class="input-container--name">
              <label for="">Nombre del bien:</label>
              <input type="text" class="form__input" value="<?php echo $name;?>" name="name" id="newName" placeholder="Nombre del bien"/>
            </div>
            <div class="form-group">
              <label for="">ID:</label>
              <input
              type="number"
              value="<?php echo $id;?>"
              id="newId"
              placeholder="ID del bien"
              min="1"
              name="id"
              disabled
              class="form__input"
            />
            </div>
            <div class="form-group">
              <label for="">Descripcion:</label>
              <input type="text" class="form__input" value="<?php echo $description;?>" name="description" id="newDescription" placeholder="Descripción"/>
            </div>
            <div class="form-group">
                <label for="newType">Tipo de Bien:</label>
                <select id="newType" name="type" class="form__input">
                  <option value="<?php echo $type;?>" selected><?php echo $type;?></option>
                </select>
            </div>
            <div class="form-group">
              <label for="newType">Responsable:</label>
              <select name="responsible" id="" name="responsible" class="form__input">
                  <option value="<?php echo $responsible;?>" selected><?php echo $responsible;?></option>
              </select>
            </div>
            <div class="form-group">
              <label for="newType">Comentario:</label>
              <input type="text" class="form__input" value="<?php echo $comments;?>" id="comments" placeholder="Comentarios" name="comments"/>
            </div>
            <div class="input-container--description">
              <label for="newType">Añadir un comentario al usuario:</label>
              <textarea class="form__input" id="commentAdmin" placeholder="Comentario de porque se rechaza la solicitud" name="commentAdmin"></textarea>
            </div>
            <div class="form-group--button">
              <a href="solicitudes-pendientes.php" class="form-button">Cancelar</a>
              <button class="form-button form-button--decline" type="submit">Rechazar Solicitud</button>
            </div>        
        </form>
      </div>
      </main>
    </div>
    <script src="js/gestion-solicitudes.js"></script>
  </body>
</html>
