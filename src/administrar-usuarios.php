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

        <div class="card-container">
        <?php foreach ($conn->query('SELECT * from usuario') as $row): ?>
            <div class="card">
                <?php echo $row['admin'] >=1 ?
                '<span class="card__avatar"><i class="fa-solid fa-user-lock"></i></span>' :
                '<span class="card__avatar"><i class="fa-solid fa-user card__img"></i></span>'?>
                <div class="card__body">
                    <h1 class="card__body-username"><?php echo $row['username'];?></h1>
                    <span class="card__body-rolename"><?php echo $row['correo'];?></span>
                </div>
                <div class="card__actions">
                    <a href='account/email.php?id=<?php echo $row["n_dependencia"]?>' class="actions__button">
                        <i class="fa-solid fa-circle-info"></i>
                        <span class="mx-1">Informacion de usuario</span>
                    </a>
                </div>
            </div> 
        <?php endforeach; ?>
        
        </main>
    </div>
    <script src="js/gestion-usuarios.js"></script>
</body>
</html>