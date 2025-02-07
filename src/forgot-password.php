<?php
require './assets/include/session_start.php';
require '../server/db.php';

if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
}

if ($_POST) {

    if (!empty($_POST['email'])) {

    $records = $conn->prepare("SELECT n_dependencia, correo FROM usuario WHERE correo = :email");
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if ($results) {

        if ($_GET["returnTo"]) {
        header('Location: index.php');

        } else {
        header('Location: index.php');
        }

    } else {
        echo 'Correo electronico no encontrado';
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
    <link rel="stylesheet" href="css/forgot-password.css">
</head>
<body>
    <main class="login-container">
        <div class="login-body">
            <h1 class="login-title">Recuperar Contraseña</h1>                
            <div class="recover">
                <div class="recover__steps recover__steps--active">
                    <span class="recover__steps-number recover__steps-number--active">1</span>
                    <p>Verificacion de usuario</p>
                </div>
                <div class="recover__steps">
                    <span class="recover__steps-number">2</span>
                    <p>Preguntas de seguridad</p>
                </div>
                <div class="recover__steps">
                    <span class="recover__steps-number">3</span>
                    <p>Cambio de contraseña</p>
                </div>
            </div>

            <div class="login-form">
                <form action="" method="POST" id="login-form">
                    <label for="email" class="login-label">Ingresa tu Correo Electronico</label>
                    <input type="text" id="email" class="login-input" name="email" placeholder="Correo electrónico">
                    <div class="login__group">
                        <button type="submit" class="login-button">Validar</button>
                        <button class="login-button">Regresar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="js/login.js"></script>
</body>
</html>