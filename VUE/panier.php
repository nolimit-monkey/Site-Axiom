<?php
/** @var array $cartItems */
/** @var float $total */
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
