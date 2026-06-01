<?php
namespace Axiom\Controleur;

use Axiom\Modele\PanierModel;

class PanierControleur extends Controleur {
    private PanierModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new PanierModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $removeProductId = filter_input(INPUT_POST, 'remove_product_id', FILTER_VALIDATE_INT);
            if ($removeProductId && isset($_SESSION['panier'][$removeProductId])) {
                unset($_SESSION['panier'][$removeProductId]);
                if ($_SESSION['panier'] === []) {
                    unset($_SESSION['panier']);
                }
            }
            header('Location: ' . BASE_URL . 'panier');
            exit;
        }

        $data = $this->model->getCartItems($_SESSION['panier'] ?? []);
        $this->render('panier', [
            'cartItems' => $data['items'],
            'total'     => $data['total'],
        ]);
    }
}
