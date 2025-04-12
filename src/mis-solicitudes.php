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
  <script src="js/sweetalert2.js"></script>
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
      <?php include 'assets/include/filters.php'?>
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
              <h4>Mis solicitudes</h4>
              <span class="myEstates__header-total">Total: <?php
              $query = $conn->query("SELECT COUNT(*) as total FROM solicitudes WHERE id_usuario =".$_SESSION['user_id']);
              $row = $query->fetch(PDO::FETCH_ASSOC);
              echo $row['total'];
              ?></span>
            </div>
          </div>
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
                <th>N°</th>
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
              <tr class="table-dates estate__item">
                <td class="estates-id"><?php echo htmlspecialchars($row['n_solicitud']); ?></td>
                <td class="estates-request"><?php echo htmlspecialchars($row['fecha_solicitud']); ?></td>
                <td class="estates-name"><?php echo htmlspecialchars($row['bien']); ?></td>
                <td class="estates-description"><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td class="estates-type"><?php echo htmlspecialchars($row['tipo_bien']); ?></td>
                <td><?php echo htmlspecialchars($row['comentario']); ?></td>
                <td class="estate-status">
                <?php
                  if ($row["aprobado"] == 1) {
                    echo '<span style="color:#27ae60;">Aprobado</span>';
                  } elseif ($row["aprobado"] == 0) {
                    echo '<span style="color:#34495e;" class="table__pending-estatus">Pendiente</span>
                    <i class="fa-solid fa-trash table__icon-delete--pending table__icon--delete" onclick="deleteRequest('.$row["n_solicitud"].')"></i>';
                  } else {
                    echo '<span href="solicitudes-rechazadas.php#menu-request" title="Motivo de rechazo: '.$row['comentario_admin'].'" style="color:#c0392b; text-wrap: nowrap;">Rechazado</span>';
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
  <script src="js/filters.js"></script>
  <script>
    function deleteRequest(id) {
      Swal.fire({
        text: "¿Quieres eliminar esta solicitud?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar",
      }).then((result) => {
        if (result.isConfirmed) {
          const xhr = new XMLHttpRequest();
          xhr.open('POST', '../server/routes/delete-request.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.send('n_solicitud=' + id);
          xhr.onload = function() {
            window.location.href="mis-solicitudes.php"
          }
            Swal.fire({
              title: "",
              position: "top-end",
              text: "La solicitud fue eliminada",
              showConfirmButton: false,
              icon: "success",
              timer: 1500
            });
        }
      })
    }
  </script>
</body>
</html>