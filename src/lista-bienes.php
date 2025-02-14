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
          <span class="main__header-currentDir"><a href="#menu-estate" class="main__header-currentDir--pre" onclick="deployItem(bienesItem, 0)">Bienes</a> / Lista de bienes</span>
          <h2>Lista de todos los bienes</h2>
        </div>
    </header>
    <main class="main">
        <?php include 'assets/include/filters.php'; ?>
        <section class="myEstates">
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
          <table id="goodsTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Responsable</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de Bien</th>
                <th>Fecha Solicitud</th>
                <th>Fecha Aprobación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí se llenarán los bienes -->
              <?php
              foreach ($conn->query('SELECT * from bienes INNER JOIN usuario ON bienes.responsible = usuario.n_dependencia') as $row):
              ?>
              <tr class="table-dates estate__item">
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre_dependencia']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['type']); ?></td>
                <td><?php echo htmlspecialchars($row['requestDate']); ?></td>
                <td><?php echo htmlspecialchars($row['approvalDate']); ?></td>
                <td>
                  <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                  <a href="delete.php?id=<?php echo $row['id']; ?>">Eliminar</a>
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