<?php 

require 'assets/include/session_start.php';
require '../server/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Bienes</title>
  <link rel="stylesheet" href="css/lista-bienes.css">
  <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <?php include 'assets/include/menu.php'?>
    <main class="main">
      <h2>Mis Bienes</h2>
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
              <th>Comentarios</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Aquí se llenarán los bienes -->
            <?php
            foreach ($conn->query('SELECT * from bienes WHERE responsible ='.$_SESSION["user_id"]) as $row):
            ?>
            <tr>
              <td><?php echo htmlspecialchars($row['id']); ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['description']); ?></td>
              <td><?php echo htmlspecialchars($row['type']); ?></td>
              <td><?php echo htmlspecialchars($row['requestDate']); ?></td>
              <td><?php echo htmlspecialchars($row['approvalDate']); ?></td>
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
      </main>
  </div>
</body>
</html>