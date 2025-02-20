<?php

require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id']) || $records['admin'] < 1) {
  header('Location: login.php');
}

// Se genera el id que sera usado al insertar el bien

function generateID($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
$uuid = generateID(10);

// Seleccionar la solicitud que tenga el mismo id que la variable $_GET["id"] traida desde el navegador

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

if ($approbed == 1) {
  header('Location: login.php');
}

if ($_POST) {
    
    # Esquema de la tabla
  
      $stmt = $conn->prepare("INSERT INTO bienes (id, name, description, type, requestDate, comments, responsible) VALUES (:uuid, :name, :description, :type, :requestDate, :comments, :responsable)");
      $stmt2 = $conn->prepare("UPDATE solicitudes SET aprobado = '1' WHERE n_solicitud = :id");
  
      $stmt->bindParam(':uuid', $uuid);
      $stmt->bindParam(':requestDate', $requestDate);
      $stmt->bindParam(':comments', $comments);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':type', $type);
      $stmt->bindParam(':description', $description); 
      $stmt->bindParam(':responsable', $responsable);  
      $stmt2->bindParam(':id', $id);
      
      try {
        $stmt->execute();
        $stmt2->execute();
        header('Location: lista-bienes.php');
  
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

      <form action="" class="form" method="POST" id="form">
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
          <label for="">Nombre del bien:</label>
          <span class="form__input"><?php echo $name;?></span>
          <input type="hidden" value="<?php echo $name;?>" name="name">
        </div>
        <div class="form-group">
          <label for="">Descripcion:</label>
          <span class="form__input"><?php echo $description;?></span>
          <input type="hidden" name="description" value="<?php echo $description;?>">
        </div>
        
        <div class="form-group">
            <label for="newType">Tipo de Bien:</label>
            <select id="newType" name="type" class="form__input">
              <option value="<?php echo $type;?>" selected><?php echo $type;?></option>
            </select>
        </div>
        <div class="form-group">
            <label for="newType">Responsable:</label>
            <select name="" id="" name="responsible" class="form__input">
                <option value="<?php echo $responsible;?>" selected><?php echo $responsible;?></option>
            </select>
        </div>
        <div class="form-group">
          <label for="newType">Comentario:</label>
          <span class="form__input"><?php echo $comments;?></span>
          <input type="hidden" name="comments" value="<?php echo $comments;?>">
        </div>
    
        <div class="form-group">
            <label for="requestDate">Fecha de Solicitud:</label>
            <span class="form__input"><?php echo $requestDate;?></span>
            <input type="hidden" name="requestDate">
        </div>
        <div class="form-group--button">
          <a href="solicitudes-pendientes.php" class="form-button">Volver</a>
          <button class="form-button form-button--accept" type="submit">Aceptar Solicitud</button>
        </div>        
    </form>
      
      </main>
    </div>
    <script src="js/gestion-solicitudes.js"></script>
  </body>
</html>
