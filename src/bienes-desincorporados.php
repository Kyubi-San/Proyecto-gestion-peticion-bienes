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
</head>
<body>
  <div class="container">
    <?php include 'assets/include/menu.php'?>
    <header class="main__header">
      <i class="fas fa-box"></i>
        <div class="main__header-title">
          <span class="main__header-currentDir"><a href="#menu-estate" class="main__header-currentDir--pre">Bienes</a > / Mis bienes</span>
          <h2>Mis bienes desincorporados</h2>
        </div>
    </header>
    <main class="main">
        <?php include 'assets/include/filters.php' ?>
        <section class="myEstates">
          <?php
            $query = $conn->query("SELECT COUNT(*) as total FROM bienes WHERE withdrawalDate != '0000-00-00' AND responsible =".$_SESSION['user_id']);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row['total'] < 1) {
              echo '
              <div class="myEstate__message">
                <p>No tienes ningun bien desincorporado</p>
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
                <th>Fecha de retiro</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí se llenarán los bienes -->
              <?php
              foreach ($conn->query('SELECT * from bienes WHERE withdrawalDate != "0000-00-00" AND responsible ='.$_SESSION["user_id"]) as $row):
              ?>
              <tr class="table-dates">
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['type']); ?></td>
                <td><?php echo htmlspecialchars($row['requestDate']); ?></td>
                <td><?php echo htmlspecialchars($row['approvalDate']); ?></td>
                <td><?php echo htmlspecialchars($row['withdrawalDate']); ?></td>
                <td>
                  <a href=".php?id=<?php echo $row['id']; ?>">Editar</a>
                  <a href="retiro-bien.php?id=<?php echo $row['id']; ?>">Eliminar</a>
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