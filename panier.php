<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

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
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?= BASE_URL ?>src/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/utilitaire.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/header.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/panier.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/logo_axiom-small.png" />
    <title>Panier | AXIOM</title>
  </head>
  <body>
    <?php require_once __DIR__ . '/header.php'; ?>

    <main class="cart-page">
      <section class="cart-page__card" aria-labelledby="cart-title">
        <p class="cart-page__eyebrow">Commande</p>
        <h1 id="cart-title">Votre panier</h1>

        <?php if ($cartItems === []) : ?>
        <p class="cart-page__empty">
          Votre panier est vide pour le moment.
        </p>
        <?php else : ?>
        <ul class="cart-page__list" aria-label="Produits dans le panier">
          <?php foreach ($cartItems as $item) : ?>
          <li class="cart-page__row">
            <div>
              <p class="cart-page__name"><?= htmlspecialchars($item['nom']) ?></p>
              <p class="cart-page__meta">
                Quantite : <?= (int) $item['quantity'] ?> x
                <?= number_format($item['unit_price'], 2, ',', ' ') ?> &euro;
              </p>
              <form method="post" class="cart-page__remove-form">
                <input type="hidden" name="remove_product_id" value="<?= (int) $item['id'] ?>">
                <button type="submit" class="cart-page__remove-btn">Supprimer</button>
              </form>
            </div>
            <p class="cart-page__line-total">
              <?= number_format($item['line_total'], 2, ',', ' ') ?> &euro;
            </p>
          </li>
          <?php endforeach; ?>
        </ul>

        <p class="cart-page__total">
          Total : <?= number_format($total, 2, ',', ' ') ?> &euro;
        </p>
        <?php endif; ?>

        <div class="cart-page__actions">
          <a class="cart-page__cta" href="<?= BASE_URL ?>index.php">
            Continuer vos achats
          </a>
          <?php if ($cartItems !== []) : ?>
          <a class="cart-page__confirm" href="<?= BASE_URL ?>inscription.php">
            Confirmer la commande
          </a>
          <?php endif; ?>
        </div>
      </section>
    </main>
  </body>
</html>
