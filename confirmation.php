<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$deliveryMode = filter_input(INPUT_POST, 'delivery_mode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$paymentMethod = filter_input(INPUT_POST, 'payment_method', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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

$paymentLabels = [
    'card' => 'Carte bancaire',
    'paypal' => 'PayPal',
    'wallet' => 'Apple Pay / Google Pay',
];

$deliveryLabel = $deliveryLabels[$deliveryMode] ?? 'Non selectionne';
$shippingAmount = $deliveryPrices[$deliveryMode] ?? 0.00;
$paymentLabel = $paymentLabels[$paymentMethod] ?? 'Non selectionne';

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
$reference = 'AXM-' . date('Ymd') . '-' . strtoupper(substr(md5((string) microtime(true)), 0, 6));
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?= BASE_URL ?>src/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/utilitaire.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/header.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/confirmation.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/logo_axiom-small.png" />
    <title>Confirmation | AXIOM</title>
  </head>
  <body>
    <?php require_once __DIR__ . '/header.php'; ?>

    <main class="confirm-page">
      <section class="confirm-page__container" aria-labelledby="confirm-title">
        <p class="confirm-page__eyebrow">Commande validee</p>
        <h1 id="confirm-title">Confirmation de paiement</h1>
        <p class="confirm-page__subtitle">
          Merci pour votre commande. Vous pouvez imprimer ce recapitulatif.
        </p>

        <div class="confirm-sheet" id="print-area">
          <header class="confirm-sheet__head">
            <div>
              <h2>AXIOM auto</h2>
              <p>Date : <?= date('d/m/Y H:i') ?></p>
            </div>
            <div class="confirm-sheet__ref">
              <span>Reference</span>
              <strong><?= htmlspecialchars($reference) ?></strong>
            </div>
          </header>

          <section class="confirm-sheet__meta">
            <p><span>Mode de paiement</span><strong><?= htmlspecialchars($paymentLabel) ?></strong></p>
            <p><span>Mode de livraison</span><strong><?= htmlspecialchars($deliveryLabel) ?></strong></p>
          </section>

          <section class="confirm-sheet__items">
            <h3>Produits</h3>
            <ul>
              <?php if ($cartItems === []) : ?>
              <li class="confirm-sheet__empty">Aucun produit trouve dans le panier.</li>
              <?php else : ?>
              <?php foreach ($cartItems as $item) : ?>
              <li>
                <span><?= htmlspecialchars($item['nom']) ?> x<?= (int) $item['quantity'] ?></span>
                <strong><?= number_format($item['line_total'], 2, ',', ' ') ?> &euro;</strong>
              </li>
              <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </section>

          <section class="confirm-sheet__totals">
            <p><span>Sous-total</span><strong><?= number_format($subtotal, 2, ',', ' ') ?> &euro;</strong></p>
            <p><span>Livraison</span><strong><?= number_format($shippingAmount, 2, ',', ' ') ?> &euro;</strong></p>
            <p class="confirm-sheet__grand-total"><span>Total paye</span><strong><?= number_format($grandTotal, 2, ',', ' ') ?> &euro;</strong></p>
          </section>
        </div>

        <div class="confirm-page__actions no-print">
          <button type="button" class="confirm-page__print-btn" onclick="window.print()">
            Imprimer la confirmation
          </button>
          <a class="confirm-page__home-btn" href="<?= BASE_URL ?>index.php">Retour a l accueil</a>
        </div>
      </section>
    </main>
  </body>
</html>
