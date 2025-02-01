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
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
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
                <div class="stats__item">
                    <a href="lista-bienes.php" class="stats__item-link">Ver Mas...</a>
                    <picture class="stats__item-icon">
                        <i class="fa-solid fa-box"></i>
                    </picture>
                    <div class="stats__item-content" style="background: url(assets/bg-bienes.png); background-size: cover; background-position: right;">
                        <div class="content__info" >
                            <h3>Bienes</h3>
                            <p>
                                <?php
                                $query = $conn->query("SELECT COUNT(*) as total FROM bienes");
                                $row = $query->fetch(PDO::FETCH_ASSOC);
                                echo $row['total'];
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="stats__item">
                    <a href="administrar-usuarios.php" class="stats__item-link">Ver Mas...</a>
                    <picture class="stats__item-icon">
                        <i class="fa-solid fa-city"></i>
                    </picture>
                    <div class="stats__item-content" style="background: url(assets/bg-dependencia.jpg); background-size: cover; background-position: left;">
                        <div class="content__info">
                        <h3>Dependencias</h3>
                        <p>
                        <?php
                        $query = $conn->query("SELECT COUNT(*) as total FROM usuario");
                        $row = $query->fetch(PDO::FETCH_ASSOC);
                        echo $row['total'];
                        ?>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="stats__item">
                    <a href="lista-solicitudes.php" class="stats__item-link">Ver Mas...</a>
                    <picture class="stats__item-icon">
                        <i class="fas fa-file-alt"></i>
                    </picture>
                    <div class="stats__item-content" style="background: url(assets/bg-solicitudes.webp); background-size: cover; background-position: left;">
                        <div class="content__info">
                            <h3>Solicitudes</h3>
                            <p>
                            <?php
                            $query = $conn->query("SELECT COUNT(*) as total FROM solicitudes");
                            $row = $query->fetch(PDO::FETCH_ASSOC);

                            echo $row['total'];
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main__cards">
                <div class="card">
                    <div class="card__header">
                        <span><h3>Ultimas solicitudes</h3></span>
                        <a href="index.php">actualizar</a>
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