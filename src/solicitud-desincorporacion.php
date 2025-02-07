<?php

require 'assets/include/session_start.php';
require '../server/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if ($_POST) {
    
    $currentDate = date('Y-m-d');
    $id = $_POST['tipo_bien'];
  
  // Asignar valores a las variables desde $_POST
      
      # Esquema de la tabla
        $stmt = $conn->prepare("UPDATE bienes SET withdrawalDate = :currentDate WHERE id = :id");
    
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':currentDate', $currentDate);
        try {
          $stmt->execute();
          header('Location: solicitud-desincorporacion.php');    
        } catch (\Throwable $th) {
            echo "Error al insertar el bien";
        }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud De Bienes</title>
    <link rel="shortcut icon" href="assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/solicitud-bienes.css">
    <link href="assets/fontawesome-free-6.7.2-web/css/all.css" rel="stylesheet" />
    <script src="js/solicitud-desincorporacion.js"></script>
    <script src="js/sweetalert2.js"></script>
</head>
<body>
    <div class="container">
    <?php include 'assets/include/menu.php'?>
    <main class="main">
        <form action="" method="POST" id="form" class="form" autocomplete="off">
            <h2>Solicitar retiro de un bien</h2>
            <h3>Selecciona el bien a desincorporar</h3>

            <div class="input-container">
                <select id="tipo_bien" class="input" name="tipo_bien" required>
                    <option value="" selected disabled>Selecciona uno de tus bienes</option>
                    <?php
                        foreach ($conn->query('SELECT * from bienes WHERE withdrawalDate = "0000-00-00" AND responsible ='.$_SESSION["user_id"]) as $row) { 
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                            $id = $row['id'];
                        }
                    ?>
                </select>
                <label for="tipo_bien" class="placeholder--category">Bienes</label>
            </div>

            <div id="result">
                
            </div>
            
            <div class="input-container">
                <input type="password" class="input" id="password" name="password" placeholder=" " required>
                <label for="password" class="placeholder">Contraseña:</label>
            </div>
            
            <div class="button__group">
                <a href="index.php" class="input__button input__button--cancel">Cancelar</a>
                <input type="submit" value="Solicitar" class="input__button">
            </div>
        </form>
    </main>
    </div>
</body>
</html>