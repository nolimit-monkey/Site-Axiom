<?php
/** @var string|null $deliveryMode */
/** @var string $deliveryLabel */
/** @var float $shippingAmount */
/** @var array $cartItems */
/** @var float $subtotal */
/** @var float $grandTotal */
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?= BASE_URL ?>src/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/utilitaire.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/header.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/paiement.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/logo_axiom-small.png" />
    <title>Paiement | AXIOM</title>
  </head>
  <body>
    <?php require_once __DIR__ . '/header.php'; ?>

    <main class="payment-page">
      <section class="payment-page__container" aria-labelledby="payment-title">
        <p class="payment-page__eyebrow">Etape finale</p>
        <h1 id="payment-title">Paiement securise</h1>
        <p class="payment-page__subtitle">Choisissez une methode de paiement puis confirmez votre commande.</p>

        <form class="payment-layout" method="post" action="<?= BASE_URL ?>confirmation">
          <input type="hidden" name="delivery_mode" value="<?= htmlspecialchars((string) $deliveryMode) ?>" />

          <section class="payment-main">
            <h2 class="payment-main__title">Methode de paiement</h2>

            <div class="payment-methods">
              <input type="radio" id="method-card" name="payment_method" value="card" checked />
              <input type="radio" id="method-paypal" name="payment_method" value="paypal" />
              <input type="radio" id="method-wallet" name="payment_method" value="wallet" />

              <div class="payment-methods__tabs">
                <label for="method-card">Carte bancaire</label>
                <label for="method-paypal">PayPal</label>
                <label for="method-wallet">Apple Pay / Google Pay</label>
              </div>

              <div class="payment-methods__panels">
                <section class="payment-panel payment-panel--card">
                  <p class="payment-panel__hint">Paiement par carte Visa, Mastercard ou Amex.</p>
                  <label>
                    <span>Nom sur la carte</span>
                    <input type="text" name="card_name" autocomplete="cc-name" />
                  </label>
                  <label>
                    <span>Numero de carte</span>
                    <input type="text" name="card_number" inputmode="numeric" autocomplete="cc-number" />
                  </label>
                  <div class="payment-panel__row">
                    <label>
                      <span>Date d expiration</span>
                      <input type="text" name="card_expiry" placeholder="MM/AA" autocomplete="cc-exp" />
                    </label>
                    <label>
                      <span>Cryptogramme</span>
                      <input type="text" name="card_cvc" inputmode="numeric" autocomplete="cc-csc" />
                    </label>
                  </div>
                </section>

                <section class="payment-panel payment-panel--paypal">
                  <p class="payment-panel__hint">Vous serez redirige vers PayPal pour finaliser le paiement.</p>
                </section>

                <section class="payment-panel payment-panel--wallet">
                  <p class="payment-panel__hint">Paiement rapide depuis votre appareil.</p>
                  <p class="payment-panel__hint">Vous pourrez valider via Face ID, Touch ID ou votre appareil Android compatible.</p>
                </section>
              </div>
            </div>
          </section>

          <aside class="payment-summary">
            <h2 class="payment-summary__title">Recapitulatif</h2>

            <div class="payment-summary__delivery">
              <p>Livraison</p>
              <strong><?= htmlspecialchars($deliveryLabel) ?></strong>
            </div>

            <ul class="payment-summary__items">
              <?php if ($cartItems === []) : ?>
              <li class="payment-summary__empty">Aucun produit dans le panier.</li>
              <?php else : ?>
              <?php foreach ($cartItems as $item) : ?>
              <li>
                <span><?= htmlspecialchars($item['nom']) ?> x<?= (int) $item['quantity'] ?></span>
                <strong><?= number_format($item['line_total'], 2, ',', ' ') ?> &euro;</strong>
              </li>
              <?php endforeach; ?>
              <?php endif; ?>
            </ul>

            <div class="payment-summary__totals">
              <p>
                <span>Sous-total</span>
                <strong><?= number_format($subtotal, 2, ',', ' ') ?> &euro;</strong>
              </p>
              <p>
                <span>Livraison</span>
                <strong><?= number_format($shippingAmount, 2, ',', ' ') ?> &euro;</strong>
              </p>
              <p class="payment-summary__grand-total">
                <span>Total</span>
                <strong><?= number_format($grandTotal, 2, ',', ' ') ?> &euro;</strong>
              </p>
            </div>

            <button type="submit" class="payment-summary__submit">
              Confirmer et payer
            </button>
          </aside>
        </form>
      </section>
    </main>
  </body>
</html>
