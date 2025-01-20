<?php

require '../server/db.php';

foreach ($conn->query('SELECT * from bienes WHERE id ='.$_GET["id"]) as $row) {
    $id = $row['id'];
    $name = $row['name'];
    $description = $row['description'];
    $type = $row['type'];
    $requestDate = $row['requestDate'];
    $approvalDate = $row['approvalDate'];
    $withdrawalDate = $row['withdrawalDate'];
    $comments = $row['comments'];
    $responsible = $row['responsible'];

}

if ($_POST) {
# Esquema de la tabla
    $id = $id;
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $type = htmlspecialchars($_POST['type']);
    $requestDate = htmlspecialchars($_POST['requestDate']);
    $approvalDate = htmlspecialchars($_POST['approvalDate']);
    $withdrawalDate = htmlspecialchars($_POST['withdrawalDate']);
    $comments = htmlspecialchars($_POST['comments']);
    $responsible = htmlspecialchars($_POST['responsible']);

    if (!empty($id) && !empty($name) && !empty($description) && !empty($type) && !empty($comments)) {
        $stmt = $conn->prepare("UPDATE bienes SET requestDate = :requestDate, approvalDate = :approvalDate, comments = :comments, name = :name, type = :type, description = :description, withdrawalDate = :withdrawalDate, responsible = :responsible WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':requestDate', $requestDate);
        $stmt->bindParam(':approvalDate', $approvalDate);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':withdrawalDate', $withdrawalDate); 
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/gestion-bienes.css" />
    <title>Gestión de Solicitudes</title>
  </head>
  <body>
    <div class="container">
        <h1>Gestión de Solicitudes</h1>
        <h2>Actualizar Bien</h2>

      <form action="" class="form" method="POST">
        <div class="form-group">
            <input
            type="number"
            value="<?php echo $id;?>"
            id="newId"
            placeholder="ID del bien"
            min="1"
            name="id"
            disabled/>
            <input type="text" value="<?php echo $name;?>" name="name" id="newName" placeholder="Nombre del bien" />
            <input type="text" value="<?php echo $description;?>" name="description" id="newDescription" placeholder="Descripción" />
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
                    <option value="<?php echo $responsible;?>" selected disabled><?php echo $responsible;?></option>
                    <?php
                        foreach ($conn->query('SELECT * from usuario') as $row) {
                            echo '<option value="'.$row['n_dependencia'].'">'.$row['nombre_dependencia'].'</option>';
                        }
                        ?>
                </select>
            </div>
            <input type="text" value="<?php echo $comments;?>" id="comments" placeholder="Comentarios" name="comments"/>
        </div>
        
        <div class="form-group">
            <div>
                <label for="requestDate">Fecha de Solicitud:</label>
                <input type="date" value="<?php echo $requestDate;?>" name="requestDate" id="requestDate" />
            </div>
            <div>
                <label for="approvalDate">Fecha de Aprobación:</label>
                <input type="date" value="<?php echo $approvalDate;?>" name="approvalDate" id="approvalDate" />
            </div>
            <div>
                <label for="withdrawalDate">Fecha de Retiro:</label>
                <input type="date" value="<?php echo $withdrawalDate;?>" name="withdrawalDate" id="withdrawalDate" />
            </div>
        </div>
        <div class="form-group">
            <button class="form-button" type="submit">Guardar</button>
        </div>        
      </form>
      <h2>Lista de Bienes</h2>
      <input type="text" id="filterId" placeholder="Ingrese ID a filtrar" />
      <button class="button" onclick="filterById()">Filtrar</button>
      <table id="goodsTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo de Bien</th>
            <th>Fecha Solicitud</th>
            <th>Fecha Aprobación</th>
            <th>Fecha Retiro</th>
            <th>Responsable</th>
            <th>Comentarios</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí se llenarán los bienes -->
           <?php
          foreach ($conn->query('SELECT * from bienes') as $row):
          ?>
          <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['type']); ?></td>
            <td><?php echo htmlspecialchars($row['requestDate']); ?></td>
            <td><?php echo htmlspecialchars($row['approvalDate']); ?></td>
            <td><?php echo htmlspecialchars($row['withdrawalDate']); ?></td>
            <td><?php echo htmlspecialchars($row['responsible']); ?></td>
            <td><?php echo htmlspecialchars($row['comments']); ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a>
              <a href="delete.php?id=<?php echo $row['id']; ?>">Eliminar</a>
            </td>
          </tr>
          <?php
          endforeach;?>
        </tbody>
      </table>
    </div>
  </body>
</html>
