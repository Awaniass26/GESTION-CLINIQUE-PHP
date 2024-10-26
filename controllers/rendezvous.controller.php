<?php

require_once '../core/Controller.php';
require_once("../model/patient.model.php");
require_once("../model/medecin.model.php");
require_once("../model/rendezvous.model.php");

class RendezvousController extends controller
{

    private PatientModel $patientModel;
    private MedecinModel $medecinModel;
    private RendezvousModel $rendezvousModel;


    public function __construct()
    {
        parent::__construct();
        $this->patientModel = new PatientModel();
        $this->medecinModel = new MedecinModel();
        $this->rendezvousModel = new RendezvousModel();
        $this->load();
    }
    public function load()
    { {
            if (isset($_REQUEST['action'])) {
                if ($_REQUEST['action'] == "list-rendezvous") {
                    $this->listerRendezvous();
                } elseif ($_REQUEST['action'] == "form-rendezvous") {
                    $this->chargerFormulaire();
                } elseif ($_REQUEST['action'] == "add-rendezvous") {
                    unset($_POST['action']);
                    unset($_POST['controller']);
                    $this->ajouterRendezvous($_POST);
                }
            } else {

                $this->listerRendezvous();
            }
        }
    }

    public function listerRendezvous()
    {

        $medecins = $this->medecinModel->findAll();
        $patients = $this->patientModel->findAll();
        $rendezvous = $this->rendezvousModel->findAll();

        $medecin_id = isset($_GET['medecin']) ? intval($_GET['medecin']) : null;

        // Nombre de rendez-vous par page
        $limit = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;

        // Récupère le nombre total de rendez-vous pour la pagination
        $totalRendezvous = $this->rendezvousModel->countRendezvous($medecin_id);
        $totalPages = ceil($totalRendezvous / $limit);

        $rendezvous = $this->rendezvousModel->findAll($medecin_id);
        // Récupère les rendez-vous avec pagination
        $rendezvous = $this->rendezvousModel->findAllPaginated($offset, $limit, $medecin_id);

        // Passer les données à la vue
        require_once('../views/rendezvous/list.html.php');
    }


    public function saveRendezvous(array $rendezvous): int
    {

        $dsn = 'mysql:host=localhost:3306;dbname=gestionclinique_221';
        $username = 'root';
        $password = '';

        try {
            extract($rendezvous);
            $dbh = new PDO($dsn, $username, $password);
            $sql = "INSERT INTO `rendezvous` (`date`, `statut`, `patient_id`, `medecin_id`) VALUES ('$date', '$statut',  '$patient_id', '$medecin_id')";
            return $dbh->exec($sql);
        } catch (PDOException $e) {
            echo "Erreur de Connexion: " . $e->getMessage();
            return [];
        }
    }

    public function chargerFormulaire(): void
    {
        $patients = $this->patientModel->findAll(); // Get all patients
        $medecins = $this->medecinModel->findAll(); // Get all doctors

        // Render the view with both patients and doctors
        $this->renderView("rendezvous/form", ["patients" => $patients, "medecins" => $medecins]);
    }


    public function ajouterRendezvous(array $data): void
    {
        $this->rendezvousModel->save($data);
        $this->redirectToRoute("controller=rendezvous&action=list-rendezvous");
    }
}
