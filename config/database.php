<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        if (!extension_loaded('pdo')) 
        {
            die("Erreur de connexion : l'extension PDO n'est pas activée dans PHP.");
        }

        if (!extension_loaded('pdo_pgsql')) {
            die("Erreur de connexion : le driver PDO PostgreSQL (pdo_pgsql) n'est pas activé dans PHP.");
        }

        $host = 'localhost';
        $port = '5432';
        $dbname = 'skillbridge';
        $username = 'postgres';
        $password = 'josue';

        try {
            // DSN pour PostgreSQL
            $this->pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    /**Ce bout de code permettra d'éviter de récréer une conexion sql à chaque requete
     * Centralise la config de connexion
     * Verifie aussi que les extensions pdo et pdo_pgsql sont actives avant de se connecter
     * 
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
