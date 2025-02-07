<?php
require '../db.php';

if ($_GET) {
    try {
        // Obtener el ID del parámetro de consulta
        $id = $_GET['id'];
    
        // Preparar la consulta SQL con un marcador de posición
        $stmt = $conn->prepare("SELECT * FROM bienes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = array();
    
        if ($row) {
            $data[] = $row;
        } else {
            $data = array("message" => "No records found");
        }
    
        // Mostrar los datos en el HTML (solo para depuración)
        
        
        echo '<div class="result__content"><label for="" class="placeholder--category">ID</label><span class="result__content-text">'.htmlspecialchars($row["id"]).'</span></div>';
        echo '<div class="result__content"><label for="" class="placeholder--category">Descripcion</label><span class="result__content-text">'.htmlspecialchars($row["description"]).'</span></div>';
        echo '<div class="result__content"><label for="" class="placeholder--category">Comentario</label><span class="result__content-text">'.htmlspecialchars($row["comments"]).'</span></div>';
        echo '<div class="result__content"><label for="" class="placeholder--category">Fecha de solicitud</label><span class="result__content-text">'.htmlspecialchars($row["requestDate"]).'</span></div>';
        echo '<div class="result__content"><label for="" class="placeholder--category">Fecha de aprobacion</label><span class="result__content-text">'.htmlspecialchars($row["approvalDate"]).'</span></div>';
    
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>