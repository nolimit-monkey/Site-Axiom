<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?= BASE_URL ?>src/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/utilitaire.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/header.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/facturation.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/logo_axiom-small.png" />
    <title>Facturation | AXIOM</title>
  </head>
  <body>
    <?php require_once __DIR__ . '/header.php'; ?>

    <main class="billing-page">
      <section class="billing-page__container" aria-labelledby="billing-title">
        <p class="billing-page__eyebrow">Etape suivante</p>
        <h1 id="billing-title">Facturation et livraison</h1>

        <div class="billing-page__grid">
          <article class="billing-card">
            <h2 class="billing-card__title">Adresse de facturation si différente de votre adresse de livraison</h2>
            <div class="billing-card__placeholder" aria-label="Zone adresse vide">
              <p>Section vide pour le moment. Le formulaire d'adresse sera ajoute plus tard.</p>
            </div>
          </article>

          <aside class="delivery-card">
            <h2 class="delivery-card__title">Mode de livraison</h2>
            <form class="delivery-form" method="post" action="<?= BASE_URL ?>paiement.php">
              <label class="delivery-form__option">
                <input type="radio" name="delivery_mode" value="standard" required />
                <span>Standard (3 a 5 jours)</span>
              </label>

              <label class="delivery-form__option">
                <input type="radio" name="delivery_mode" value="express" required />
                <span>Express (24h a 48h)</span>
              </label>

              <label class="delivery-form__option">
                <input type="radio" name="delivery_mode" value="pickup" required />
                <span>Retrait en magasin</span>
              </label>

              <button type="submit" class="delivery-form__submit">
                Confirmer
              </button>
            </form>
          </aside>
        </div>
      </section>
    </main>
  </body>
</html>
