<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

    if ($postedId) {
        if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (!isset($_SESSION['panier'][$postedId])) {
            $_SESSION['panier'][$postedId] = 0;
        }

        $_SESSION['panier'][$postedId] += 1;

        header('Location: ' . BASE_URL . 'panier.php');
        exit;
    }
}

$produit = null;
if ($id) {
    $stmt = $pdo->prepare("
        SELECT id, nom, description, image_url, prix, categorie_id, stock
        FROM produits
        WHERE id = :id
        LIMIT 1
    ");
    $stmt->execute(['id' => $id]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$produit) {
    http_response_code(404);
}

$nom = $produit['nom'] ?? "Produit introuvable";
$description = $produit['description'] ?? "Ce produit n'existe pas.";
$prix = $produit['prix'] ?? null;
$imageUrl = $produit['image_url'] ?? null;

$imageFile = $imageUrl ?: "logo_axiom.png";
$imageSrc = BASE_URL . "public/" . htmlspecialchars($imageFile);

$title = $nom ?: "Produit";
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
    <?php require_once __DIR__ . '/../header.php'; ?>
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

