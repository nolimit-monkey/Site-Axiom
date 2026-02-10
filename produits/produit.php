<?php
require_once __DIR__ . '/../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS globaux -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/utilitaire.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/shipping.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/product.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet"
    >

    <title><?= $title ?? 'Produit' ?></title>
</head>
<body>
    <?php require_once __DIR__ . '/../header.php'; ?>
    <main class="product-page">

    <section class="product-gallery">
        <div class="product-thumbnails">
            <img src="<?= BASE_URL ?>/assets/img/product-1-thumb.jpg" alt="">
            <img src="<?= BASE_URL ?>/assets/img/product-2-thumb.jpg" alt="">
            <img src="<?= BASE_URL ?>/assets/img/product-3-thumb.jpg" alt="">
            <img src="<?= BASE_URL ?>/assets/img/product-4-thumb.jpg" alt="">
        </div>

        <div class="product-main-image">
            <img src="<?= BASE_URL ?>/assets/img/product-main.jpg" alt="Produit">
        </div>
    </section>

    <section class="product-info">
        <h1 class="product-title">
            Organic Overnight Chia Oats with Protein – Blueberry Muffin
        </h1>

        <p class="product-price">6,99 €</p>

        <p class="product-description">
            Our Overnight Chia with Protein is a creamy, nutritious breakfast
            inspired by the comforting taste of a blueberry muffin.
            With 12g of plant-based protein and 7g of fibre, just add water,
            let it rest, and enjoy.
        </p>

        <button class="btn-add-cart">
            Ajouter au panier
        </button>
    </section>

</main>
</body>
</html>
