<?php
require_once("../model/medecin.model.php");
require_once("../model/patient.model.php");
require_once("../model/rendezvous.model.php");

require_once '../core/Controller.php';

class MedecinController extends controller{
    private MedecinModel $medecinModel;
    private PatientModel $patientModel;
    private RendezvousModel $rendezvousModel;

    public function __construct()

    {
        parent::__construct();
        $this->medecinModel = new MedecinModel();
        $this->patientModel = new PatientModel();
        $this->rendezvousModel = new RendezvousModel();
        $this->load();
    }

    public function load(){
        {
            // $this->layout = "base1";
            if (isset($_REQUEST['action'])) {
                if ($_REQUEST['action'] == "liste-medecin") {
                    $this->listerMedecin();
                } elseif ($_REQUEST['action'] == "form-medecin") {
                    $this->chargerFormulaire();
                } elseif ($_REQUEST['action'] == "add-medecin") {
                    unset($_POST['action']);
                    unset($_POST['controller']);
                    $this->ajouterMedecin($_POST);
                }
            } else {
                
                $this->listerMedecin();
            
            }
        }
    }

    public function listerMedecin(): void {
        $medecins = $this->medecinModel->findAll(); // Récupérer tous les médecins
        $this->renderView("medecins/liste", ["medecins" => $medecins]);
    }

    public function chargerFormulaire():void{
        $this->renderView("medecins/form", ["medecins" => $this->medecinModel->findAll()]);
    }

    public function saveMedecin(array $medecin): int
    {
        
        $dsn= 'mysql:host=localhost:3306;dbname=gestionclinique_221';
        $username= 'root';
        $password='';
       
        try {
            extract($medecin);
            $dbh = new PDO($dsn, $username, $password);
            $sql = "INSERT INTO medecin (nom, prenom, specialite) VALUES ('$nom', '$prenom', '$specialite')";

            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':specialite', $specialite);
            
            return $stmt->execute();
          
        } catch (PDOException $e) {
            echo "Erreur de Connexion: " . $e->getMessage();
            return [];
        }
    }

    public function ajouterMedecin(array $data): void {
        if (empty($data['nom']) || empty($data['prenom']) || empty($data['specialite'])) {
            echo "Un ou plusieurs champs requis ne sont pas définis.";
            return; // Arrêtez l'exécution si les champs sont vides
        }
    
        $result = $this->medecinModel->save($data);
        
        if ($result) {
            // Redirection si l'ajout a réussi
            $this->redirectToRoute("controller=medecin&action=liste-medecin");
        } else {
            // Message d'erreur si l'ajout a échoué
            echo "Erreur lors de l'ajout du médecin.";
        }
    }
    
    


}
?>