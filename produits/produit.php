<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../header.php';
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
