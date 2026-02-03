<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/header.css">
</head>
<body>

<!-- Barre de livraison -->
<section class="shipping">
    Livraison gratuite à partir de $59* au Québec.
</section>

<!-- En-tête -->
<header class="header">
    <nav class="header--navbar">
        <div class="header--nav_left">
            <a href="<?= BASE_URL ?>/index.php">Magasiner</a>
            <a href="#">Recettes</a>
            <a href="#">Qui nous sommes</a>
        </div>

        <a class="header--logo" href="<?= BASE_URL ?>/index.php">
            <img
                class="header--logo_img"
                src="<?= BASE_URL ?>/public/logo.png"
                alt="Logo"
            />
        </a>

        <div class="header--nav_right">
          <button class="header--icon_btn" aria-label="Localiser">
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12 12.75c1.52 0 2.75-1.23 2.75-2.75S13.52 7.25 12 7.25 9.25 8.48 9.25 10 10.48 12.75 12 12.75z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M18.5 10c0 4.19-3.85 7.69-5.79 9.22a.7.7 0 0 1-.87 0C9.89 17.69 6 14.19 6 10a6 6 0 1 1 12 0z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
          <button class="header--icon_btn" aria-label="Compte">
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12 12.75c2.07 0 3.75-1.68 3.75-3.75S14.07 5.25 12 5.25 8.25 6.93 8.25 9s1.68 3.75 3.75 3.75z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M6.75 18.75a5.25 5.25 0 0 1 10.5 0"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
          <button class="header--icon_btn" aria-label="Favoris">
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="m12 20-7-7a4.5 4.5 0 0 1 6.36-6.36L12 7.28l.64-.64A4.5 4.5 0 0 1 19 13l-7 7z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
          <button class="header--icon_btn" aria-label="Panier">
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M6.5 6.5h13l-1.3 7.8a1.7 1.7 0 0 1-1.68 1.4H9.48a1.7 1.7 0 0 1-1.69-1.4L6 4.75H3.5"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <circle cx="10" cy="19" r="1" fill="currentColor" />
              <circle cx="17" cy="19" r="1" fill="currentColor" />
            </svg>
          </button>
        </div>
    </nav>
</header>