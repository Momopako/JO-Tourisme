<?php
session_start();

// Vérifiez si la session contient déjà des réservations
if (!isset($_SESSION['reservations'])) {
    $_SESSION['reservations'] = [];  // Initialisez si ce n'est pas déjà fait
}

echo "<h2>Mes Réservations</h2>";

if (count($_SESSION['reservations']) > 0) {
    echo "<table class='table-reservations'>";
    echo "<tr><th>Type</th><th>ID</th></tr>";

    foreach ($_SESSION['reservations'] as $reservation) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($reservation['type']) . "</td>";
        echo "<td>" . htmlspecialchars($reservation['id']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Vous n'avez aucune réservation.</p>";
}
?>

<style>
    .table-reservations {
        width: 100%;
        border-collapse: collapse;
    }
    .table-reservations, .table-reservations th, .table-reservations td {
        border: 1px solid black;
    }
    .table-reservations th, .table-reservations td {
        padding: 8px;
        text-align: left;
    }
</style>

