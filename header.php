<!-- En-tête -->
<header class="header">
    <nav class="header--navbar">
        <ul class="header--nav_left">
            <li class="menu-item"><a href="<?= BASE_URL ?>index.php">Magasiner</a>
            <li class="menu-item"><a href="#">Recettes</a>
            <li class="menu-item"><a href="#">Qui nous sommes</a>
        </ul>

        <a class="header--logo" href="<?= BASE_URL ?>index.php">
            <img
                class="header--logo_img"
                src="<?= BASE_URL ?>/public/logo_axiom.png"
                alt="Logo Axiom auto"
            />
        </a>

        <div class="header--nav_right">
          <button class="header--icon_btn" aria-label="Localiser">
            <svg
              width="18"
              height="18"
              viewBox="0 0 17 23"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M8.37847162,0 C12.9986904,0 16.7579609,3.693 16.7579609,8.233 C16.7579609,11.34 13.2999205,16.476 9.91922299,21.089 L9.48060751,21.689 C9.22720785,22.04 8.81708711,22.249 8.37847162,22.249 C7.93985614,22.249 7.5297354,22.04 7.27633573,21.689 L6.83772025,21.088 C3.45600506,16.476 0,11.341 0,8.233 C0,3.693 3.75825285,0 8.37847162,0 Z M8.37847162,2.656 C5.24913842,2.656 2.70292975,5.158 2.70292975,8.233 C2.70292975,10.597 6.43675853,15.962 8.37847162,18.642 C10.3212024,15.961 14.0540135,10.596 14.0540135,8.233 C14.0540135,5.158 11.5078048,2.656 8.37847162,2.656 Z M8.54648883,5.5904 C9.94578416,5.5904 11.0794678,6.7044 11.0794678,8.0784 C11.0794678,9.4534 9.94578416,10.5684 8.54648883,10.5684 C7.14821117,10.5684 6.01452753,9.4534 6.01452753,8.0784 C6.01452753,6.7044 7.14821117,5.5904 8.54648883,5.5904 Z"
                fill="currentColor"
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