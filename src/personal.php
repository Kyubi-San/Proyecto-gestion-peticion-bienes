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
    <title>Ajustes de la cuenta</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/personal.css">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
    <script src="js/sweetalert2.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'assets/include/menu.php'; ?>

        <main class="main">
            <h1>Ajustes de la cuenta</h1>
            <p>Gestionar los datos de tu cuenta</p>
            <h3>Informacion de la cuenta</h3>
            <b>ID: </b><?php echo $_SESSION['user_id']; ?>
            <div class="account-info">
                <form id="formulario1" action="../server/routes/account-info.php" class="account-info__form">
                    <label for="" class="placeholder">Nombre de usuario</label>
                    <input type="text" class="account-info__form-input" value="<?php echo $records['username']; ?>" disabled>
                    <button type="button" class="account-info__form-button"><i class="fa-solid fa-pen-to-square"></i></button>
                </form>
                <form id="formulario2" class="account-info__form">
                    <label for="" class="placeholder">Direccion de correo electronico</label>
                    <input type="text" class="account-info__form-input" value="<?php echo $_SESSION['email']; ?>" disabled>
                    <button type="button" class="account-info__form-button"><i class="fa-solid fa-pen-to-square"></i></button>
                </form>
            </div>
            <h3>Datos Personales</h3>
            <p>Administra tu nombre e información de contacto.</p>
            <form action="../server/routes/personal-info.php" method="POST" id="formulario3" class="main__form">
                <div class="form__group">
                    <input class="form__input" id="nombre" name="nombre" type="text" value="<?php echo $records['nombre']; ?>">
                    <label for="" class="input__placeholder">Nombre</label>
                    <span class="form__error">Introduce tu nombre</span>
                </div>
                <div class="form__group">
                    <input class="form__input" id="apellido" name="apellido" type="text" value="<?php echo $records['apellido']; ?>">
                    <label for="" class="input__placeholder">Apellido</label>
                    <span class="form__error">Introduce tu apellido</span>
                </div>
                <div class="form__group">
                    <input class="form__input" id="cedula" name="cedula" type="number" value="<?php echo $records['cedula']; ?>">
                    <label for="" class="input__placeholder">Cedula</label>
                    <span class="form__error">Introduce tu cedula</span>
                </div>
                <div class="form__group--button">
                    <input class="form__button" id="button" type="submit" value="Guardar Cambios" disabled>
                </div>
            </form>
        </main>
    </div>
    <script src="js/personal.js"></script>
</body>
</html>