<?php
namespace Axiom\Controleur;

use Axiom\Modele\PanierModel;

// Contrôleur du panier d'achat.
// Gère deux cas :
//   POST → suppression d'un produit du panier, puis redirection (PRG pattern)
//   GET  → affichage du panier avec le total calculé
class PanierControleur extends Controleur {
    private PanierModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new PanierModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Suppression d'un article : le formulaire de la vue envoie remove_product_id.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $removeProductId = filter_input(INPUT_POST, 'remove_product_id', FILTER_VALIDATE_INT);
            if ($removeProductId && isset($_SESSION['panier'][$removeProductId])) {
                unset($_SESSION['panier'][$removeProductId]);
                // Si le panier est vide après suppression, on retire la clé de session entière.
                if ($_SESSION['panier'] === []) {
                    unset($_SESSION['panier']);
                }
            }
            // PRG (Post/Redirect/Get) : évite la re-soumission du formulaire au rechargement.
            header('Location: ' . BASE_URL . 'panier');
            exit;
        }

        // Lecture du panier depuis la session (tableau vide si absent).
        // Le modèle enrichit les données avec les prix depuis la BDD.
        $data = $this->model->getCartItems($_SESSION['panier'] ?? []);
        $this->render('panier', [
            'cartItems' => $data['items'],
            'total'     => $data['total'],
        ]);
    }
}
