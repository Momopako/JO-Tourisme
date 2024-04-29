<?php
    require_once("modele/modeleMere.class.php");;  // Ce fichier devrait retourner une instance PDO
    require 'modeleResa.php';

    $pdo = getPDOInstance();  // Une fonction hypothétique définie dans 'database.php'
    $model = new modeleResa($pdo);

    $type = $_POST['type'] ?? '';
    $id = $_POST['id'] ?? 0;
    $userId = $_SESSION['userId'] ?? 0;  // Assurez-vous que l'utilisateur est connecté et a un ID valide
    $dateReservation = date("Y-m-d");  // La date actuelle
    $comment = "";  // Commentaire facultatif
    $status = "en attente";  // Statut par défaut

    if ($userId === 0) {
        echo json_encode(["status" => "error", "message" => "Utilisateur non connecté."]);
        exit;
    }

    if ($type == 'evenement') {
        $result = $model->addEventReservation($userId, $id, $dateReservation, $comment, $status);
    } else if ($type == 'service') {
        $result = $model->addServiceReservation($userId, $id, $dateReservation, $comment, $status);
    } else {
        echo json_encode(["status" => "error", "message" => "Type de réservation inconnu."]);
        exit;
    }

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Réservation ajoutée avec succès"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Échec de l'ajout de la réservation"]);
    }

?>
