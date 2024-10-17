<?php
require_once("../core/Model.php");
class PatientModel extends Model{

    public function findAll(): array
    {
      
        $dsn = 'mysql:host=localhost:3306;dbname=gestionclinique_221';
        $username = 'root';
        $password = '';

        try {
            $dbh = new PDO($dsn, $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM patient";
            $stm = $dbh->query($sql);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur de Connexion: " . $e->getMessage();
            return [];
        }
    }

    public function save(array $patient): int
{
    extract($patient);

    // Corrected SQL statement
    $sql = "INSERT INTO patient (nom, prrenom, date_naissance, adresse) 
            VALUES (:nom, :prrenom, :date_naissance, :adresse)";

    try {
        // Database connection
        $dbh = new PDO('mysql:host=localhost:3306;dbname=gestionclinique_221', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the statement and bind parameters
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prrenom', $prrenom);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':adresse', $adresse);

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