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
    <title>Recuperar contraseña - Contraloria</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/forgot-password.css">
</head>
<body>
    <main class="login-container">
        <div class="login-body">
            <h1 class="login-title">Recuperar Contraseña</h1>                
            <div class="recover">
                <div class="recover__steps recover__steps--active" id="step-one">
                    <span class="recover__steps-number recover__steps-number--active" id="step-one-number"><i class="fa-solid fa-check"></i></span>
                    <p>Verificacion de usuario</p>
                </div>

                <div class="progress-bar"></div>

                <div class="recover__steps">
                    <span class="recover__steps-number"><i class="fa-solid fa-question"></i></span>
                    <p>Preguntas de seguridad</p>
                </div>
                <div class="recover__steps">
                    <span class="recover__steps-number"><i class="fa-solid fa-key"></i></span>
                    <p>Cambio de contraseña</p>
                </div>
            </div>

            <div class="login-form">
                <form action="../server/routes/verify-email.php" method="POST" id="login-form" class="form form--active">
                    <label for="email" class="login-label">Ingresa tu Correo Electronico</label>
                    <input type="text" id="email" class="login-input" name="email" placeholder="Correo electrónico">
                    <div class="login__group">
                        <button type="submit" class="login-button">Validar</button>
                        <a href="./index.php" class="login-button">Regresar</a>
                    </div>
                </form>

                <form action="../server/routes/validate-security-question.php" method="post" id="security-question" class="form">
                    <label id="pregunta1" class="security-question"></label>
                    <input type="text" class="login-input" name="respuesta1" id="respuesta1">
                    <label id="pregunta2" class="security-question"></label>
                    <input type="text" class="login-input" name="respuesta2" id="respuesta2">
                    <label id="pregunta3" class="security-question"></label>
                    <input type="text" class="login-input" name="respuesta3" id="respuesta3">
                    <div class="login__group">
                        <button type="submit" class="login-button">Enviar</button>
                        <a href="./index.php" class="login-button">Regresar</a>
                    </div>
                </form>

                <form action="../server/routes/change-password.php" method="post" class="form" id="change-password">
                    <input type="password" name="newPassword" placeholder="Nueva contraseña" class="login-input" id="new-password" minlength="8" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$">
                    <input type="password" name="confirmPassword" placeholder="Confirmar contraseña" class="login-input" id="confirm-password">
                    <span class="login-input-error" id="message-error"></span>
                    <span id="password-instruction">* La contraseña debe contener un minimo de 8 caracteres un numero y un caracter especial (*)</span>
                    <div class="login__group">
                        <button type="submit" class="login-button">Enviar</button>
                        <a href="./index.php" class="login-button">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="js/forgot-password.js"></script>
</body>
</html>