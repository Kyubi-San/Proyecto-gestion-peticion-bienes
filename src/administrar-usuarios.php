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
    <title>Administracion de usuarios</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/gestion-usuarios.css">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
    <script src="js/sweetalert2.js"></script>
</head>
<body>
    <div class="container">

        <?php include 'assets/include/menu.php';?>
        <main class="main">
            <?php foreach ($conn->query('SELECT * from usuario') as $row): ?>
                <div class="card">
                    <div class="avatar__container">
                        <?php echo $row['admin'] >=1 ? '<i class="fa-solid fa-user-lock card__avatar"></i>' : '<i class="fa-solid fa-user card__avatar"></i>'?>
                    </div>
                    <div class="card__body">
                        <header class="card__header">
                            <h3><?php echo $row['nombre_dependencia'];?></h3>
                        </header>
                        <div class="card__content">
                            <span><b>Nombre de usuario: </b><?php echo $row['username'];?></span>
                            <span><b>Correo: </b><?php echo $row['correo'];?></span>
                        </div>
                        <div class="card__actions">
                            <a href="" class="actions__button actions__button--delete">Eliminar Usuario</a>
                            <a href="#" class="actions__button" onclick="holawenas()">Editar Usuario</a>
                        </div>
                    </div>
                </div>
            
            <?php endforeach; ?>
        </main>
    </div>
    <script src="js/gestion-usuarios.js"></script>
</body>
</html>