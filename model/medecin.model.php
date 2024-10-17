<?php
require_once("../core/Model.php");
class MedecinModel extends Model{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "medecin";
    }

    public function findAll(): array
    {
        return $this->executeSelect("SELECT a.id AS id, a.nom, a.prenom, a.specialite FROM medecin a;");
        
    }

    public function save(array $medecin): int {
        return $this->saveMedecin($medecin);
    }

    public function saveMedecin(array $medecin): int {
        $dsn = 'mysql:host=localhost;dbname=gestionclinique_221';
        $username = 'root';
        $password = '';
    
        try {
            // Vérifiez que toutes les variables nécessaires sont définies
            if (!isset($medecin['nom'], $medecin['prenom'], $medecin['specialite'])) {
                throw new Exception("Un ou plusieurs champs requis ne sont pas définis.");
            }
            
            // Créez une nouvelle connexion
            $dbh = new PDO($dsn, $username, $password);
            
            // Préparez la requête avec des placeholders
            $sql = "INSERT INTO medecin (nom, prenom, specialite) VALUES (:nom, :prenom, :specialite)";
            
            // Préparez et liez les paramètres
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':nom', $medecin['nom']);
            $stmt->bindParam(':prenom', $medecin['prenom']);
            $stmt->bindParam(':specialite', $medecin['specialite']);
            
            // Exécutez la requête
            if ($stmt->execute()) {
                return $stmt->rowCount(); // Retourne le nombre de lignes affectées
            } else {
                return 0; // Retourne 0 si l'exécution échoue
            }
        } catch (PDOException $e) {
            echo "Erreur de Connexion: " . $e->getMessage();
            return 0; // Retourne 0 en cas d'erreur
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0; // Retourne 0 si une exception se produit
        }
    }
    
}

?>