<?php 

require 'assets/include/session_start.php';
require '../server/db.php';

  if (!isset($_SESSION['user_id']) || $records['admin'] < 1) {
    header('Location: login.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Bienes</title>
  <link rel="stylesheet" href="css/lista-bienes.css">
  <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <?php include 'assets/include/menu.php'?>
    <main class="main">
      <h2>Lista de todas las solicitudes</h2>
        <input type="text" id="filterId" placeholder="Ingrese ID a filtrar" />
        <button class="button" onclick="filterById()">Filtrar</button>
        <table id="goodsTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Solicitante</th>
              <th>Fecha Solicitud</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Tipo de Bien</th>
              <th>Comentarios</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Aquí se llenarán los bienes -->
            <?php
            foreach ($conn->query('SELECT * from solicitudes INNER JOIN usuario ON solicitudes.id_usuario = usuario.n_dependencia WHERE aprobado = 0') as $row):
            ?>
            <tr>
              <td><?php echo htmlspecialchars($row['n_solicitud']); ?></td>
              <td><?php echo htmlspecialchars($row['nombre_dependencia']); ?></td>
              <td><?php echo htmlspecialchars($row['fecha_solicitud']); ?></td>
              <td><?php echo htmlspecialchars($row['bien']); ?></td>
              <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
              <td><?php echo htmlspecialchars($row['tipo_bien']); ?></td>
              <td><?php echo htmlspecialchars($row['comentario']); ?></td>
              <td>
                <a href="gestion-solicitudes.php?id=<?php echo $row['n_solicitud']?>" class="table__icon--check" title="Aprobar"><i class="fa-solid fa-check"></i></a>
                                            /
                <a href="" class="table__icon--decline" title="Rechazar"><i class="fa-solid fa-xmark"></i></a>
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