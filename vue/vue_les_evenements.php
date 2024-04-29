<h2>Liste des évènements</h2>
<table class="table-affiche">
    <tr>
        <td>Id Evenement</td>
        <td>Type</td>
        <td>Date Evenement</td>
        <td>Nom Evenement</td>
        <td>Description</td>
        <td>Adresse</td>
        <td>Horraire Début</td>
        <td>Horraire Fin</td>
        <td>Capacite</td>
        <td>Idcategorie</td>
        <td>Opérations</td>
    </tr>

    <?php
    foreach ($lesEvenements as $unEvenement) {
        echo "<tr>
                <td>" . htmlspecialchars($unEvenement["idevenement"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["type"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["dateEvent"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["nomEvenement"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["description"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["adresse"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["horraireD"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["horraireF"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["capacite"]) . "</td>
                <td>" . htmlspecialchars($unEvenement["idcategorie"]) . "</td>";

        if (isset($_SESSION['role']) && ($_SESSION['role'] == 'clientPart')) {
            echo "<td><button onclick='ajouterReservation({$unEvenement['idevenement']})'>+</button></td>";
        } else if (isset($_SESSION['role']) && $_SESSION['role'] != 'Guest' && $_SESSION['role'] != 'clientPart') {
            echo "<td>
                    <a class='img-dif' href='index.php?page=1&action=sup&idevenement=" . $unEvenement['idevenement'] . "'>
                        <img src='images/Delete.png' height='30' width='30'>
                    </a>
                    <a class='img-dif' href='index.php?page=1&action=edit&idevenement=" . $unEvenement['idevenement'] . "'>
                        <img src='images/Edit.png' height='30' width='30'>
                    </a>
                  </td>";
        } else {
            echo "<td>Accès Restreint</td>";
        }

        echo "</tr>";
    }
    ?>
</table>
<script>
    function ajouterReservation(type, id) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "path/to/your/reservationHandler.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (this.status === 200) {
                alert("Réservation ajoutée avec succès");
                // Mettre à jour dynamiquement la liste des réservations affichées, si nécessaire
            } else {
                alert("Erreur lors de l'ajout de la réservation");
            }
        };
        xhr.send(`type=${type}&id=${id}`);
    }

</script>

</main>

