<?php

    require '../../server/db.php';
    require '../assets/include/session_start.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
    }

    if ($_GET) {
        $id = $_GET['id'];

        // traer los datos del id dado desde la bd

        $stmt = $conn->prepare('SELECT * FROM usuario WHERE n_dependencia = :id');
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    }

    if ($_POST) {
        $correo = $_POST['correo'];
        $id = $_GET['id'];

        $stmt = $conn->prepare('UPDATE usuario SET correo = :correo WHERE n_dependencia = :id');
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            header('Location: email.php?id='.$id);
            echo "Correo actualizado".$id;
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion de la cuenta</title>
    <link rel="shortcut icon" href="../assets/logo-sistema.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/account.css">
</head>
<body>
    <div class="container">
        <div class="main__header"><h1>Configuración de la cuenta de <?php echo $row['username'] ?></h1></div>
        <main class="main">
            <?php include 'menu.php'?>
            
        </main>
    </div>
</body>
</html>