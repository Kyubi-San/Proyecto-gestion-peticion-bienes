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
  <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
  <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
  <script src="js/desplegar-tabla.js"></script>
</head>
<body>
  <div class="container">
    <?php include 'assets/include/menu.php'?>
    <header class="main__header">
      <i class="fas fa-file-alt"></i>
        <div class="main__header-title">
          <span class="main__header-currentDir"><a href="#menu-request" class="main__header-currentDir--pre">Solicitudes</a> / Mis solicitudes</span>
          <h2>Mis solicitudes</h2>
        </div>
    </header>
    <main class="main">
        <input type="text" id="filterId" placeholder="Ingrese ID a filtrar" />
        <button class="button" onclick="filterById()">Filtrar</button>
        <section class="myEstates">
          <?php
            $query = $conn->query("SELECT COUNT(*) as total FROM solicitudes WHERE id_usuario =".$_SESSION['user_id']);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row['total'] < 1) {
              echo '
              <div class="myEstate__message">
                <p>Aun no haz realizado ninguna solicitud</p>
                <i class="fa-solid fa-ghost"></i>
              </div>';
            }
          ?>
          <table id="goodsTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Fecha Solicitud</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de Bien</th>
                <th>Comentarios</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí se llenarán los bienes -->
              <?php
              foreach ($conn->query('SELECT * from solicitudes WHERE id_usuario ='.$_SESSION['user_id']) as $row):
              ?>
              <tr class="estate__item">
                <td><?php echo htmlspecialchars($row['n_solicitud']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_solicitud']); ?></td>
                <td><?php echo htmlspecialchars($row['bien']); ?></td>
                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($row['tipo_bien']); ?></td>
                <td><?php echo htmlspecialchars($row['comentario']); ?></td>
                <td>
                <?php
                  if ($row["aprobado"] == 1) {
                    echo '<span style="color:#27ae60;">Aprobado</span>';
                  } elseif ($row["aprobado"] == 0) {
                    echo '<span style="color:#34495e;">Pendiente</span>';
                  } else {
                    echo '<span style="color:#c0392b; text-wrap: nowrap;">Rechazado</span>';
                  }
                ?>
                </td>
              </tr>
              <?php
              endforeach;?>
            </tbody>
          </table>
        </section>
      </main>
  </div>
</body>
</html>