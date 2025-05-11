<?php 
    require 'assets/include/session_start.php';
    require '../server/db.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    $query = $conn->query('SELECT * from pregunta_seguridad WHERE id_usuario ='.$_SESSION['user_id']);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($_POST) {
        
    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];
    $pregunta3 = $_POST['pregunta3'];
    $respuesta1 = htmlspecialchars($_POST['respuesta1']);
    $respuesta2 = htmlspecialchars($_POST['respuesta2']);
    $respuesta3 = htmlspecialchars($_POST['respuesta3']);
    
    $stmt2 = $conn->prepare("INSERT INTO pregunta_seguridad (pregunta1, pregunta2, pregunta3, respuesta1, respuesta2, respuesta3) VALUES (:pregunta1, :pregunta2, :pregunta3, :respuesta1, :respuesta2, :respuesta3)");

    $stmt2->bindParam(':pregunta1', $pregunta1);
    $stmt2->bindParam(':pregunta2', $pregunta2);
    $stmt2->bindParam(':pregunta3', $pregunta3);
    $stmt2->bindParam(':respuesta1', $respuesta1);
    $stmt2->bindParam(':respuesta2', $respuesta2);
    $stmt2->bindParam(':respuesta3', $respuesta3);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas de seguridad</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/preguntas-seguridad.css">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
    <script src="js/sweetalert2.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'assets/include/menu.php'; ?>
        <main class="main">

            <form action="" class="form hidden" id="form2">
                <h2>Contraseña</h2>
                <div class="form__group form__group--column ">
                    <input type="password" name="password" id="password" class="security-question" placeholder="Contraseña actual">
                    <span class="login-input-error3" id="password-error"></span>
                </div>
                <div class="form__group form__group--column">
                    <input type="password" name="password" class="security-question" id="new-password" placeholder="Nueva contraseña">
                    <span class="login-input-error3" id="new-password-error"></span>
                </div>
                <div class="form__group form__group--column">
                    <input type="password" name="password" class="security-question" id="confirm-password" placeholder="Confirmar nueva contraseña">
                    <span class="login-input-error3" hidden></span>
                </div>
                <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['email'] ?>">
                <button type="submit" class="button"><span>Continuar</span></button>
            </form>

            <div class="menu-selection">
                <img src="assets/logo-sistema.png" alt="" class="logo">
                <h2>¿Que quieres hacer?</h2>
                <div class="menu-selection__buttons">
                    <button class="menu-selection__button menu-selection__button--selected" id="change-question">Cambiar preguntas de seguridad</button>
                    <button class="menu-selection__button" id="change-password">Cambiar contraseña</button>
                </div>
            </div>

            <form action="" class="form" id="form1">
                <h2>Preguntas de seguridad</h2>
                <div class="form__group">
                    <select name="pregunta1" class="security-question">
                        <option value="" selected disabled>Pregunta de seguridad 1</option>
                        <option value="¿Cual es el apellido de tu abuelo?">¿Cuál es el apellido de tu abuelo?</option>
                        <option value="¿Qué color le gusta más?">¿Qué color le gusta más?</option>
                        <option value="¿Cuál era tu apodo de la infancia?">¿Cuál era tu apodo de la infancia?</option>
                    </select>
                    <span class="login-input-error3" hidden></span>
                    <input type="text" class="security-question" name="respuesta1" placeholder="Respuesta de pregunta 1">
                    <span class="login-input-error3" hidden></span>
                </div>

                <div class="form__group">
                    <select name="pregunta2" class="security-question">
                        <option value="" selected disabled>Pregunta de seguridad 2</option>
                        <option value="¿Cuál es su deporte favorito?">¿Cuál es su deporte favorito?</option>
                        <option value="¿Cómo se llamaba su mascota favorita de la infancia?">¿Cómo se llamaba su mascota favorita de la infancia?</option>
                        <option value="¿Cuál es tu comida favorita?">¿Cuál es tu comida favorita?</option>
                    </select>
                    <span class="login-input-error3" hidden></span>
                    <input type="text" class="security-question" name="respuesta2" placeholder="Respuesta de pregunta 2">
                    <span class="login-input-error3" hidden></span>
                </div>

                <div class="form__group">
                    <select name="pregunta3" class="security-question">
                        <option value="" selected disabled>Pregunta de seguridad 3</option>
                        <option value="¿Cómo se llamaba tu mamá?">¿Cómo se llamaba tu mamá?</option>
                        <option value="¿Cuál fue tu primer trabajo?">¿Cuál fue tu primer trabajo?</option>
                        <option value="¿Cómo se llamaba el hospital en el que naciste?">¿Cómo se llamaba el hospital en el que naciste?</option>
                    </select>
                    <span class="login-input-error3" hidden></span>
                    <input type="text" class="security-question" name="respuesta3" placeholder="Respuesta de pregunta 3"> 
                    <span class="login-input-error3" hidden></span>
                </div>
                <button type="submit" class="button" id=""><span>Continuar</span></button>
            </form>
        </main>
    </div>
    <script src="js/security-question.js"></script>
</body>
</html>