<?php
namespace Axiom\Controleur;

use Axiom\Modele\ConfirmationModel;

// Contrôleur de la page de confirmation (étape finale du tunnel de commande).
// Reçoit le mode de livraison et le moyen de paiement depuis le formulaire /paiement,
// et affiche le récapitulatif final avec une référence de commande générée.
class ConfirmationControleur extends Controleur {
    private ConfirmationModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new ConfirmationModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ces deux valeurs transitent depuis /paiement via champs cachés et bouton radio.
        $deliveryMode  = filter_input(INPUT_POST, 'delivery_mode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $paymentMethod = filter_input(INPUT_POST, 'payment_method', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = $this->model->getConfirmationData($_SESSION['panier'] ?? [], $deliveryMode, $paymentMethod);
        $this->render('confirmation', [
            'deliveryLabel'  => $data['deliveryLabel'],
            'shippingAmount' => $data['shippingAmount'],
            'paymentLabel'   => $data['paymentLabel'],
            'cartItems'      => $data['cartItems'],
            'subtotal'       => $data['subtotal'],
            'grandTotal'     => $data['grandTotal'],
            'reference'      => $data['reference'], // Ex : AXM-20260601-A3F9C2
        ]);
    }
}
