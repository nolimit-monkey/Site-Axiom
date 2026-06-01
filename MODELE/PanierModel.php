<?php
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
$total = 0.0;

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
        $total += $lineTotal;

        $cartItems[] = [
            'id' => $productId,
            'nom' => $produit['nom'],
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'line_total' => $lineTotal,
        ];
    }
}
