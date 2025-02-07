<?php

require '../db.php';
require '../../src/assets/include/session_start.php';
if ($_POST) {

    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
      }
      
      $uuid = generateID(10);

# Esquema de la tabla
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $type = htmlspecialchars($_POST['type']);
    $responsible = $_POST['responsible'];
    $comments = htmlspecialchars($_POST['comments']);
    $requestDate = htmlspecialchars($_POST['requestDate']);
    $approvalDate = htmlspecialchars($_POST['approvalDate']);
    $withdrawalDate = htmlspecialchars($_POST['withdrawalDate']);

    if (!empty($name) && !empty($description) && !empty($type) && !empty($comments)) {
        $stmt = $conn->prepare("INSERT INTO bienes (id, responsible, requestDate, approvalDate, comments, name, type, description, withdrawalDate) VALUES (:uuid, :responsible, :requestDate, :approvalDate, :comments, :name, :type, :description, :withdrawalDate)");

        $stmt->bindParam(':uuid', $uuid);
        $stmt->bindParam(':responsible', $responsible);
        $stmt->bindParam(':requestDate', $requestDate);
        $stmt->bindParam(':approvalDate', $approvalDate);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':withdrawalDate', $withdrawalDate);      

        try {
          $stmt->execute();

        } catch (\Throwable $th) {
            echo "Error al insertar el bien";
        }
    }
}

?>