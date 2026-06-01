<?php
namespace Axiom\Modele;

// Modèle gérant les accès BDD pour la table `produits`.
class ProduitModel {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Retourne tous les produits organisés en deux structures parallèles :
    //   'sections' : [ categorie_id => [ produit, produit, ... ], ... ]
    //   'byId'     : [ id => produit, ... ]
    // La vue accueil.php utilise $sections[1][0] pour afficher le premier produit
    // de chaque catégorie dans la grille de mise en avant.
    public function findAllGroupedByCategory(): array {
        $stmt = $this->pdo->prepare("
            SELECT id, nom, description, image_url, prix, categorie_id, stock
            FROM produits
            ORDER BY categorie_id, id
        ");
        $stmt->execute();
        $produits = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $sections = [];
        $byId     = [];
        foreach ($produits as $produit) {
            $sections[$produit['categorie_id']][] = $produit;
            $byId[$produit['id']] = $produit;
        }

        return ['sections' => $sections, 'byId' => $byId];
    }

    // Retourne un seul produit par son identifiant, ou null s'il n'existe pas.
    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("
            SELECT id, nom, description, image_url, prix, categorie_id, stock
            FROM produits
            WHERE id = :id
            LIMIT 1
        ");
        $stmt->execute(['id' => $id]);
        $produit = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $produit ?: null;
    }
}
