<?php
require_once __DIR__ . '/../config/database.php';

class Annonce {
    private $pdo;

    public function __construct() {
        $this->pdo = \Database::getInstance();
    }

    // Récupérer toutes les annonces (avec pagination simple)
    public function getAll($limit = 10, $offset = 0) {
        $stmt = $this->pdo->prepare("
            SELECT a.*, u.nom as auteur_nom, u.avatar_url, c.nom as categorie_nom
            FROM annonce a
            JOIN utilisateur u ON a.id_utilisateur = u.id
            LEFT JOIN categorie c ON a.id_categorie = c.id
            WHERE a.statut = 'active'
            ORDER BY a.date_publication DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une annonce par son ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("
            SELECT a.*, u.nom as auteur_nom, u.avatar_url, u.bio as auteur_bio, c.nom as categorie_nom
            FROM annonce a
            JOIN utilisateur u ON a.id_utilisateur = u.id
            LEFT JOIN categorie c ON a.id_categorie = c.id
            WHERE a.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer une annonce
    public function create(
        $titre, $description, $prix_min, $prix_max, $type_prix, $duree_livraison, $id_utilisateur, $id_categorie) {
        $stmt = $this->pdo->prepare("
            INSERT INTO annonce (titre, description, prix_min, prix_max, type_prix, duree_livraison, id_utilisateur, id_categorie)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$titre, $description, $prix_min, $prix_max, $type_prix, $duree_livraison, $id_utilisateur, $id_categorie]);
    }

    // Mettre à jour une annonce
    public function update($id, $titre, $description, $prix_min, $prix_max, $type_prix, $duree_livraison, $id_categorie) {
        $stmt = $this->pdo->prepare("
            UPDATE annonce
            SET titre = ?, description = ?, prix_min = ?, prix_max = ?, type_prix = ?, duree_livraison = ?, id_categorie = ?
            WHERE id = ?
        ");
        return $stmt->execute([$titre, $description, $prix_min, $prix_max, $type_prix, $duree_livraison, $id_categorie, $id]);
    }

    // Supprimer une annonce (ou la marquer comme fermée)
    public function delete($id) {
        // Option 2 : suppression logique (changer statut)
        $stmt = $this->pdo->prepare("UPDATE annonce SET statut = 'fermée' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Compter le nombre total d'annonces actives (pour pagination)
    public function countAll() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM annonce WHERE statut = 'active'");
        return $stmt->fetchColumn();
    }

    // Récupérer les annonces d'un utilisateur
    public function getByUser($userId) {
        $stmt = $this->pdo->prepare("
            SELECT a.*, c.nom as categorie_nom
            FROM annonce a
            LEFT JOIN categorie c ON a.id_categorie = c.id
            WHERE a.id_utilisateur = ?
            ORDER BY a.date_publication DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vérifier si un utilisateur est propriétaire d'une annonce
    public function isOwner($annonceId, $userId) {
        $stmt = $this->pdo->prepare("SELECT id_utilisateur FROM annonce WHERE id = ?");
        $stmt->execute([$annonceId]);
        $annonce = $stmt->fetch(PDO::FETCH_ASSOC);
        return $annonce && (int) $annonce['id_utilisateur'] === (int) $userId;
    }
}
