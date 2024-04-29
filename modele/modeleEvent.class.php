<?php
require_once("modele/modeleMere.class.php");

class ModeleEvent
{
    private $pdo;

    public function __construct($serveur, $serveur2, $bdd, $user, $mdp, $mdp2)
    {
        // Tente de créer une instance PDO à partir de la classe modèle mère
        try {
            $this->pdo = ModeleMere::getPdo($serveur, $serveur2, $bdd, $user, $mdp, $mdp2);
        } catch (PDOException $e) {
            error_log("Connection error: " . $e->getMessage());
            throw new Exception("Database connection could not be established.");
        }
    }

    public function insertEvenement($tab)
    {
        $requete = "INSERT INTO Evenement (type, dateEvent, nomEvenement, description, adresse, horraireD, horraireF, capacite, idcategorie)
                    VALUES (:type, :dateEvent, :nomEvenement, :description, :adresse, :horraireD, :horraireF, :capacite, :idcategorie)";
        $donnees = array(
            ":type" => $tab['type'],
            ":dateEvent" => $tab['dateEvent'] ?: '0000-00-00',
            ":nomEvenement" => $tab['nomEvenement'],
            ":description" => $tab['description'],
            ":adresse" => $tab['adresse'],
            ":horraireD" => $tab['horraireD'],
            ":horraireF" => $tab['horraireF'],
            ":capacite" => $tab['capacite'],
            ":idcategorie" => $tab['idcategorie'],
        );

        if ($this->pdo !== null) {
            try {
                $insert = $this->pdo->prepare($requete);
                $insert->execute($donnees);
            } catch (PDOException $e) {
                error_log("Insert event failed: " . $e->getMessage());
                throw new Exception("Failed to insert event.");
            }
        }
    }

    public function selectAllEvenements()
    {
        $requete = "SELECT * FROM Evenement;";
        try {
            $select = $this->pdo->prepare($requete);
            $select->execute();
            return $select->fetchAll();
        } catch (PDOException $e) {
            error_log("Select all events failed: " . $e->getMessage());
            throw new Exception("Failed to fetch events.");
        }
    }

    public function selectWhereEvenement($idevenement)
    {
        $requete = "SELECT * FROM Evenement WHERE idevenement = :idevenement;";
        try {
            $select = $this->pdo->prepare($requete);
            $select->execute([':idevenement' => $idevenement]);
            return $select->fetch();
        } catch (PDOException $e) {
            error_log("Select event failed: " . $e->getMessage());
            throw new Exception("Failed to fetch event.");
        }
    }

    public function deleteEvenement($idevenement)
    {
        $requete = "DELETE FROM Evenement WHERE idevenement = :idevenement;";
        try {
            $delete = $this->pdo->prepare($requete);
            $delete->execute([':idevenement' => $idevenement]);
        } catch (PDOException $e) {
            error_log("Delete event failed: " . $e->getMessage());
            throw new Exception("Failed to delete event.");
        }
    }

    public function updateEvenement($tab)
    {
        $requete = "update Evenement set type=:type, dateEvent=:dateEvent, nomEvenement=:nomEvenement, description=:description, adresse=:adresse, horraireD=:horraireD, horraireF=:horraireF, capacite=:capacite, idcategorie=:idcategorie  where idevenement=:idevenement;";
        $donnees = array(
            ":type" => $tab['type'],
            ":dateEvent" => $tab['dateEvent'],
            ":nomEvenement" => $tab['nomEvenement'],
            ":description" => $tab['description'],
            ":adresse" => $tab['adresse'],
            ":horraireD" => $tab['horraireD'],
            ":horraireF" => $tab['horraireF'],
            ":capacite" => $tab['capacite'],
            ":idcategorie" => $tab['idcategorie'],
            ":idevenement" => $tab['idevenement']
        );
        if ($this->pdo != null) {
            //on prepare la requete
            $insert = $this->pdo->prepare($requete);
            $insert->execute($donnees);
        }
    }
}
?>
