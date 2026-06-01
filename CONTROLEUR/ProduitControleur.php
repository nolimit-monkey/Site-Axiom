<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

    if ($postedId) {
        if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (!isset($_SESSION['panier'][$postedId])) {
            $_SESSION['panier'][$postedId] = 0;
        }

        $_SESSION['panier'][$postedId] += 1;

        header('Location: ' . BASE_URL . 'panier.php');
        exit;
    }
}

require_once __DIR__ . '/../MODELE/ProduitDetailModel.php';
require_once __DIR__ . '/../VUE/produit.php';
