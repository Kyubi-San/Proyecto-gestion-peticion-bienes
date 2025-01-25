<?php

require '../server/db.php';
require 'assets/include/session_start.php';

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

// Asignar valores a las variables desde $_POST
    
    # Esquema de la tabla
  
      $stmt = $conn->prepare("INSERT INTO bienes (name, description, type, requestDate, comments, responsible) VALUES (:name, :description, :type, :requestDate, :comments, :responsable)");
      $stmt2 = $conn->prepare("UPDATE solicitudes SET aprobado = '1' WHERE n_solicitud = :id");
  
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
          <div>
            <label for="">ID:</label>
            <input
            type="number"
            value="<?php echo $id;?>"
            id="newId"
            placeholder="ID del bien"
            min="1"
            name="id"
            disabled
           />
          </div>
          <div>
            <label for="">Nombre del bien:</label>
            <input type="text" value="<?php echo $name;?>" name="name" id="newName" placeholder="Nombre del bien"/>
          </div>
          <div>
            <label for="">Descripcion:</label>
            <input type="text" value="<?php echo $description;?>" name="description" id="newDescription" placeholder="Descripción"/>
          </div>
        </div>

        <div class="form-group">
            <div>
                <label for="newType">Tipo de Bien:</label>
                <select id="newType" name="type">
                <option value="<?php echo $type;?>" selected><?php echo $type;?></option>
                <option value="Electrónico">Electrónico</option>
                <option value="Mueble">Mueble</option>
                <option value="Vehículo">Vehículo</option>
                <option value="Herramienta">Herramienta</option>
                </select>
            </div>
            <div>
                <label for="newType">Responsable:</label>
                <select name="" id="" name="responsible">
                    <option value="<?php echo $responsible;?>" selected><?php echo $responsible;?></option>
                    <?php
                        foreach ($conn->query('SELECT * from usuario') as $row) {
                            echo '<option value="'.$row['n_dependencia'].'">'.$row['nombre_dependencia'].'</option>';
                        }
                        ?>
                </select>
            </div>
            <div>
              <label for="newType">Comentario:</label>
              <input type="text" value="<?php echo $comments;?>" id="comments" placeholder="Comentarios" name="comments"/>
            </div>
        </div>
        
        <div class="form-group">
            <div>
                <label for="requestDate">Fecha de Solicitud:</label>
                <input type="date" value="<?php echo $requestDate;?>" name="requestDate" id="requestDate" />
            </div>
        </div>
        <div class="form-group">
          <button class="form-button" type="submit">Aceptar Solicitud</button>
          <a href="lista-solicitudes.php" class="form-button">Volver</a>
        </div>        
      </form>
      
      </main>
    </div>
    <script src="js/gestion-solicitudes.js"></script>
  </body>
</html>
