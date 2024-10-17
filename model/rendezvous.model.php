<?php
require_once("../core/Model.php");
class RendezvousModel extends Model{
    
    public function findAll(): array
    {
        $dsn = 'mysql:host=localhost:3306;dbname=gestionclinique_221';
        $username = 'root';
        $password = '';
    
        try {
            $dbh = new PDO($dsn, $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Requête avec jointure pour récupérer les noms et prénoms des patients et médecins
            $sql = "SELECT r.*, p.nom AS patient_nom, p.prrenom AS patient_prenom, m.nom AS medecin_nom, m.prenom AS medecin_prenom
                    FROM rendezvous r
                    JOIN patient p ON r.patient_id = p.id
                    JOIN medecin m ON r.medecin_id = m.id
                    LIMIT 0, 25;
                    ";
    
            $stm = $dbh->query($sql);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur de Connexion: " . $e->getMessage();
            return [];
        }
    }
    

    public function save(array $rendezvous): int
{
    extract($rendezvous);

    // Corrected SQL statement
    $sql = "INSERT INTO rendezvous (date, statut, patient_id, medecin_id) 
        VALUES (:date, :statut, :patient_id, :medecin_id)";


    try {
        // Database connection
        $dbh = new PDO('mysql:host=localhost:3306;dbname=gestionclinique_221', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the statement and bind parameters
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':patient_id', $patient_id);
        $stmt->bindParam(':medecin_id', $medecin_id);

        // Execute the query
        if ($stmt->execute()) {
            return $stmt->rowCount(); // Return the number of affected rows
        } else {
            return 0; // Return 0 if execution fails
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
        return 0;
    }
}



}
?>