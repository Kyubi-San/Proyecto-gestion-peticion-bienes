<?php
require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

    $query = $conn->query('SELECT COUNT(*) as total FROM notificaciones WHERE receiver ='.$_SESSION['user_id']);
    $row = $query->fetch(PDO::FETCH_ASSOC);

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
                        <h2>Bienvenido <?php echo $records['admin'] > 0 ? 'Administrador ' : 'Usuario '; echo $records['username']?></h2>
                    </div>
                </div>

                <div class="notification">
                    <i data-count="<?php echo $row['total'] ?>" class="fa-regular fa-bell" id="notification-button"></i>
                    <div class="notification__menu" id="notification-menu">                        
                        <?php 

                        if ($row['total'] != 0) {
                            foreach ($conn->query('SELECT * from notificaciones WHERE receiver ='.$_SESSION['user_id'].' ORDER BY id DESC') as $notifications) {
                                $sender = $conn->prepare('SELECT nombre_dependencia from usuario WHERE n_dependencia ='.$notifications['sender']);
                                $sender->execute();
                                $sender = $sender->fetch(PDO::FETCH_ASSOC);
                                echo "<a href='#' class='notification__menu-item'><i class='fas fa-file-alt'></i><div class='notification__menu-info'><span class='notification__menu-sender'>".$sender['nombre_dependencia']."</span><span class='notification__menu-message'>".$notifications['message']."</span></div></a>";
                            }
                        } else {
                            echo '<span class="notification__menu-item notification__menu-item--empty"><i class="fa-solid fa-ghost"></i>No tienes notificaciones por ahora</span>';
                        }
                        ?>
                    </div>
                </div>
            </header>
            
            <section class="main__stats">
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
                                $query = $conn->query("SELECT COUNT(*) as total FROM bienes WHERE withdrawalDate = '0000-00-00'");  
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
            </section>
            <?php if ($records["admin"] > 0): ?>
            <section class="card">
                <div class="card__header">
                    <h3>Ultimas solicitudes</h3>
                    <a href="index.php">actualizar</a>
                </div>
                <div class="card__body">
                <?php
            $query = $conn->query("SELECT COUNT(*) as total FROM solicitudes WHERE aprobado = 0");
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row['total'] < 1) {
              echo '
              <div class="myEstate__message">
                <p>No hay solicitudes pendientes</p>
                <i class="fa-solid fa-ghost"></i>
              </div>';
            }
          ?>
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
                            foreach ($conn->query('SELECT * from solicitudes INNER JOIN usuario ON solicitudes.id_usuario = usuario.n_dependencia WHERE aprobado = 0 ORDER BY n_solicitud DESC LIMIT 9') as $row):
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
                                        <a href="rechazar-solicitud.php?id=<?php echo $row['n_solicitud']?>" class="table__icon--decline" title="Rechazar"><i class="fa-solid fa-xmark"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table> 
                    <?php echo $num > 8 ? '<footer class="card__footer">
                        <a href="solicitudes-pendientes.php">Mostrar Todas</a>
                    </footer>' : ''?>                      
                </div>
            </section>
            <?php else: ?>
                        <nav class="nav">
                <a class="nav__item" href="mis-bienes.php#menu-estate">
                        <i class="fa-solid fa-box nav__item-icon"></i>
                        <span class="nav__item-textBox">Mis bienes</span>
                </a>
                <a class="nav__item" href="bienes-desincorporados.php#menu-estate">
                        <i class="fa-solid fa-box nav__item-icon"></i>
                        <span class="nav__item-textBox">Mis bienes retirados</span>
                </a>
                <a class="nav__item" href="mis-solicitudes.php#menu-request">
                        <i class="fas fa-file-alt nav__item-icon"></i>
                        <span class="nav__item-textBox">Mis solicitudes</span>
                </a>
                <a class="nav__item">
                        <i class="fas fa-file-alt nav__item-icon"></i>
                        <span class="nav__item-textBox">Solicitar bien</span>
                </a>
                <a class="nav__item">
                    <i class="fas fa-file-alt nav__item-icon"></i>
                    <span class="nav__item-textBox">Solicitar retiro</span>
                </a>
                <a class="nav__item">
                    <i class="fas fa-user nav__item-icon"></i>
                    <span class="nav__item-textBox">Configuracion de la cuenta</span>
                </a>
                <a class="nav__item">
                    <i class="fas fa-user nav__item-icon"></i>
                    <span class="nav__item-textBox">Preguntas de seguridad</span>
                </a>
            </nav>
            <?php endif; ?>
        </main>
    </div>
    <script src="js/index.js"></script>
</body>
</html>