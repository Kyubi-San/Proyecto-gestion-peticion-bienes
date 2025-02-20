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
          <span class="main__header-currentDir"><a href="#menu-estate" class="main__header-currentDir--pre">Bienes</a> / Mis bienes</span>
          <h2>Mis bienes</h2>
        </div>
    </header>
    <main class="main">
        <?php include 'assets/include/filters.php' ?>
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
              <h4>Mis Bienes</h4>
              <span class="myEstates__header-total">Total: <?php
              $query = $conn->query("SELECT COUNT(*) as total FROM bienes WHERE withdrawalDate = '0000-00-00' AND responsible =".$_SESSION['user_id']);
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
                <p>Oh, parece que aun no tienes ningun bien</p>
                <i class="fa-solid fa-ghost"></i>
              </div>';
            }
          ?>
          <table id="goodsTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de Bien</th>
                <th>Fecha Solicitud</th>
                <th>Fecha Aprobación</th>
                <th class="table-actions">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí se llenarán los bienes -->
              <?php
              foreach ($conn->query('SELECT * from bienes WHERE withdrawalDate = "0000-00-00" AND responsible ='.$_SESSION["user_id"]) as $row):
              ?>
              <tr class="table-dates estate__item">
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['type']); ?></td>
                <td><?php echo htmlspecialchars($row['requestDate']); ?></td>
                <td><?php echo htmlspecialchars($row['approvalDate']); ?></td>
                <td class="table-actions">
                  <a href="solicitud-desincorporacion.php?id=<?php echo $row['id'];?>" title='Eliminar'><i class="fa-solid fa-trash table__icon--delete"></i></a>
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