<?php
/** @var array|null $produit */
/** @var string $nom */
/** @var string $description */
/** @var float|null $prix */
/** @var string|null $imageUrl */
/** @var string $imageSrc */
/** @var string $title */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= BASE_URL ?>/src/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/utilitaire.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/composants/product.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet"
    >

    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <?php require_once __DIR__ . '/header.php'; ?>
    <main class="product-page">

        <section class="product-gallery">
            <?php if (!empty($imageUrl)) : ?>
            <div class="product-thumbnails">
                <img src="<?= $imageSrc ?>" alt="<?= htmlspecialchars($nom) ?>">
            </div>
            <?php endif; ?>

            <div class="product-main-image">
                <img src="<?= $imageSrc ?>" alt="<?= htmlspecialchars($nom) ?>">
            </div>
        </section>

        <section class="product-info">
            <h1 class="product-title">
                <?= htmlspecialchars($nom) ?>
            </h1>

            <?php if ($prix !== null) : ?>
            <p class="product-price">
                <?= number_format((float) $prix, 2, ",", " ") ?> &euro;
            </p>
            <?php endif; ?>

            <p class="product-description">
                <?= nl2br(htmlspecialchars($description)) ?>
            </p>

            <?php if ($produit) : ?>
            <form method="post" class="product-add-form">
                <input type="hidden" name="product_id" value="<?= (int) $produit['id'] ?>">
                <button class="btn-add-cart" type="submit">
                    Ajouter au panier
                </button>
            </form>
            <?php endif; ?>
        </section>

    </main>
</body>
</html>
