<?php
 class Model{
    protected string  $dsn = 'mysql:host=localhost:3306;dbname=gestionclinique_221';
    protected $username = 'root';
    protected $password = '';
    protected PDO|NULL $pdo = null;
    protected string $table;


    public function __construct() {
        $this->ouvrirConnexion(); 
    }

    public function ouvrirConnexion(): void {
        try {
            if ($this->pdo === null) {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            echo "Erreur de Connexion: " . $e->getMessage();
        }
    }

    public function fermerConnexion(): void
    {
        if ($this->pdo != null) {
            $this->pdo = null;
        }
    }

    protected function executeSelect(string $sql, bool $fetch = false): array|false{
    {
        try {
            $stm = $this->pdo->query($sql);
            return $fetch ? $stm->fetch(PDO::FETCH_ASSOC) : $stm->fetchAll();
        }

        
        catch (PDOException $e) {
            echo "Erreur de Connexion: " . $e->getMessage();
        }
    }
}

    
    public function executeUpdate(string $sql): int
{
    try {
        $result = $this->pdo->exec($sql);
        return $result === false ? 0 : $result; // Return 0 if exec fails
    } catch (PDOException $e) {
        echo "Erreur de Connexion: " . $e->getMessage();
        return 0; 
    }
}


    public function findAll(): array
    {
        return $this->executeSelect("SELECT * FROM $this->table ");
    }

}
