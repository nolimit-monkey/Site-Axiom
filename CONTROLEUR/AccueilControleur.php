<?php
namespace Axiom\Controleur;

use Axiom\Modele\ProduitModel;

// Contrôleur de la page d'accueil.
// Responsabilité : récupérer tous les produits groupés par catégorie
// et les passer à la vue accueil.php.
class AccueilControleur extends Controleur {
    private ProduitModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new ProduitModel($pdo);
    }

    public function index(): void {
        // $data contient deux index :
        //   'sections' : tableau indexé par categorie_id, chaque entrée = liste de produits
        //   'byId'     : tableau indexé par id produit, pour un accès direct par identifiant
        $data = $this->model->findAllGroupedByCategory();
        $this->render('accueil', [
            'sections' => $data['sections'],
            'byId'     => $data['byId'],
        ]);
    }
}
