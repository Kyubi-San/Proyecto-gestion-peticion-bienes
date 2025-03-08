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
      <i class="fas fa-box"></i>
        <div class="main__header-title">
          <span class="main__header-currentDir"><a href="#menu-estate" class="main__header-currentDir--pre">Bienes</a> / Lista de bienes</span>
          <h2>Lista de todos los bienes</h2>
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
              <h4>Todos los Bienes</h4>
              <span class="myEstates__header-total">Total: <?php
              $query = $conn->query("SELECT COUNT(*) as total FROM bienes WHERE withdrawalDate = '0000-00-00'");
              $row = $query->fetch(PDO::FETCH_ASSOC);
              echo $row['total'];
              ?></span>
            </div>
          </div>
          <?php
            $query = $conn->query("SELECT COUNT(*) as total FROM bienes WHERE responsible =".$_SESSION['user_id']);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row['total'] < 1) {
              echo '
              <div class="myEstate__message">
                <p>Oh, parece que nadie a realizado alguna solicitud aun</p>
                <i class="fa-solid fa-ghost"></i>
              </div>';
            }
          ?>
          <table id="miTabla">
            <thead>
              <tr>
                <th id="order-id">ID</th>
                <th id="order-responsible">Responsable</th>
                <th id="order-name">Nombre</th>
                <th id="order-description">Descripción</th>
                <th id="order-type">Tipo de Bien</th>
                <th id="order-requestDate">Fecha Solicitud</th>
                <th id="order-approvalDate">Fecha Aprobación</th>
                <th class="table-actions">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí se llenarán los bienes -->
              <?php
              foreach ($conn->query('SELECT * from bienes INNER JOIN usuario ON bienes.responsible = usuario.n_dependencia WHERE withdrawalDate = "0000-00-00" ORDER BY name') as $row):
              ?>
              <tr class="table-dates estate__item">
                <td class="estates-id"><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre_dependencia']); ?></td>
                <td class="estates-name"><?php echo htmlspecialchars($row['name']); ?></td>
                <td class="estates-description"><?php echo htmlspecialchars($row['description']); ?></td>
                <td class="estates-type"><?php echo htmlspecialchars($row['type']); ?></td>
                <td class="estates-request"><?php echo htmlspecialchars($row['requestDate']); ?></td>
                <td><?php echo htmlspecialchars($row['approvalDate']); ?></td>
                <td class="table-actions">
                  <a href="solicitud-desincorporacion.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash table__icon--delete"></i></a>
                </td>
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