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
            <form action="../server/routes/agregar-bien.php" id="form" class="form" method="POST">
            <h2>Agregar Bien</h2>

            <div class="form-group">
                <div>
                    <input type="text" class="form__input" name="name" placeholder="Nombre del bien" />
                </div>
                <div>
                    <label for="newType">Descripcion:</label>
                    <input type="text" class="form__input" name="description" id="newDescription" placeholder="Descripción" />
                </div>
                <div>
                    <label for="newType">Tipo de Bien:</label>
                    <select id="newType" name="type" class="form__input">
                    <option value="" selected disabled>Seleccione un tipo</option>
                    <option value="Electronico">Electrónico</option>
                    <option value="Mueble">Mueble</option>
                    <option value="Herramienta">Herramienta</option>
                    <option value="Otro">Otro...</option>
                    </select>
                </div>

                <div>
                    <label for="newType">Responsable:</label>
                    <select id="" name="responsible" class="form__input">
                        <option value="" selected disabled>Seleccione una dependencia</option>
                        <?php
                            foreach ($conn->query('SELECT * from usuario') as $row) {
                                echo '<option value="'.$row['n_dependencia'].'">'.$row['nombre_dependencia'].'</option>';
                            }
                            ?>
                    </select>
                </div>
                <div>
                    <label for="newType">Comentario:</label>
                    <input type="text" class="form__input" id="comments" placeholder="Comentarios" name="comments"/>
                </div>                
                <div>
                    <label for="requestDate">Fecha de Solicitud:</label>
                    <input type="date" class="form__input" name="requestDate" id="requestDate" />
                </div>
                <div>
                    <label for="approvalDate">Fecha de Aprobación:</label>
                    <input type="date" class="form__input" name="approvalDate" id="approvalDate" />
                </div>
                <div>
                    <label for="withdrawalDate">Fecha de Retiro (opcional):</label>
                    <input type="date" class="form__input" name="withdrawalDate" id="withdrawalDate" />
                </div>
            </div>
            <div class="form-group--button">
                <a href="index.php" class="form-button">Cancelar</a>
                <button class="form-button form-button--accept" type="submit" onclick="validarCampos()">Guardar</button>
            </div>
        </form>
      </main>
    </div>
    <script src="js/agregar-bien.js"></script>
  </body>
</html>
