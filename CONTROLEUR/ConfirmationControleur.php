<?php
namespace Axiom\Controleur;

use Axiom\Modele\ConfirmationModel;

class ConfirmationControleur extends Controleur {
    private ConfirmationModel $model;

    public function __construct(\PDO $pdo) {
        $this->model = new ConfirmationModel($pdo);
    }

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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
            'reference'      => $data['reference'],
        ]);
    }
}
