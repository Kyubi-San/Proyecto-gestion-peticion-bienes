<?php
require './assets/include/session_start.php';
require '../server/db.php';

if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
}

if ($_POST) {

if (!empty($_POST['email']) && !empty($_POST['password'])) {

  $records = $conn->prepare("SELECT n_dependencia, contrasena, correo FROM usuario WHERE correo = :email");
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  if ($results && password_verify($_POST['password'], $results['contrasena'])) {

    $_SESSION['user_id'] = $results['n_dependencia'];
    $_SESSION['email'] = $results['correo'];

    if ($_GET["returnTo"]) {
      header('Location: index.php');

    } else {
      header('Location: index.php');
    }

  } else {
  }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Contraloria</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
    <main class="login-container">
        <header class="login-header">
            <div class="login-company">
              <div class="login-information">
                <img src="assets/logo-contraloria.jpg" class="login-company-logo" alt="logo de la contraloria municipal de Guanipa">
                <h2>Contraloria Municipal de Guanipa</h2>
              </div>
              <div>
                <a href="https://github.com/Kyubi-San/Proyecto-gestion-peticion-bienes" target="_blank" class="login-repository "><i class="fa-brands fa-square-github"></i></a>
                </div>
            </div>

            <div class="login-welcome">
                <picture class="login-welcome-logo"><img src="assets/logo-sistema.png" class="login-welcome-logo--system" alt="Logo del sistema"><img src="assets/sea-waves.webp" class="login-welcome-logo--detail" alt=""><img src="assets/waves2.jpg" class="login-welcome-logo--bubble" alt=""></picture>
                <h2>Sistema de gestion y solicitud de bienes</h2>
                <p>Por favor inicia sesión para continuar</p>
            </div>
        </header>
        
        <div class="login-body">
            <div class="login-form">
                <h1 class="login-title">Iniciar Sesión</h1>                
                <form action="" method="POST" id="login-form">
                    <label for="email" class="login-label">Ingresa tu Correo Electronico</label>
                    <input type="text" id="email" class="login-input" name="email" placeholder="Correo electrónico">

                    <label for="password" class="login-label">Ingresa tu Contraseña</label>
                    <input type="password" id="password" class="login-input" name="password" placeholder="Contraseña">
                    <button type="submit" class="login-button">Ingresar</button>
                </form>
                <nav class="login-links">
                    <a href="forgot-password.php">¿Olvidaste tu contraseña?</a>
                </nav>
            </div>
        </div>
    </main>
    <script src="js/login.js"></script>
</body>
</html>