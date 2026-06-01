<?php
namespace Axiom\Modele;

class ProduitModel {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

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
