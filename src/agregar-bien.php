<?php

require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id']) || $records['admin'] < 1) {
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Solicitudes</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="./css/gestion-bienes.css" />
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
    <script src="js/sweetalert2.js"></script>
  </head>
  <body>
    <div class="container">
        <?php include 'assets/include/menu.php';?>
        <main class="main">
            <div class="form-container">
                <h2>Agregar un nuevo bien</h2>
                <form action="../server/routes/agregar-bien.php" id="form" class="form" method="POST">
                    <div class="input-container--name">
                        <label for="newType">Nombre del bien</label>
                        <input type="text" class="form__input" name="name" placeholder="Escribe el nombre del bien" />
                    </div>
                    <div class="input-container">
                        <label for="newType">Tipo de Bien</label>
                        <select id="newType" name="type" class="form__input">
                        <option value="" selected disabled>Seleccione un tipo</option>
                        <option value="Electronico">Electrónico</option>
                        <option value="Mueble">Mueble</option>
                        <option value="Herramienta">Herramienta</option>
                        <option value="Otro">Otro...</option>
                        </select>
                    </div>
                    <div class="input-container">
                        <label for="newType">Responsable</label>
                        <select id="" name="responsible" class="form__input">
                            <option value="" selected disabled>Seleccione una dependencia</option>
                            <?php
                                foreach ($conn->query('SELECT * from usuario') as $row) {
                                    echo '<option value="'.$row['n_dependencia'].'">'.$row['nombre_dependencia'].'</option>';
                                }
                                ?>
                        </select>
                    </div>
                    <div class="input-container">
                        <label for="newType">Comentario</label>
                        <input type="text" class="form__input" id="comments" placeholder="Comentarios" name="comments"/>
                    </div>
                    <div class="input-container--description">
                        <label for="newType">Descripcion</label>
                        <textarea id="description" rows="8" name="description" id="newDescription" class="form__input input-container--description" placeholder="Tu descripción aquí"></textarea>
                    </div>                
                    <div class="input-container">
                        <label for="requestDate">Fecha de Solicitud</label>
                        <input type="date" class="form__input" name="requestDate" id="requestDate" />
                    </div>
                    <div class="input-container">
                        <label for="approvalDate">Fecha de Aprobación</label>
                        <input type="date" class="form__input" name="approvalDate" id="approvalDate" />
                    </div>
                    <div class="input-container">
                        <label for="withdrawalDate">Fecha de Retiro (opcional)</label>
                        <input type="date" class="form__input" name="withdrawalDate" id="withdrawalDate" />
                    </div>
                <div class="form-group--button">
                    <a href="index.php" class="form-button">Cancelar</a>
                    <button class="form-button form-button--accept" type="submit" onclick="validarCampos()">Guardar</button>
                </div>
            </form>
        </div>
      </main>
    </div>
    <script src="js/agregar-bien.js"></script>
  </body>
</html>
