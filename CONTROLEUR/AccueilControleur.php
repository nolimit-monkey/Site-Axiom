<?php
namespace Axiom\Controleur;

use Axiom\Modele\ProduitModel;

class AccueilControleur extends Controleur {
    private ProduitModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new ProduitModel($pdo);
    }

    public function index(): void {
        $data = $this->model->findAllGroupedByCategory();
        $this->render('accueil', [
            'sections' => $data['sections'],
            'byId'     => $data['byId'],
        ]);
    }
}
