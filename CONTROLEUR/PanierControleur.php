<?php
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

    header('Location: ' . BASE_URL . 'panier.php');
    exit;
}

require_once __DIR__ . '/../MODELE/PanierModel.php';
require_once __DIR__ . '/../VUE/panier.php';
