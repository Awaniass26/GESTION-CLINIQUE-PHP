<?php
class Router
{
    public static function run()
    {
        
        if (isset($_REQUEST['controller'])) {
            if ($_REQUEST['controller'] == "medecin") {
                require_once("../controllers/medecin.controller.php");
                $controller = new MedecinController();
            } else if ($_REQUEST['controller'] == "patient") {
                require_once("../controllers/patient.controller.php");
                $controller = new PatientController();
            }
            else if ($_REQUEST['controller'] == "rendezvous") {
                require_once("../controllers/rendezvous.controller.php");
                $controller = new RendezvousController();
            }
        }else{
            require_once("../controllers/medecin.controller.php");
                $controller = new MedecinController();
        }
    }
}
