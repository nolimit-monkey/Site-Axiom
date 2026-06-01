<?php
namespace Axiom\Controleur;

use Axiom\Modele\PaiementModel;

class PaiementControleur extends Controleur {
    private PaiementModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new PaiementModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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
