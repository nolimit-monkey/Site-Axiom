<?php
namespace Axiom\Controleur;

use Axiom\Modele\PaiementModel;

// Contrôleur de la page de paiement (étape 3 du tunnel de commande).
// Reçoit le mode de livraison choisi à l'étape précédente et construit
// le récapitulatif de commande (articles + frais de livraison + total).
class PaiementControleur extends Controleur {
    private PaiementModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new PaiementModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Lecture du mode de livraison en priorité depuis POST (formulaire facturation),
        // avec fallback GET pour permettre un rechargement direct de la page.
        $deliveryMode = filter_input(INPUT_POST, 'delivery_mode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$deliveryMode) {
            $deliveryMode = filter_input(INPUT_GET, 'delivery_mode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        $data = $this->model->getOrderSummary($_SESSION['panier'] ?? [], $deliveryMode);
        $this->render('paiement', [
            'deliveryMode'   => $data['deliveryMode'],
            'deliveryLabel'  => $data['deliveryLabel'],
            'shippingAmount' => $data['shippingAmount'],
            'cartItems'      => $data['cartItems'],
            'subtotal'       => $data['subtotal'],
            'grandTotal'     => $data['grandTotal'],
        ]);
    }
}
