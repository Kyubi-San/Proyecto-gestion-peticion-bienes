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
  <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
  <link rel="stylesheet" href="css/lista-bienes.css">
  <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
  <script src="js/desplegar-tabla.js"></script>
</head>
<body>
  <div class="container">
    <?php include 'assets/include/menu.php'?>
    <header class="main__header">
      <i class="fas fa-file-alt"></i>
        <div class="main__header-title">
          <span class="main__header-currentDir"><a href="#menu-request" class="main__header-currentDir--pre">Solicitudes</a> / Solicitudes rechazadas</span>
          <h2>Solicitudes rechazadas</h2>
        </div>
    </header>
    <main class="main">
      <?php include 'assets/include/filters.php'; ?>
        <section class="myEstates">
        <div class="myEstates__header">
            <div class="myEstates__header-title">
              <img src="assets/logo-contraloria.jpg" class="myEstates__header-logo" alt="">
              <div class="myEstates__header-data">
                <b>Contraloria municipal de Guanipa</b>
                <span>Sistema de solicitud y gestion de bienes</span>
              </div>
            </div>
            <div class="myEstates__header-info">
              <h4>Solicitudes rechazadas</h4>
              <span class="myEstates__header-total">Total: <?php
              $query = $conn->query("SELECT COUNT(*) as total FROM solicitudes WHERE aprobado < 0");
              $row = $query->fetch(PDO::FETCH_ASSOC);
              echo $row['total'];
              ?></span>
            </div>
          </div>
          <?php
            $query = $conn->query("SELECT COUNT(*) as total FROM solicitudes WHERE aprobado < 0");
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row['total'] < 1) {
              echo '
              <div class="myEstate__message">
                <p>Ninguna solicitud a sido rechazada</p>
                <i class="fa-solid fa-ghost"></i>
              </div>';
            }
          ?>
          <table id="goodsTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Solicitante</th>
                <th>Fecha Solicitud</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de Bien</th>
                <th>Comentario</th>
                <th>Motivo de rechazo</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí se llenarán los bienes -->
              <?php
              foreach ($conn->query('SELECT * from solicitudes INNER JOIN usuario ON solicitudes.id_usuario = usuario.n_dependencia WHERE aprobado < 0') as $row):
              ?>
              <tr class="table-dates estate__item">
                <td class="estates-id"><?php echo htmlspecialchars($row['n_solicitud']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre_dependencia']); ?></td>
                <td class="estates-request"><?php echo htmlspecialchars($row['fecha_solicitud']); ?></td>
                <td class="estates-name"><?php echo htmlspecialchars($row['bien']); ?></td>
                <td class="estates-description"><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td class="estates-type"><?php echo htmlspecialchars($row['tipo_bien']); ?></td>
                <td><?php echo htmlspecialchars($row['comentario']); ?></td>
                <td><?php echo htmlspecialchars($row['comentario_admin']); ?></td>
              </tr>
              <?php
              endforeach;?>
            </tbody>
          </table>
        </section>
      </main>
  </div>
  <script src="js/filters.js"></script>
</body>
</html>