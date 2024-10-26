<?php
require_once("../core/Model.php");

class MedecinModel extends Model {

    public function __construct() {
        $this->ouvrirConnexion(); // Utiliser la connexion fournie par la classe parent
        $this->table = "medecin";
    }

    public function findAll(int $page = 1, int $limit = 5): array {
        $offset = ($page - 1) * $limit; // Calculer l'offset
        $sql = "SELECT * FROM medecin LIMIT :limit OFFSET :offset";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll(): int {
        $sql = "SELECT COUNT(*) FROM $this->table";
        return (int)$this->executeSelect($sql, true)['COUNT(*)'];
    }

    public function save(array $medecin): int {
        if (!isset($medecin['nom'], $medecin['prenom'], $medecin['specialite'])) {
            throw new Exception("Un ou plusieurs champs requis ne sont pas définis.");
        }

        $sql = "INSERT INTO medecin (nom, prenom, specialite) VALUES (:nom, :prenom, :specialite)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nom', $medecin['nom']);
        $stmt->bindParam(':prenom', $medecin['prenom']);
        $stmt->bindParam(':specialite', $medecin['specialite']);

        if ($stmt->execute()) {
            return $stmt->rowCount();
        } 
        return 0;
    }
}
