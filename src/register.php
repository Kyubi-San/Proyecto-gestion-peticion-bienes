<?php

require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id']) || $records['admin'] < 1) {
  header('Location: login.php');
}

if ($_POST) {

    # Esquema
    $dependencia = htmlspecialchars($_POST['dependencia']);
    $username = htmlspecialchars($_POST['usuario']);
    $contrasena = $_POST['contrasena'];
    $confirmPassword = $_POST["confirmacioncontrasena"];
    $email = $_POST['email'];
    $cedula = $_POST['cedula'];
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $telefono = htmlspecialchars($_POST['telefono']);
  
  if (!empty($dependencia) && !empty($email) && !empty($contrasena) &&  !empty($username) && isset($confirmPassword) && $contrasena == $confirmPassword) {

    // Variables si el email ya se a ingresado antes

    $verif_email = $conn->prepare("SELECT correo FROM usuario WHERE correo = :email");
    $verif_email->bindParam(':email', $email);
    $verif_email->execute();
    $results = $verif_email->fetch(PDO::FETCH_ASSOC);

    if ($results) {
     
      header('location: signup.php');
      echo "Este correo ya esta registrado";

    } else {

    // Variables para insertar los datos en la db si todo sale bien

      $stmt = $conn->prepare("INSERT INTO usuario (nombre_dependencia, username, correo, contrasena, nombre, apellido, telefono, cedula) VALUES (:dependencia, :user, :email, :password, :nombre, :apellido, :telefono, :cedula)");

      $stmt->bindParam(':dependencia', $dependencia);
      $stmt->bindParam(':user', $username);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':apellido', $apellido);
      $stmt->bindParam(':telefono', $telefono);
      $stmt->bindParam(':cedula', $cedula);
      $password = password_hash($contrasena, PASSWORD_BCRYPT);
      $stmt->bindParam(':password', $password);

      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email; 
      $stmt->execute();

        $sessionCredentials = $conn->prepare("SELECT n_dependencia, username, correo FROM usuario WHERE correo = :email");
        $sessionCredentials->bindParam(':email', $_SESSION['email']);
        $sessionCredentials->execute();
        $sessionCredentials = $sessionCredentials->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $sessionCredentials['n_dependencia'];
        header('location: index.php');
      }
      
    } else {
      $message = "Fallo en la validacion de sus datos revisa que no falte ningun campo por llenar";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Contraloria</title>
    <link rel="stylesheet" href="css/register.css">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
</head>
<body>
    <main class="login-container">
        <header class="login-header">
            <div class="login-company">
                <img src="assets/logo-sistema.jpg" alt="Logo de la Contraloria" class="login-company-logo">
                <h2>Contraloria Municipal de Guanipa</h2>
            </div>

            <div class="login-welcome">
                <h2 id="login-greeting">¿ERES NUEVO?</h2>
                <p id="login-tip">Crea una cuenta para ingresar al sistema!</p>
                <span href="#" id="login-back" class="login-back" onclick="retroceder()" hidden><i class="fa-solid fa-backward"></i></span>
            </div>
        </header>
        
        <div class="login-body">
            <div class="login-form">
                <h1 class="login-title">Crear una cuenta</h1>

                <form action="" method="POST" id="login-form">
                    <input type="text" class="login-input" name="dependencia" placeholder="Nombre de la dependencia">
                    <span class="login-input-error"></span>
                    <input type="text" class="login-input" name="usuario" placeholder="Usuario">
                    <span class="login-input-error"></span>
                    <input type="password" class="login-input" id="password" name="contrasena" placeholder="Contraseña">
                    <span class="login-input-error"></span>
                    <input type="password" class="login-input" id="confirm-password" name="confirmacioncontrasena" placeholder="Confirmar contraseña">
                    <span class="login-input-error" id="confirm-password-error"></span>
                    <input type="email" class="login-input" name="email" placeholder="Correo">
                    <span class="login-input-error"></span>
                    <input type="number" class="login-input2" name="cedula" placeholder="Cedula" hidden>
                    <span class="login-input-error2"></span>
                    <input type="text" class="login-input2" name="nombre" placeholder="Nombre" hidden>
                    <span class="login-input-error2"></span>
                    <input type="text" class="login-input2" name="apellido" placeholder="Apellido" hidden>
                    <span class="login-input-error2"></span>
                    <input type="number" class="login-input2" name="telefono" placeholder="Telefono" hidden>
                    <span class="login-input-error2"></span>
                    <button type="submit" class="login-button" id="login-button"><span>Continuar</span></button>
                </form>
            </div>
        </div>
    </main>
    <script src="js/register.js"></script>
</body>
</html>