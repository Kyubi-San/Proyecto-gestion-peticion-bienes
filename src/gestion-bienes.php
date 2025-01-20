<?php

require '../server/db.php';

if ($_POST) {
# Esquema de la tabla
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $type = htmlspecialchars($_POST['type']);
    $requestDate = htmlspecialchars($_POST['requestDate']);
    $approvalDate = htmlspecialchars($_POST['approvalDate']);
    $withdrawalDate = htmlspecialchars($_POST['withdrawalDate']);
    $comments = htmlspecialchars($_POST['comments']);

    if (!empty($id) && !empty($name) && !empty($description) && !empty($type) && !empty($comments)) {
        $stmt = $conn->prepare("INSERT INTO bienes (id, requestDate, approvalDate, comments, name, type, description, withdrawalDate) VALUES (:id, :requestDate, :approvalDate, :comments, :name, :type, :description, :withdrawalDate)");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':requestDate', $requestDate);
        $stmt->bindParam(':approvalDate', $approvalDate);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':withdrawalDate', $withdrawalDate);      

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/gestion-bienes.css" />
    <title>Gestión de Solicitudes</title>
  </head>
  <body>
    <div class="container">
        <h1>Gestión de Solicitudes</h1>
        <h2>Agregar Bien</h2>

      <form action="" class="form" method="POST">
        <div class="form-group">
            <input
            type="number"
            id="newId"
            placeholder="ID del bien"
            min="1"
            name="id"/>
            <input type="text" name="name" id="newName" placeholder="Nombre del bien" />
            <input type="text" name="description" id="newDescription" placeholder="Descripción" />
        </div>

        <div class="form-group">
            <div>
                <label for="newType">Tipo de Bien:</label>
                <select id="newType" name="type">
                <option value="" selected disabled>Seleccione un tipo</option>
                <option value="Electrónico">Electrónico</option>
                <option value="Mueble">Mueble</option>
                <option value="Vehículo">Vehículo</option>
                <option value="Herramienta">Herramienta</option>
                </select>
            </div>
            <div>
                <label for="newType">Responsable:</label>
                <select name="" id="" name="responsible">
                    <option value="" selected disabled>Seleccione una dependencia</option>
                    <?php
                        foreach ($conn->query('SELECT * from usuario') as $row) {
                            echo '<option value="'.$row['n_dependencia'].'">'.$row['nombre_dependencia'].'</option>';
                        }
                        ?>
                </select>
            </div>
            <input type="text" id="comments" placeholder="Comentarios" name="comments"/>
        </div>
        
        <div class="form-group">
            <div>
                <label for="requestDate">Fecha de Solicitud:</label>
                <input type="date" name="requestDate" id="requestDate" />
            </div>
            <div>
                <label for="approvalDate">Fecha de Aprobación:</label>
                <input type="date" name="approvalDate" id="approvalDate" />
            </div>
            <div>
                <label for="withdrawalDate">Fecha de Retiro:</label>
                <input type="date" name="withdrawalDate" id="withdrawalDate" />
            </div>
        </div>
        <div class="form-group">
            <button class="form-button" type="submit">Guardar</button>
        </div>        
      </form>
    </div>
  </body>
</html>
