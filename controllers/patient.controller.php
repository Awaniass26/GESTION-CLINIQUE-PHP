<?php
require_once("../model/patient.model.php");
require_once '../core/Controller.php';

class PatientController extends controller{
   private PatientModel $patientModel;
    public function __construct() {
        parent::__construct();
        $this->patientModel = new PatientModel();
        $this->load();
    }
    public function load(){
        {
            // $this->layout = "base1";
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-patient") {
                unset($_POST['action']);
                unset($_POST['controller']);
                // var_dump($_POST);
                // die;
                $this->ajouterPatient($_POST);
            } elseif ($_REQUEST['action'] == "list-patient") {
                $this->listerPatient();
            }elseif($_REQUEST['action']=="form-patient"){
                $this->chargerFormulaire();
            } else {
                echo "Action invalide";
            }
        }
        }
    }

    public function listerPatient(): void {
        $patients = $this->patientModel->findAll();
        $limit = 5; // Nombre de patients par page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalPatients = $this->patientModel->countPatients();
        $totalPages = ceil($totalPatients / $limit);
        $offset = ($currentPage - 1) * $limit;

        
    
        $patients = $this->patientModel->findAllPaginated($offset, $limit);
        $this->renderView("patients/list", [
            "patients" => $patients,
            "currentPage" => $currentPage,
            "totalPages" => $totalPages
        ]);
    }
    

    public function ajouterPatient(array $data): void
    {
        $this->patientModel->save($data);
        header("Location: " . WEBROOT . "/?controller=patient&action=list-patient");
        exit();

    
    }

    public function chargerFormulaire():void{
        $this->renderView("patients/form", ["patients" => $this->patientModel->findAll()]);
    }


    


}
?>