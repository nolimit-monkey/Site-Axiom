<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?= BASE_URL ?>src/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/utilitaire.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/header.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/inscription.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/logo_axiom-small.png" />
    <title>Inscription | AXIOM</title>
  </head>
  <body>
    <?php require_once __DIR__ . '/header.php'; ?>

    <main class="signup-page">
      <section class="signup-card" aria-labelledby="signup-title">
        <p class="signup-card__eyebrow">Validation commande</p>
        <h1 id="signup-title">Creer un compte</h1>
        <p class="signup-card__subtitle">
          Renseignez vos informations pour continuer.
        </p>

        <form class="signup-form" method="post" action="<?= BASE_URL ?>facturation.php">
          <label class="signup-form__field">
            <span>Prenom</span>
            <input type="text" name="prenom" autocomplete="given-name" required />
          </label>

          <label class="signup-form__field">
            <span>Nom</span>
            <input type="text" name="nom" autocomplete="family-name" required />
          </label>

          <label class="signup-form__field signup-form__field--full">
            <span>Telephone</span>
            <input type="tel" name="telephone" autocomplete="tel" required />
          </label>

          <p class="signup-form__section signup-form__field--full">Adresse</p>

          <label class="signup-form__field signup-form__field--full">
            <span>Rue</span>
            <input type="text" name="rue" autocomplete="street-address" required />
          </label>

          <label class="signup-form__field">
            <span>Ville</span>
            <input type="text" name="ville" autocomplete="address-level2" required />
          </label>

          <label class="signup-form__field">
            <span>Code postal</span>
            <input type="text" name="code_postal" autocomplete="postal-code" required />
          </label>

          <label class="signup-form__field signup-form__field--full">
            <span>Pays</span>
            <input type="text" name="pays" autocomplete="country-name" required />
          </label>

          <label class="signup-form__field signup-form__field--full">
            <span>Email</span>
            <input type="email" name="email" autocomplete="email" required />
          </label>

          <label class="signup-form__field signup-form__field--full">
            <span>Mot de passe</span>
            <input type="password" name="password" autocomplete="new-password" required />
          </label>

          <button type="submit" class="signup-form__submit">S inscrire et continuer</button>
        </form>
      </section>
    </main>
  </body>
</html>
