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
    <script src="js/index.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/logo-contraloria.png" type="image/x-icon">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <aside class="menu">
            <div class="menu__header">
                <img src="assets/logo-contraloria.png" alt="Logo de la contraloria" class="menu__logo">
                <div class="menu__header--title">
                    <h1>Contraloria de Guanipa</h1>
                    <h2>Gestion y solicitud de bienes</h2>
                </div>
            </div>
            <nav class="menu__nav">
                <h3>Descripcion General</h3>
                <a href="#">
                    <i class="fas fa-home"></i>
                    <span>Panel</span>
                </a>
                <a href="gestion-bienes.php" class="menu__item">
                    <span>
                        <i class="fas fa-box"></i>Bienes
                    </span>
                </a>
                <a href="#">
                    <i class="fas fa-building"></i>
                    <span>Dependencias</span>
                </a>
                <a href="solicitud-bienes.php" class="menu__item">
                    <i class="fas fa-file-alt"></i>
                    <span>Solicitudes</span>
                </a>
                <a href="#" class="menu__item">
                    <i class="fas fa-user"></i>
                    <span>Usuarios</span>   
                </a>
            </nav>

        </aside>
        <main class="main">
            <header class="main__header">
                <div class="greeting">
                    <div>
                        <h2>Bienvenido <?php echo $records['nombre']?></h2>
                    </div>
                </div>
                <div class="user">
                    <?php echo $records['username']?>
                    <i class="fa-solid fa-chevron-down"></i>
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
                        <a href="#">Ver todas</a>
                    </div>
                    <div class="card__body
                    ">
                        <table>
                            <thead>
                                <tr>
                                    <th>N-Solicitud</th>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($conn->query('SELECT * from solicitudes WHERE aprobado = 0') as $row):
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['n_solicitud']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fecha_solicitud']); ?></td>
                                        <td><?php echo htmlspecialchars($row['bien']); ?></td>
                                        <td><?php echo htmlspecialchars($row['tipo_bien']); ?></td>
                                    </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </main>
    </div>
</body>
</html>