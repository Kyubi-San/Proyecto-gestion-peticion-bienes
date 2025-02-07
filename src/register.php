<?php

require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id']) || $records['admin'] < 1) {
  header('Location: login.php');
}

$message = "";

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

    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];
    $pregunta3 = $_POST['pregunta3'];
    $respuesta1 = $_POST['respuesta1'];
    $respuesta2 = $_POST['respuesta2'];
    $respuesta3 = $_POST['respuesta3'];

  
  if (!empty($dependencia) && !empty($email) && !empty($contrasena) &&  !empty($username) && isset($confirmPassword) && $contrasena == $confirmPassword) {

    // Variables si el email ya se a ingresado antes

    $verif_email = $conn->prepare("SELECT correo FROM usuario WHERE correo = :email");
    $verif_email->bindParam(':email', $email);
    $verif_email->execute();
    $results = $verif_email->fetch(PDO::FETCH_ASSOC);

    if ($results) {     
      $message = "Este correo ya esta registrado";

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
      $stmt->execute();

      $userId = $conn->lastInsertId();

      $stmt2 = $conn->prepare("INSERT INTO pregunta_seguridad (pregunta1, pregunta2, pregunta3, respuesta1, respuesta2, respuesta3, id_usuario) VALUES (:pregunta1, :pregunta2, :pregunta3, :respuesta1, :respuesta2, :respuesta3, :user_id)");
      $stmt2->bindParam(':user_id', $userId);
      $stmt2->bindParam(':pregunta1', $pregunta1);
      $stmt2->bindParam(':pregunta2', $pregunta2);
      $stmt2->bindParam(':pregunta3', $pregunta3);
      $stmt2->bindParam(':respuesta1', $respuesta1);
      $stmt2->bindParam(':respuesta2', $respuesta2);
      $stmt2->bindParam(':respuesta3', $respuesta3);

      $stmt2->execute();

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
    <title>Register | Contraloria</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
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
                    <input type="password" class="login-input" minlength="8" id="password" name="contrasena" placeholder="Contraseña">
                    <span class="login-input-error"></span>
                    <input type="password" class="login-input" minlength="8" id="confirm-password" name="confirmacioncontrasena" placeholder="Confirmar contraseña">
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

                    <select name="pregunta1" class="login-input3" hidden>
                      <option value="" selected disabled>Pregunta de seguridad 1</option>
                      <option value="¿Cual es el apellido de tu abuelo?">¿Cuál es el apellido de tu abuelo?</option>
                      <option value="¿Qué color le gusta más?">¿Qué color le gusta más?</option>
                      <option value="¿Cuál era tu apodo de la infancia?">¿Cuál era tu apodo de la infancia?</option>
                    </select>
                    <span class="login-input-error3" hidden></span>
                    <input type="text" class="login-input3" name="respuesta1" placeholder="Respuesta de pregunta 1" hidden>
                    <span class="login-input-error3" hidden></span>

                    <select name="pregunta2" class="login-input3" hidden>
                      <option value="" selected disabled>Pregunta de seguridad 2</option>
                      <option value="¿Cuál es su deporte favorito?">¿Cuál es su deporte favorito?</option>
                      <option value="¿Cómo se llamaba su mascota favorita de la infancia?">¿Cómo se llamaba su mascota favorita de la infancia?</option>
                      <option value="¿Cuál es tu comida favorita?">¿Cuál es tu comida favorita?</option>
                    </select>
                    <span class="login-input-error3" hidden></span>
                    <input type="text" class="login-input3" name="respuesta2" placeholder="Respuesta de pregunta 2" hidden>
                    <span class="login-input-error3" hidden></span>

                    <select name="pregunta3" class="login-input3" hidden>
                      <option value="" selected disabled>Pregunta de seguridad 3</option>
                      <option value="¿Cómo se llamaba tu mamá?">¿Cómo se llamaba tu mamá?</option>
                      <option value="¿Cuál fue tu primer trabajo?">¿Cuál fue tu primer trabajo?</option>
                      <option value="¿Cómo se llamaba el hospital en el que naciste?">¿Cómo se llamaba el hospital en el que naciste?</option>
                    </select>
                    <span class="login-input-error3" hidden></span>
                    <input type="text" class="login-input3" name="respuesta3" placeholder="Respuesta de pregunta 3" hidden> 
                    <span class="login-input-error3" hidden></span>
                    
                    <button type="submit" class="login-button" id="login-button"><span>Continuar</span></button>
                    <span><?php echo $message;?></span>
                </form>
            </div>
        </div>
    </main>
    <script src="js/register.js"></script>
</body>
</html>