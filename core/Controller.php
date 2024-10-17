<?php
class Controller
{
    protected string $layout;
    public function __construct()
    {
        $this->layout = "base";
    }
    public function renderView(string $view, array $data = [])
    {
        extract($data); 
        $filePath = __DIR__ . "/../views/$view.html.php"; // Utilisation de __DIR__ pour un chemin absolu
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            echo "Le fichier de vue $filePath n'existe pas.";
        }
    }
    
    public function redirectToRoute(string $path)
    {
        header("location:" . WEBROOT . "/?$path");
        exit;
    }
}