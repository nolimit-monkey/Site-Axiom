<?php
$deliveryMode = filter_input(INPUT_POST, 'delivery_mode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$deliveryMode) {
    $deliveryMode = filter_input(INPUT_GET, 'delivery_mode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

$deliveryLabels = [
    'standard' => 'Standard (3 a 5 jours)',
    'express' => 'Express (24h a 48h)',
    'pickup' => 'Retrait en magasin',
];

$deliveryPrices = [
    'standard' => 7.90,
    'express' => 14.90,
    'pickup' => 0.00,
];

$deliveryLabel = $deliveryLabels[$deliveryMode] ?? 'Non selectionne';
$shippingAmount = $deliveryPrices[$deliveryMode] ?? 0.00;

$cartSession = $_SESSION['panier'] ?? [];
$cart = [];

foreach ($cartSession as $productId => $quantity) {
    $cleanProductId = filter_var($productId, FILTER_VALIDATE_INT);
    $cleanQuantity = filter_var($quantity, FILTER_VALIDATE_INT);

    if ($cleanProductId && $cleanQuantity && $cleanQuantity > 0) {
        $cart[$cleanProductId] = $cleanQuantity;
    }
}

$cartItems = [];
$subtotal = 0.0;

if ($cart !== []) {
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = $pdo->prepare("
        SELECT id, nom, prix
        FROM produits
        WHERE id IN ($placeholders)
    ");
    $stmt->execute($ids);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produits as $produit) {
        $productId = (int) $produit['id'];
        $quantity = $cart[$productId] ?? 0;

        if ($quantity < 1) {
            continue;
        }

        $unitPrice = (float) $produit['prix'];
        $lineTotal = $unitPrice * $quantity;
        $subtotal += $lineTotal;

        $cartItems[] = [
            'nom' => $produit['nom'],
            'quantity' => $quantity,
            'line_total' => $lineTotal,
        ];
    }
}

$grandTotal = $subtotal + $shippingAmount;
