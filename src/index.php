<?php
require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion y solicitud de bienes</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/logo-contraloria.png" type="image/x-icon">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php include 'assets/include/menu.php'; ?>
        <main class="main">
            <header class="main__header">
                <div class="greeting">
                    <div>
                        <h2>Bienvenido <?php echo $records['nombre']?></h2>
                    </div>
                </div>

                <div class="notification">
                    <i class="fa-regular fa-bell"></i>
                    <div class="notification__menu">
                        <a href="#" class="notification__menu-item">
                            <i class="fa-solid fa-ghost"></i>
                            No tienes notificaciones por ahora
                        </a>
                    </div>
                </div>
            </header>
            
            <div class="main__stats">
                <div class="main__stats--item">
                    <h3>Bienes</h3>
                    <p>100</p>
                </div>
                <div class="main__stats--item">
                    <h3>Dependencias</h3>
                    <p>100</p>
                </div>
                <div class="main__stats--item">
                    <h3>Solicitudes</h3>
                    <p>100</p>
                </div>
            </div>

            <div class="main__cards">
                <div class="card">
                    <div class="card__header">
                        <h3>Ultimas solicitudes</h3>
                    </div>
                    <div class="card__body
                    ">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Solicitante</th>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Tipo</th>
                                    <th>Comentario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $num = 1;
                                foreach ($conn->query('SELECT * from solicitudes INNER JOIN usuario ON solicitudes.id_usuario = usuario.n_dependencia WHERE aprobado = 0 LIMIT 10') as $row):
                                $num++;
                                ?>
                                    <tr>
                                        <td><?php echo $row['n_solicitud']; ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_dependencia']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fecha_solicitud']); ?></td>
                                        <td><?php echo htmlspecialchars($row['bien']); ?></td>
                                        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                        <td><?php echo $row['tipo_bien']; ?></td>
                                        <td><?php echo htmlspecialchars($row['comentario']); ?></td>
                                        <td>
                                            <a href="gestion-solicitudes.php?id=<?php echo $row['n_solicitud']?>" class="table__icon--check" title="Aprobar"><i class="fa-solid fa-check"></i></a>
                                            /
                                            <a href="" class="table__icon--decline" title="Rechazar"><i class="fa-solid fa-xmark"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table> 
                        <?php echo $num > 8 ? '<footer class="card__footer">
                            <a href="lista-solicitudes.php">Mostrar Todas</a>
                        </footer>' : ''?>                      
                    </div>
                </div>
            </div>
        
        </main>
    </div>
</body>
</html>