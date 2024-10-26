<?php
require_once("../core/Model.php");

class RendezvousModel extends Model {

    public function findAll($medecin_id = null): array {
        $sql = "SELECT r.*, p.nom AS patient_nom, p.prrenom AS patient_prenom, 
                       m.nom AS medecin_nom, m.prenom AS medecin_prenom
                FROM rendezvous r
                JOIN patient p ON r.patient_id = p.id
                JOIN medecin m ON r.medecin_id = m.id";

        if ($medecin_id) {
            $sql .= " WHERE r.medecin_id = :medecin_id";
        }

        $stmt = $this->pdo->prepare($sql);

        if ($medecin_id) {
            $stmt->bindParam(':medecin_id', $medecin_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllPaginated(int $offset, int $limit, $medecin_id = null): array {
        $sql = "SELECT r.*, p.nom AS patient_nom, p.prrenom AS patient_prenom, 
                       m.nom AS medecin_nom, m.prenom AS medecin_prenom
                FROM rendezvous r
                JOIN patient p ON r.patient_id = p.id
                JOIN medecin m ON r.medecin_id = m.id";

        if ($medecin_id) {
            $sql .= " WHERE r.medecin_id = :medecin_id";
        }

        $sql .= " LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($sql);

        if ($medecin_id) {
            $stmt->bindParam(':medecin_id', $medecin_id, PDO::PARAM_INT);
        }

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countRendezvous($medecin_id = null): int {
        $sql = "SELECT COUNT(*) FROM rendezvous";
        if ($medecin_id) {
            $sql .= " WHERE medecin_id = :medecin_id";
        }

        $stmt = $this->pdo->prepare($sql);

        if ($medecin_id) {
            $stmt->bindParam(':medecin_id', $medecin_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function save(array $rendezvous): int {
        if (!isset($rendezvous['date'], $rendezvous['statut'], $rendezvous['patient_id'], $rendezvous['medecin_id'])) {
            throw new Exception("Un ou plusieurs champs requis ne sont pas définis.");
        }

        $sql = "INSERT INTO rendezvous (date, statut, patient_id, medecin_id) 
                VALUES (:date, :statut, :patient_id, :medecin_id)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':date', $rendezvous['date']);
        $stmt->bindParam(':statut', $rendezvous['statut']);
        $stmt->bindParam(':patient_id', $rendezvous['patient_id']);
        $stmt->bindParam(':medecin_id', $rendezvous['medecin_id']);

        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
        return 0;
    }
}

