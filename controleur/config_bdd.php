<?php
    // Connex BDD Mac
    $serveur = "localhost";
    $bdd = "jo_paris";
    $user = "Pako";
    $mdp = "26092001MPk";

    //Connex BDD PC
    $serveur2 = "localhost";
    $mdp2 = "";

try {
    $pdo = new PDO('mysql:host=localhost;dbname=jo_paris', 'Pako', '26092001MPk', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données: ' . $e->getMessage());
}
?>
