<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = \Database::getInstance();
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom, $email, $mot_de_passe, $ville = null) {
        $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe, ville) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nom, $email, $hash, $ville]);
    }

}
