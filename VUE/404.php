<!-- Page 404 affichée par index.php pour toute URL non reconnue par le routeur. -->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/composants/header.css">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/logo_axiom-small.png">
    <title>404 | AXIOM</title>
</head>
<body>
    <?php require_once __DIR__ . '/header.php'; ?>
    <main style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:70vh;text-align:center;gap:1rem">
        <h1 style="font-size:6rem;margin:0">404</h1>
        <p>Cette page n'existe pas.</p>
        <a href="<?= BASE_URL ?>">Retour à l'accueil</a>
    </main>
</body>
</html>
