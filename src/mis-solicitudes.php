<?php 

require 'assets/include/session_start.php';
require '../server/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis solicitudes</title>
  <link rel="stylesheet" href="css/lista-bienes.css">
  <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <?php include 'assets/include/menu.php'?>
    <main class="main">
      <h2>Mis Solicitudes</h2>
        <input type="text" id="filterId" placeholder="Ingrese ID a filtrar" />
        <button class="button" onclick="filterById()">Filtrar</button>
        <table id="goodsTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Fecha Solicitud</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Tipo de Bien</th>
              <th>Comentarios</th>
            </tr>
          </thead>
          <tbody>
            <!-- Aquí se llenarán los bienes -->
            <?php
            foreach ($conn->query('SELECT * from solicitudes WHERE id_usuario ='.$_SESSION['user_id']) as $row):
            ?>
            <tr>
              <td><?php echo htmlspecialchars($row['n_solicitud']); ?></td>
              <td><?php echo htmlspecialchars($row['fecha_solicitud']); ?></td>
              <td><?php echo htmlspecialchars($row['bien']); ?></td>
              <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
              <td><?php echo htmlspecialchars($row['tipo_bien']); ?></td>
              <td><?php echo htmlspecialchars($row['comentario']); ?></td>
            </tr>
            <?php
            endforeach;?>
          </tbody>
        </table>
      </main>
  </div>
</body>
</html>