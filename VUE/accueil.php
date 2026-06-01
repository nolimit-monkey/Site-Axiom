<?php
/** @var array $sections */
/** @var array $byId */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?= BASE_URL ?>src/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/utilitaire.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/accueil.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/collection.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=DM+Serif+Text:ital@0;1&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700&family=Pacifico&family=Playfair+Display:wght@700&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/logo_axiom-small.png">
    <title> Home | AXIOM - L'excellence en mouvement</title>
  </head>
  <body>
    <?php require_once __DIR__ . '/../header.php'; ?>
    <!-- Contenu principal -->
    <main id="main" role="main">
      <!-- Image d'accueil -->
      <section class="accueil">
        <img
          class="accueil--image"
          src="<?= BASE_URL ?>public/accueil_image.png"
          alt="Image d'accueil."
        />
      </section>
      <!-- Collection -->
      <section class="collection">
        <h2 class="collection--title">
          Nos produits phares
        </h2>
        <div class="collection--items">
          <div class="collection--wrapper categorie-1">
            <a href="<?= BASE_URL ?>produit.php?id=<?= (int) $sections[1][0]['id'] ?>" class="collection--clickable_area">
              <div class="collection--wrapper">
                <div class="collection--img_container">
                  <img
                      class="collection--item_img"
                      src="<?= BASE_URL ?>public/<?= htmlspecialchars($sections[1][0]['image_url']) ?>"
                      alt="<?= htmlspecialchars($sections[1][0]['nom']) ?>"
                    />
                  <img
                    class="collection--item_img_hover"
                    src="<?= BASE_URL ?>public/logo_axiom-small.png"
                    alt="Axiom auto logo"
                  />
                </div>

                <p class="collection--item_desc">
                  <?= htmlspecialchars($sections[1][0]['nom']) ?><br />
                  À partir de <?= number_format($sections[1][0]['prix'], 2, ',', ' ') ?> €
                </p>
              </div>
            </a>
          </div>
          <div class="collection--wrapper categorie-2">
            <a href="<?= BASE_URL ?>produit.php?id=<?= (int) $sections[2][0]['id'] ?>" class="collection--clickable_area">
              <div class="collection--wrapper">
                <div class="collection--img_container">
                  <img
                      class="collection--item_img"
                      src="<?= BASE_URL ?>public/<?= htmlspecialchars($sections[2][0]['image_url']) ?>"
                      alt="<?= htmlspecialchars($sections[2][0]['nom']) ?>"
                    />
                  <img
                    class="collection--item_img_hover"
                    src="<?= BASE_URL ?>public/logo_axiom-small.png"
                    alt="Axiom auto logo"
                  />
                </div>

                <p class="collection--item_desc">
                  <?= htmlspecialchars($sections[2][0]['nom']) ?><br />
                  À partir de <?= number_format($sections[2][0]['prix'], 2, ',', ' ') ?> €
                </p>
              </div>
            </a>
          </div>
          <div class="collection--wrapper categorie-3">
            <a href="<?= BASE_URL ?>produit.php?id=<?= (int) $sections[3][0]['id'] ?>" class="collection--clickable_area">
              <div class="collection--wrapper">
                <div class="collection--img_container">
                  <img
                      class="collection--item_img"
                      src="<?= BASE_URL ?>public/<?= htmlspecialchars($sections[3][0]['image_url']) ?>"
                      alt="<?= htmlspecialchars($sections[3][0]['nom']) ?>"
                    />
                  <img
                    class="collection--item_img_hover"
                    src="<?= BASE_URL ?>public/logo_axiom-small.png"
                    alt="Axiom auto logo"
                  />
                </div>

                <p class="collection--item_desc">
                  <?= htmlspecialchars($sections[3][0]['nom']) ?><br />
                  À partir de <?= number_format($sections[3][0]['prix'], 2, ',', ' ') ?> €
                </p>
              </div>
            </a>
          </div>
          <div class="collection--wrapper categorie-4">
            <a href="<?= BASE_URL ?>produit.php?id=<?= (int) $sections[4][0]['id'] ?>" class="collection--clickable_area">
              <div class="collection--wrapper">
                <div class="collection--img_container">
                  <img
                      class="collection--item_img"
                      src="<?= BASE_URL ?>public/<?= htmlspecialchars($sections[4][0]['image_url']) ?>"
                      alt="<?= htmlspecialchars($sections[4][0]['nom']) ?>"
                    />
                  <img
                    class="collection--item_img_hover"
                    src="<?= BASE_URL ?>public/logo_axiom-small.png"
                    alt="Axiom auto logo"
                  />
                </div>

                <p class="collection--item_desc">
                  <?= htmlspecialchars($sections[4][0]['nom']) ?><br />
                  À partir de <?= number_format($sections[4][0]['prix'], 2, ',', ' ') ?> €
                </p>
              </div>
            </a>
          </div>
        </div>
      </section>
    </main>
    <!-- Pied de page -->
    <footer class="footer">
      <div class="footer--principale">
        <div class="footer--block footer--block--text">
          <h2 class="footer--title">goûtez le changement</h2>
          <div class="footer--contenu">
            <p>Du déjeuner aux fringales de fin de soirée, on rend l'alimentation végétale facile, délicieuse et inspirante — avec des produits bio, naturels et savoureux à chaque bouchée.</p>
          </div>
          <img class="footer--logo" src="public/logo_axiom.png" alt="Logo du site"/>
          <div class="footer--social footer--title">Nous suivre</div>
            <ul class="footer--social Liste">
              <li class="Liste--item">
                <a href="" class="Link Link--primary" target="_blank" rel="noopener" aria-label="Facebook">
                  <span class="Icon-Wrapper--clickable"><svg class="Icon Icon--facebook" viewBox="0 0 9 17">
                <path d="M5.842 17V9.246h2.653l.398-3.023h-3.05v-1.93c0-.874.246-1.47 1.526-1.47H9V.118C8.718.082 7.75 0 6.623 0 4.27 0 2.66 1.408 2.66 3.994v2.23H0v3.022h2.66V17h3.182z"></path>
              </svg></span>
                </a>
              </li>

              <li class="Liste--item">
                    <a href="" class="Link Link--primary" target="_blank" rel="noopener" aria-label="Instagram">
                      <span class="Icon-Wrapper--clickable"><svg class="Icon Icon--instagram" role="presentation" viewBox="0 0 32 32">
                    <path d="M15.994 2.886c4.273 0 4.775.019 6.464.095 1.562.07 2.406.33 2.971.552.749.292 1.283.635 1.841 1.194s.908 1.092 1.194 1.841c.216.565.483 1.41.552 2.971.076 1.689.095 2.19.095 6.464s-.019 4.775-.095 6.464c-.07 1.562-.33 2.406-.552 2.971-.292.749-.635 1.283-1.194 1.841s-1.092.908-1.841 1.194c-.565.216-1.41.483-2.971.552-1.689.076-2.19.095-6.464.095s-4.775-.019-6.464-.095c-1.562-.07-2.406-.33-2.971-.552-.749-.292-1.283-.635-1.841-1.194s-.908-1.092-1.194-1.841c-.216-.565-.483-1.41-.552-2.971-.076-1.689-.095-2.19-.095-6.464s.019-4.775.095-6.464c.07-1.562.33-2.406.552-2.971.292-.749.635-1.283 1.194-1.841s1.092-.908 1.841-1.194c.565-.216 1.41-.483 2.971-.552 1.689-.083 2.19-.095 6.464-.095zm0-2.883c-4.343 0-4.889.019-6.597.095-1.702.076-2.864.349-3.879.743-1.054.406-1.943.959-2.832 1.848S1.251 4.473.838 5.521C.444 6.537.171 7.699.095 9.407.019 11.109 0 11.655 0 15.997s.019 4.889.095 6.597c.076 1.702.349 2.864.743 3.886.406 1.054.959 1.943 1.848 2.832s1.784 1.435 2.832 1.848c1.016.394 2.178.667 3.886.743s2.248.095 6.597.095 4.889-.019 6.597-.095c1.702-.076 2.864-.349 3.886-.743 1.054-.406 1.943-.959 2.832-1.848s1.435-1.784 1.848-2.832c.394-1.016.667-2.178.743-3.886s.095-2.248.095-6.597-.019-4.889-.095-6.597c-.076-1.702-.349-2.864-.743-3.886-.406-1.054-.959-1.943-1.848-2.832S27.532 1.247 26.484.834C25.468.44 24.306.167 22.598.091c-1.714-.07-2.26-.089-6.603-.089zm0 7.778c-4.533 0-8.216 3.676-8.216 8.216s3.683 8.216 8.216 8.216 8.216-3.683 8.216-8.216-3.683-8.216-8.216-8.216zm0 13.549c-2.946 0-5.333-2.387-5.333-5.333s2.387-5.333 5.333-5.333 5.333 2.387 5.333 5.333-2.387 5.333-5.333 5.333zM26.451 7.457c0 1.059-.858 1.917-1.917 1.917s-1.917-.858-1.917-1.917c0-1.059.858-1.917 1.917-1.917s1.917.858 1.917 1.917z"></path>
                  </svg></span>
                    </a>
                  </li>

              <li class="Liste--item">
                    <a href="" class="Link Link--primary" target="_blank" rel="noopener" aria-label="Pinterest">
                      <span class="Icon-Wrapper--clickable"><svg class="Icon Icon--pinterest" role="presentation" viewBox="0 0 32 32">
                    <path d="M16 0q3.25 0 6.208 1.271t5.104 3.417 3.417 5.104T32 16q0 4.333-2.146 8.021t-5.833 5.833T16 32q-2.375 0-4.542-.625 1.208-1.958 1.625-3.458l1.125-4.375q.417.792 1.542 1.396t2.375.604q2.5 0 4.479-1.438t3.063-3.937 1.083-5.625q0-3.708-2.854-6.437t-7.271-2.729q-2.708 0-4.958.917T8.042 8.689t-2.104 3.208-.729 3.479q0 2.167.812 3.792t2.438 2.292q.292.125.5.021t.292-.396q.292-1.042.333-1.292.167-.458-.208-.875-1.083-1.208-1.083-3.125 0-3.167 2.188-5.437t5.729-2.271q3.125 0 4.875 1.708t1.75 4.458q0 2.292-.625 4.229t-1.792 3.104-2.667 1.167q-1.25 0-2.042-.917t-.5-2.167q.167-.583.438-1.5t.458-1.563.354-1.396.167-1.25q0-1.042-.542-1.708t-1.583-.667q-1.292 0-2.167 1.188t-.875 2.979q0 .667.104 1.292t.229.917l.125.292q-1.708 7.417-2.083 8.708-.333 1.583-.25 3.708-4.292-1.917-6.938-5.875T0 16Q0 9.375 4.687 4.688T15.999.001z"></path>
                  </svg></span>
                    </a>
                  </li>

              <li class="Liste--item">
                    <a href="" class="Link Link--primary" target="_blank" rel="noopener" aria-label="YouTube">
                      <span class="Icon-Wrapper--clickable"><svg class="Icon Icon--youtube" role="presentation" viewBox="0 0 33 32">
                    <path d="M0 25.693q0 1.997 1.318 3.395t3.209 1.398h24.259q1.891 0 3.209-1.398t1.318-3.395V6.387q0-1.997-1.331-3.435t-3.195-1.438H4.528q-1.864 0-3.195 1.438T.002 6.387v19.306zm12.116-3.488V9.876q0-.186.107-.293.08-.027.133-.027l.133.027 11.61 6.178q.107.107.107.266 0 .107-.107.213l-11.61 6.178q-.053.053-.107.053-.107 0-.16-.053-.107-.107-.107-.213z"></path>
                  </svg></span>
                    </a>
                  </li>

              <li class="Liste--item">
                    <a href="" class="Link Link--primary" target="_blank" rel="noopener" aria-label="TikTok">
                      <span class="Icon-Wrapper--clickable"><svg class="Icon Icon--tiktok" role="presentation" viewBox="0 0 13 16">
                    <path d="M12.998 6.146A4.055 4.055 0 019.23 4.331v6.245a4.616 4.616 0 11-4.615-4.615c.096 0 .19.008.285.014V8.25c-.095-.012-.188-.029-.285-.029a2.356 2.356 0 000 4.711c1.3 0 2.45-1.025 2.45-2.326L7.089 0h2.176A4.053 4.053 0 0013 3.618v2.528" fill="currentColor"></path>
                  </svg></span>
                    </a>
                  </li>

              <li class="Liste--item">
                    <a href="" class="Link Link--primary" target="_blank" rel="noopener" aria-label="LinkedIn">
                      <span class="Icon-Wrapper--clickable"><svg class="Icon Icon--linkedin" role="presentation" viewBox="0 0 24 24">
                    <path d="M19 0H5a5 5 0 0 0-5 5v14a5 5 0 0 0 5 5h14a5 5 0 0 0 5-5V5a5 5 0 0 0-5-5zM8 19H5V8h3v11zM6.5 6.73a1.76 1.76 0 1 1 0-3.53 1.76 1.76 0 0 1 0 3.53zM20 19h-3v-5.6c0-3.37-4-3.12-4 0V19h-3V8h3v1.76a3.8 3.8 0 0 1 7 2.48V19z"></path>
                  </svg></span>
                    </a>
                  </li>
              </ul>
        </div>
        <div class="footer--block footer--block--links"></div>
        <div class="footer--block footer--block--newsletter"></div>
      </div>
      <div class="footer--bas">
        <div class="Footer__Copyright">
          <a href="<?= BASE_URL ?>index.php" class="footer--nom_magasin">© AXIOM auto</a>
          <p class="footer--autheur">Made by Mandresy RAPHEHISON</p>
        </div>
      </div>
    </footer>
  </body>
</html>
