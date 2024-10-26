<?php
require_once("../core/Model.php");
class PatientModel extends Model {
    
    public function __construct() {
        $this->ouvrirConnexion(); // Utilisation de la méthode de connexion fournie
    }

    public function findAll(): array {
        return $this->findAllPaginated(0, 100); // Exemple d'utilisation de la pagination
    }

    public function findAllPaginated(int $offset, int $limit): array {
        $sql = "SELECT id, nom, prrenom, date_naissance, adresse FROM patient LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPatients(): int {
        $sql = "SELECT COUNT(*) FROM patient";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }

    public function save(array $patient): int {
        if (!isset($patient['nom'], $patient['prrenom'], $patient['date_naissance'], $patient['adresse'])) {
            throw new Exception("Un ou plusieurs champs requis ne sont pas définis.");
        }

        $sql = "INSERT INTO patient (nom, prrenom, date_naissance, adresse) 
                VALUES (:nom, :prrenom, :date_naissance, :adresse)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nom', $patient['nom']);
        $stmt->bindParam(':prrenom', $patient['prrenom']);
        $stmt->bindParam(':date_naissance', $patient['date_naissance']);
        $stmt->bindParam(':adresse', $patient['adresse']);

        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
        return 0;
    }
}
?>



